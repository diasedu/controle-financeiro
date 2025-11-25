$(function()
{
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

		const formData = $(this).serializeArray().map(function(field)
		{
			if (field.name === "preco") {
				field.value = field.value.replace(",", ".");
			}
			return field;
		});

		$.ajax({
			url: $(this).attr("action"),
			method: $(this).attr("method"),
			dataType: "json",
			cache: false,
			data: $.param(formData),
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
				
				setTimeout(function() {
					$("#modalInsertUpdate").modal("hide");
					$("#btnConsult").click();
				}, 1000);

				clearForm();
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
		const id = $(this).attr("attr-id");

		$.ajax({
			url: "produto/deleteRegister",
			method: "post",
			dataType: "json",
			cache: false,
			data: {id},
			beforeSend: function()
			{
				$("#btnDelete").html("Processando...").prop("disabled", true);
			},
			success: function(JsonContent)
			{
				if (JsonContent["error"])
				{
					alert(JsonContent["message"]);
					return;
				}

				$("#modalConfirmation").modal("hide");
				$("#btnConsult").click();
			},
			error: function (a, b, c) {
				console.log(a, b, c);
			},
			complete: function () {
				$("#btnDelete").html("Excluir").prop("disabled", false);
			}
		});
	});

	$("#btnConsult").click();
});

const getRegister = function(element)
{
	const id = $(element).attr("attr-id");

	$.ajax({
		url: "produto/getRegister",
		method: "post",
		dataType: "json",
		cache: false,
		data: {id},
		beforeSend: function()
		{
			$(element).html("Processando...").prop("disabled", true);
		},
		success: function(JsonContent)
		{
			if (JsonContent["error"])
			{
				alert(JsonContent["message"]);
				return;
			}

			$("#modalInsertUpdate").modal("show");
			
			Object.keys(JsonContent["data"]).forEach(function(key)
			{
				const field = $("#" + key);
				
				if (field.length)
				{
					field.val(JsonContent["data"][key]);
				}
			});
			
			$("#modalInsertUpdateLabel").text("Edição de Produto");
		},
		error: function (a, b, c) {
			console.log(a, b, c);
		},
		complete: function () {
			$(element).html('<i class="fa-solid fa-pencil"></i> Editar').prop("disabled", false);
		}
	});
}

const deleteRegister = function(element)
{
	const id = $(element).attr("attr-id");

	$("#modalConfirmation").modal("show");
	$("#btnDelete").attr("attr-id", id);
}

const formatMessage = function (error, message) {
	if (error) {
		return `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <div>${message}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `
	} else {
		return `
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div>${message}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `
	}
}

const clearForm = function()
{
	$("#formInsertUpdate").trigger("reset");
	$("#id").val("");
	$("#preco").val("");
	$("#tipo_cobranca").val("unidade");
	$("#status").val("1");
	$("#msg").html("");
	$("#modalInsertUpdateLabel").text("Cadastro de Produtos");
}


