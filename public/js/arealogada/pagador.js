$(function()
{
	$("#list").html($("#listPlaceholder").html());

	$("#formFilt").on("submit", function(e)
	{
		e.preventDefault();

		consultar();
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
			success: function(response)
			{
				$("#msg").html(response["html"]);

				if (response["error"])
				{
					return;
				}

				$("#btnConsult").click();
				$("#modalInsertUpdate button[data-bs-dismiss]").click();
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
		const id_paga = $(this).attr("attr-id");

		$.ajax({
			url: "pagador/excluir",
			method: "post",
			dataType: "json",
			cache: false,
			data: {id_paga},
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

	setTimeout(function()
	{
		$("#formFilt").submit();
	}, 600)
	
});

const iconeConsultar = '<i class="fa-solid fa-search" aria-hidden="true"></i>';

const consultar = function(element = null)
{
	let data = "";

	if (element)
	{
		data = `id_paga=${$(element).attr("attr-id_paga")}`;
	} else 
	{
		data = $("#formFilt").serialize();
	}

	$.ajax({
		url: $("#formFilt").attr("action"),
		method: $("#formFilt").attr("method"),
		dataType: "json",
		cache: false,
		data: data,
		beforeSend: function()
		{
			if (element)
			{
				$(element).html("Processando...").prop("disabled", true);
			} else
			{
				const listPlaceholder = $("#listPlaceholder").html();
				$("#list").html(listPlaceholder);

				$("#formFilt button[type='submit']").html("Processando...").prop("disabled", true);
			}
		},
		success: function(response)
		{
			if (response["error"])
			{
				return;
			}

			if (element)
			{
				$("#modalInsertUpdate").modal("show");

				// Popula os campos do formulário.
				$("#formInsertUpdate [name='id_paga']").val(response["list"]["id_paga"]);
				$("#formInsertUpdate [name='nome_paga']").val(response["list"]["nome_paga"]);
				$("#formInsertUpdate [name='sta_paga']").val(response["list"]["sta_paga"]);
			} else 
			{
				$("#list").html(response["html"]);

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
						targets: [3]
					}]
				}

				$("#table").DataTable(options);
			}
		},
		error: function (a, b, c) {
			console.log(a, b, c);
		},
		complete: function () {
			if (element)
			{
				$(element).html("Editar").prop("disabled", false);
			} else
			{
				$("#formFilt button[type='submit']").html(iconeConsultar).prop("disabled", false);
			}
		}
	});
}

const excluir = function(element)
{
	const id_paga = $(element).attr("attr-id");

	$("#modalConfirmation").modal("show");
	$("#btnDelete").attr("attr-id", id_paga);
}

const clearForm = function()
{
	$("#formInsertUpdate").trigger("reset");

	$("#msg").html("");
}