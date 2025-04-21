<body>
	<?= view("templates/Menu") ?>
	
	<div class="container">
		<form id="formFilt" action="saida/consultar" method="post" class="shadow border rounded p-3 mb-3">
			<div class="col-2">
				<div class="d-grid gap-2 d-md-flex">
					<button type="submit" class="btn btn-primary shadow" id="btnConsult">
						<?= ICONE_SINCRONIZAR ?>
					</button>
				</div>
			</div>
		</form>

		<!-- Lista Dinâmica -->
		<div id="list" class="shadow border rounded p-3 mb-3"></div>

		<!-- Lista com "placeholders" -->
		<div id="listPlaceholder" style="display: none;">
			<table class="table placeholder-glow">
				<thead>
					<tr class="bg-dark">
						<th scope="col"><span class="placeholder col-12"></span></th>
						<th scope="col"><span class="placeholder col-12"></span></th>
						<th scope="col"><span class="placeholder col-12"></span></th>
						<th scope="col"><span class="placeholder col-12"></span></th>
					</tr>
				</thead>
				<tbody class="table-group-divider">
					<tr class="placeholder-glow">
						<td><span class="placeholder col-12"></span></td>
						<td><span class="placeholder col-12"></span></td>
						<td><span class="placeholder col-12"></span></td>
						<td><span class="placeholder col-12"></span></td>
					</tr>
					<tr>
						<td><span class="placeholder col-12"></span></td>
						<td><span class="placeholder col-12"></span></td>
						<td><span class="placeholder col-12"></span></td>
						<td><span class="placeholder col-12"></span></td>
					</tr>
					<tr>
						<td><span class="placeholder col-12"></span></td>
						<td><span class="placeholder col-12"></span></td>
						<td><span class="placeholder col-12"></span></td>
						<td><span class="placeholder col-12"></span></td>
					</tr>
					<tr>
						<td><span class="placeholder col-12"></span></td>
						<td><span class="placeholder col-12"></span></td>
						<td><span class="placeholder col-12"></span></td>
						<td><span class="placeholder col-12"></span></td>
					</tr>
					<tr>
						<td><span class="placeholder col-12"></span></td>
						<td><span class="placeholder col-12"></span></td>
						<td><span class="placeholder col-12"></span></td>
						<td><span class="placeholder col-12"></span></td>
					</tr>
					<tr>
						<td><span class="placeholder col-12"></span></td>
						<td><span class="placeholder col-12"></span></td>
						<td><span class="placeholder col-12"></span></td>
						<td><span class="placeholder col-12"></span></td>
					</tr>
					<tr>
						<td><span class="placeholder col-12"></span></td>
						<td><span class="placeholder col-12"></span></td>
						<td><span class="placeholder col-12"></span></td>
						<td><span class="placeholder col-12"></span></td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="modal fade" id="modalConfirmation" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Confirmar</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<p>Deseja realmente excluir o registro?</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
						<button type="button" class="btn btn-danger" id="btnDelete">Excluir</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="<?= base_url(sprintf("public/js/arealogada/saida.js?v=%d", time())) ?>"></script>
</body>

</html>