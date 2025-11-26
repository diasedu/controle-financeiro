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

				//$("#table").DataTable(options);
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
			url: "pedido/deleteRegister",
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
		url: "pedido/getRegister",
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
			
			$("#modalInsertUpdateLabel").text("Edição de pedido");
		},
		error: function (a, b, c) {
			console.log(a, b, c);
		},
		complete: function () {
			$(element).html('<i class="fa-solid fa-pencil"></i>').prop("disabled", false);
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
}

function recalcularPreco(elemento) {
	const id    = elemento.getAttribute('data-id');
	const qtd   = elemento.value;

	if (!qtd) {
		return;
	}

	const preco = document.querySelector('input.valor-total[data-id="' + id + '"]');
	const precoFormatted = preco.getAttribute('data-preco').replace(',', '.');

	preco.value = (qtd * precoFormatted);
}

function getItensSelecionados() {
    const itensSelecionados = document.querySelectorAll('.itens:checked');

    if (itensSelecionados.length === 0) {
        return [];
    }

    return Array.from(itensSelecionados).map(function(e) {
        return e.getAttribute('data-id');
    });
}

const form = document.querySelector('form#form-add-itens-selecionados');

form.addEventListener('submit', function(e) {
	e.preventDefault();

    const itens = getItensSelecionados();

    // Monta querystring corretamente
    const params = new URLSearchParams({
        itens: JSON.stringify(itens)
    });

    const actionUrl = form.getAttribute('action');
    const completeUrl = `${actionUrl}?${params.toString()}`;

	fetch(completeUrl)
		.then(function(response) {
			return response.text();
		})
		.then(function(html) {
			document.querySelector('#conteudo-confirmar-itens').innerHTML = html;

			document.querySelector('#pills-confirmar-itens-tab').classList.remove('disabled', 'text-secondary');
			document.querySelector('#pills-confirmar-itens-tab').click();
		})
		.catch(function(erro) {
			console.log(erro.message);
		});


});