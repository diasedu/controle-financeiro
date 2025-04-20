<body>
	<?= view("templates/Menu") ?>
	
	<div class="container">
		<span class="badge bg-primary mb-3"><?= sprintf("%s Filtros", ICONE_FILTRO) ?></span>
		<form id="formFilt" action="pagador/consultar" method="post" class="shadow border rounded p-3 mb-3">
			<div class="row">
				<div class="col-8">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" name="nome_paga" placeholder="Nome">
						<label for="nome_paga">Nome</label>
					</div>
				</div>
				<div class="col-2">
					<div class="form-floating">
						<select class="form-select shadow" name="sta_paga" aria-label="Status" required>
							<option value="A">Ativo</option>
							<option value="I">Inativo</option>
						</select>
						<label for="sta_paga">Status</label>
					</div>
				</div>
				<div class="col-2">
					<div class="d-grid gap-2 d-md-flex">
						<button type="submit" class="btn btn-primary shadow" id="btnConsult">
							<i class="fa-solid fa-search"></i>
						</button>
					</div>
				</div>
			</div>
		</form>

		<!-- Button trigger modal -->
		<div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
			<button type="button" class="btn btn-primary shadow" data-bs-toggle="modal" data-bs-target="#modalInsertUpdate" onclick="clearForm()">
				Novo
			</button>
		</div>

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

		<!-- Modal -->
		<div class="modal fade" id="modalInsertUpdate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalInsertUpdateLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="modalInsertUpdateLabel">Cadastro</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form id="formInsertUpdate" action="pagador/salvar" method="post">
						<input type="text" name="id_paga" style="display: none;">
						<div class="modal-body">
							<div class="row mb-3">
								<div class="col-10">
									<div class="form-floating">
										<input type="text" class="form-control shadow" name="nome_paga" placeholder="Nome" required maxlength="150">
										<label for="nome_paga">Nome</label>
									</div>
								</div>
								<div class="col-2">
									<div class="form-floating">
										<select class="form-select shadow" name="sta_paga" aria-label="Status" required>
											<option value="A">Ativo</option>
											<option value="I">Inativo</option>
										</select>
										<label for="sta_paga" name="sta_paga">Status</label>
									</div>
								</div>
							</div>
						</div>

						<div id="msg"></div>
					
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary shadow" data-bs-dismiss="modal">Fechar</button>
							<button type="submit" class="btn btn-primary shadow">Gravar</button>
						</div>
					</form>
				</div>
			</div>
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
	<script src="<?= base_url(sprintf("public/js/arealogada/pagador.js?v=%d", time())) ?>"></script>
</body>

</html>