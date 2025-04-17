$(function()
{
	$("#valor_conta").mask("000.000.000.000.000,00", { reverse: true });

	$("#formFilt").on("submit", function(e)
	{
		e.preventDefault();

		$.ajax({
			url: $(this).attr("action"),
			method: $(this).attr("method"),
			dataType: "json",
			cache: false,
			data: $(this).serialize(),
			beforeSend: function()
			{
				$("#list").html($("#listPlaceholder").html());
				$("#btnConsult").html("Processando...").prop("disabled", true);
			},
			success: function(JsonContent)
			{
				$("#list").html(JsonContent["html"]);

				const options = {
					fixedHeader: true,
					paging: false,
					lengthChange: false,
					searching: false,
					ordering: true,
					info: false,
					autoWidth: true,
					responsive: true,
					language:
					{
						info: "Exibindo página _PAGE_ de _PAGES_"
					},
					columnDefs: [{
						orderable: false, 
						targets: [5]
					}]
				}

				$("#table").DataTable(options);
			},
			error: function (a, b, c)
			{
				console.log(a, b, c);
			},
			complete: function ()
			{
				$("#btnConsult").html('<i class="fa-solid fa-search"></i>').prop("disabled", false);
			}
		});
	});

	$("#formInsertUpdate").on("submit", function(e)
	{
		e.preventDefault();

		$.ajax({
			url: $(this).attr("action"),
			method: $(this).attr("method"),
			dataType: "json",
			cache: false,
			data: $(this).serialize(),
			beforeSend: function()
			{
				$("#formInsertUpdate button[type='submit']").html("Processando...").prop("disabled", true);
			},
			success: function(JsonContent)
			{
				$("#msg").html(formatMessage(JsonContent["error"], JsonContent["message"]));

				if (JsonContent["error"])
					{
					return;
				}
				
				// Se não houver erro, fecha o modal após 1 segundo
				setTimeout(function() {
					$("#modalInsertUpdate").modal("hide");
					// Atualiza a lista após fechar o modal
					$("#btnConsult").click();
				}, 1000);

				$("#modalInsertUpdate").modal("hide");
				clearForm();
				$("#btnConsult").click();
			},
			error: function (a, b, c) {
				console.log(a, b, c);
			},
			complete: function () {
				$("#formInsertUpdate button[type='submit']").html("Gravar").prop("disabled", false);
			}
		});
	});

	$("#btnDelete").on("click", function(e)
	{
		const id_conta = $(this).attr("attr-id");

		$.ajax({
			url: "conta/deleteRegister",
			method: "post",
			dataType: "json",
			cache: false,
			data: {id_conta},
			beforeSend: function()
			{
				$(this).html("Processando...").prop("disabled", true);
			},
			success: function(JsonContent)
			{
				// $("#msg").html(formatMessage(JsonContent["error"], JsonContent["message"]));

				if (JsonContent["error"])
				{
					return;
				}

				$("#modalConfirmation").modal("hide");
				$("#btnConsult").click();
			},
			error: function (a, b, c) {
				console.log(a, b, c);
			},
			complete: function () {
				$(this).html("Excluir").prop("disabled", false);
			}
		});
	});

	$("#btnConsult").submit();
});

const getRegister = function(element)
{
	const id_conta = $(element).attr("attr-id");

	$.ajax({
		url: "conta/getRegister",
		method: "post",
		dataType: "json",
		cache: false,
		data: {id_conta},
		beforeSend: function()
		{
			$(element).html("Processando...").prop("disabled", true);
		},
		success: function(JsonContent)
		{
			// $("#msg").html(formatMessage(JsonContent["error"], JsonContent["message"]));

			if (JsonContent["error"])
			{
				return;
			}

			$("#modalInsertUpdate").modal("show");
			
			// Preenche todos os campos do formulário com os dados da resposta
			Object.keys(JsonContent["data"]).forEach(function(key)
			{
				const field = $("#" + key);
				
				// Verifica se o campo existe
				if (field.length)
				{
					field.val(JsonContent["data"][key]);
				}
			});
			
			// // Atualiza o título do modal para indicar que é uma edição
			// $("#modalInsertUpdateLabel").text("Edição de conta");
		},
		error: function (a, b, c) {
			console.log(a, b, c);
		},
		complete: function () {
			$(element).html("Editar").prop("disabled", false);
		}
	});
}

const deleteRegister = function(element)
{
	const id_conta = $(element).attr("attr-id");

	$("#modalConfirmation").modal("show");
	$("#btnDelete").attr("attr-id", id_conta);
}

const formatMessage = function (error, message) {
	if (error) {
		return `
            <div class="alert alert-danger alert-dismissible" role="alert">
                <div>${message}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `
	} else {
		return `
            <div class="alert alert-success alert-dismissible" role="alert">
                <div>${message}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `
	}
}

const clearForm = function()
{
	$("#formInsertUpdate").trigger("reset");

	$("#msg").html("");
}