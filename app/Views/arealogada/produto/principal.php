<body class="bg-dark text-white">
	<?= view("templates/Menu") ?>
	
	<div class="container-fluid">
		<form id="formFilt" action="produto/getList" method="post" class=" border rounded p-3 mb-3">
			<span class="badge bg-primary mb-3"><i class="fa-solid fa-filter"></i> Filtros</span>
			<div class="row">
				<div class="col-md-6">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="filt_nome" name="filt_nome" placeholder="Nome">
						<label for="filt_nome">Nome</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating mb-3">
						<select class="form-select " id="filt_tipo_cobranca" name="filt_tipo_cobranca" aria-label="Tipo de Cobrança">
							<option value="">Todos</option>
							<option value="unidade">Por unidade</option>
							<option value="quilo">Por quilo</option>
						</select>
						<label for="filt_tipo_cobranca">Forma de cobrança</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating">
						<select class="form-select " id="filt_status" name="filt_status" aria-label="Status">
							<option value="">Todos</option>
							<option value="1">Ativo</option>
							<option value="0">Inativo</option>
						</select>
						<label for="filt_status">Status</label>
					</div>
				</div>
			</div>
			<div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
				<button type="submit" class="btn btn-primary " id="btnConsult">
					<i class="fa-solid fa-search"></i>
				</button>
			</div>
		</form>

		<div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
			<button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modalInsertUpdate" onclick="clearForm()">
				<i class="fa-solid fa-plus"></i>
			</button>
		</div>

		<div id="list" class=" border rounded p-3 mb-3"></div>

		<div id="listPlaceholder" style="display: none;">
			<table class="table table-dark placeholder-glow">
				<thead>
					<tr class="bg-dark">
						<th scope="col"><span class="placeholder col-12"></span></th>
						<th scope="col"><span class="placeholder col-12"></span></th>
						<th scope="col"><span class="placeholder col-12"></span></th>
						<th scope="col"><span class="placeholder col-12"></span></th>
						<th scope="col"><span class="placeholder col-12"></span></th>
						<th scope="col"><span class="placeholder col-12"></span></th>
					</tr>
				</thead>
				<tbody class="table-group-divider">
					<?php for ($i = 0; $i < 5; $i++): ?>
						<tr class="placeholder-glow">
							<td><span class="placeholder col-12"></span></td>
							<td><span class="placeholder col-12"></span></td>
							<td><span class="placeholder col-12"></span></td>
							<td><span class="placeholder col-12"></span></td>
							<td><span class="placeholder col-12"></span></td>
							<td><span class="placeholder col-12"></span></td>
						</tr>
					<?php endfor; ?>
				</tbody>
			</table>
		</div>

		<div class="modal fade" id="modalInsertUpdate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalInsertUpdateLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="modalInsertUpdateLabel">Cadastro de Produtos</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form id="formInsertUpdate" action="produto/insertUpdate" method="post">
						<input type="hidden" id="id" name="id">
						<div class="modal-body">
							<div class="row mb-3">
								<div class="col-12">
									<div class="form-floating">
										<input type="text" class="form-control " id="nome" name="nome" placeholder="Nome" required>
										<label for="nome">Nome</label>
									</div>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-6 mb-3 mb-md-0">
									<div class="form-floating">
										<input type="number" class="form-control" step="0.01" min="0" id="preco" name="preco" placeholder="Preço" required>
										<label for="preco">Preço (R$)</label>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-floating">
										<select class="form-select " id="tipo_cobranca" name="tipo_cobranca" aria-label="Tipo de cobrança" required>
											<option value="unidade">Por unidade</option>
											<option value="quilo">Por quilo</option>
										</select>
										<label for="tipo_cobranca">Forma de cobrança</label>
									</div>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-12">
									<div class="form-floating">
										<select class="form-select " id="status" name="status" aria-label="Status" required>
											<option value="1">Ativo</option>
											<option value="0">Inativo</option>
										</select>
										<label for="status">Status</label>
									</div>
								</div>
							</div>
						</div>

						<div id="msg"></div>
					
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Fechar</button>
							<button type="submit" class="btn btn-primary ">Gravar</button>
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
						<p>Deseja realmente excluir este produto?</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
						<button type="button" class="btn btn-danger" id="btnDelete">Excluir</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="<?= base_url(sprintf("js/arealogada/produto.js?v=%d", time())) ?>"></script>
</body>

</html>


