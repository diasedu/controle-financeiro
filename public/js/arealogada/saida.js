$(function()
{
	$("#list").html($("#listPlaceholder").html());

	$("#formFilt").on("submit", function(e)
	{
		e.preventDefault();

		consultar();
	});

	setTimeout(function()
	{
		$("#formFilt").submit();
	}, 600)
	
});

const iconeConsultar = '<i class="fa-solid fa-search" aria-hidden="true"></i>';
const iconeCarregar = '<i class="fa-solid fa-spinner fa-spin"></i>';
const iconeSincronizar = '<i class="fa-solid fa-rotate"></i>';
const iconeSincronizarCarregando = '<i class="fa-solid fa-rotate fa-spin"></i>';

const consultar = function()
{
	$.ajax({
		url: $("#formFilt").attr("action"),
		method: $("#formFilt").attr("method"),
		dataType: "json",
		cache: false,
		beforeSend: function()
		{
			const listPlaceholder = $("#listPlaceholder").html();
			$("#list").html(listPlaceholder);

			$("#formFilt button[type='submit']").html(iconeSincronizarCarregando).prop("disabled", true);
		},
		success: function(response)
		{
			$("#list").html(response["html"]);
			
			const options = {
				fixedHeader: true,
				paging: true,
				lengthChange: false,
				searching: true,
				ordering: true,
				info: false,
				autoWidth: true,
				responsive: true,
				language:
				{
					info: "Exibindo página _PAGE_ de _PAGES_"
				},
			}

			setTimeout(() => {
				$(".table").DataTable(options);
			}, 600);
			
		},
		error: function (a, b, c) {
			console.log(a, b, c);
		},
		complete: function ()
		{
			$("#formFilt button[type='submit']").html(iconeSincronizar).prop("disabled", false);
		}
	});
}

const mudarStatus = function(elemento)
{
	// Encontra a linha (<tr>) onde o checkbox está
    const row = elemento.closest('tr');

    // Captura os valores dos campos dentro da linha
    const id_conta = row.querySelector('select[name="id_conta"]').value;
    const id_paga = row.querySelector('select[name="id_paga"]').value;
    const dt_paga = row.querySelector('input[name="dt_paga"]').value;
    const dt_venc = row.querySelector('input[name="dt_venc"]').value;
	const pago = elemento.checked;

	data = { id_conta, id_paga, dt_paga, dt_venc, pago }

	$.ajax({
		url: "saida/mudarStatus",
		method: "post",
		dataType: "json",
		cache: false,
		data: data,
		beforeSend: function()
		{
			$(elemento).prop("disabled", true);
		},
		success: function(response)
		{
			if (response["error"])
			{
				row.querySelector(".notificacao").style.display = "inline";
				
				const elementoTooltip = row.querySelector('i[data-bs-toggle="tooltip"]');
				$(elementoTooltip).tooltip();

				// Atualiza o conteúdo do tooltip.
				const tooltipInstance = bootstrap.Tooltip.getInstance(elementoTooltip);
				if (tooltipInstance)
				{
					tooltipInstance.setContent({".tooltip-inner": response["html"] });
				} else
				{
					new bootstrap.Tooltip(elementoTooltip);
				}
				
				$(elementoTooltip).css("opacity", 1);

				return;
			}

			consultar();
		},
		error: function (a, b, c) {
			console.log(a, b, c);
		},
		complete: function () {
			$(elemento).prop("disabled", false);
		}
	});
}