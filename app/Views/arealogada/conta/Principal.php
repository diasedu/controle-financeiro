<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="<?= base_url("public/css/libs/bootstrap.min.css") ?>">
	<link rel="stylesheet" href="<?= base_url("public/css/libs/datatables.min.css") ?>">
	<link rel="stylesheet" href="<?= base_url("public/css/libs/datatables.bootstrap5.min.css") ?>">
	<script src="<?= base_url("public/js/libs/bootstrap.min.js") ?>"></script>
	<script src="<?= base_url("public/js/libs/bootstrap.bundle.min.js") ?>"></script>
	<script src="<?= base_url("public/js/libs/jquery.min.js") ?>"></script>
	<script src="<?= base_url("public/js/libs/jquery.mask.min.js") ?>"></script>
	<script src="<?= base_url("public/js/libs/datatables.min.js") ?>"></script>
	<script src="<?= base_url("public/js/libs/datatables.bootstrap5.min.js") ?>"></script>
	<script src="<?= base_url("public/js/libs/fontawesome.min.js") ?>"></script>
</head>

<body>
	<?= view("templates/Menu") ?>
	
	<div class="container">
		<span class="badge bg-primary mb-3"><i class="fa-solid fa-filter"></i> Filtros</span>
		<form id="formFilt" action="conta/getList" method="post" class="shadow border rounded p-3 mb-3">
			<div class="row">
				<div class="col-2">
					<div class="form-floating mb-3">
						<input type="date" class="form-control" id="filt_data_inicio" name="filt_data_inicio" placeholder="Data Início">
						<label for="data_inicio">Data Início</label>
					</div>
				</div>
				<div class="col-2">
					<div class="form-floating mb-3">
						<input type="date" class="form-control" id="fiilt_data_fim" name="filt_data_fim" placeholder="Data Fim">
						<label for="filt_data_fim">Data Fim</label>
					</div>
				</div>
				<div class="col-2">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="fiilt_desc_conta" name="filt_desc_conta" placeholder="Descrição">
						<label for="filt_desc_conta">Descrição</label>
					</div>
				</div>
				<div class="col-2">
					<div class="form-floating">
						<select class="form-select shadow" id="filt_sta_conta" name="filt_sta_conta" aria-label="Status" required>
							<option value="A">Ativo</option>
							<option value="I">Inativo</option>
						</select>
						<label for="filt_sta_conta">Status</label>
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
						<td><span class="placeholder col-12"></span></td>
						<td><span class="placeholder col-12"></span></td>
					</tr>
					<tr>
						<td><span class="placeholder col-12"></span></td>
						<td><span class="placeholder col-12"></span></td>
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
						<td><span class="placeholder col-12"></span></td>
						<td><span class="placeholder col-12"></span></td>
					</tr>
					<tr>
						<td><span class="placeholder col-12"></span></td>
						<td><span class="placeholder col-12"></span></td>
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
						<td><span class="placeholder col-12"></span></td>
						<td><span class="placeholder col-12"></span></td>
					</tr>
					<tr>
						<td><span class="placeholder col-12"></span></td>
						<td><span class="placeholder col-12"></span></td>
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
						<h1 class="modal-title fs-5" id="modalInsertUpdateLabel">Cadastro de contas</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form id="formInsertUpdate" action="conta/insertUpdate" method="post">
						<input type="hidden" id="id_conta" name="id_conta">
						<div class="modal-body">
							<div class="row mb-3">
								<div class="col-12">
									<div class="form-floating">
										<input type="text" class="form-control shadow" id="desc_conta" name="desc_conta" placeholder="Descrição" required>
										<label for="desc_conta">Descrição</label>
									</div>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-4">
									<div class="form-floating">
										<input type="text" class="form-control shadow" id="valor_conta" name="valor_conta" placeholder="Valor" required>
										<label for="valor_conta">Valor</label>
									</div>
								</div>
								<div class="col-4">
									<div class="form-floating">
										<select class="form-select shadow" id="dia_venct" name="dia_venct" aria-label="Dia do Vencimento" required>
											<?php 
												for ($i = 1; $i <= 31; $i++): 
													?>
													<option value="<?= $i ?>" <?= ($i == date("d") ? "selected" : "") ?>><?= $i ?></option>
											<?php endfor; ?>
										</select>
										<label for="dia_venct">Dia do Vencimento</label>
									</div>
								</div>
								<div class="col-4">
									<div class="form-floating">
										<select class="form-select shadow" id="sta_conta" name="sta_conta" aria-label="Status" required>
											<option value="A">Ativo</option>
											<option value="I">Inativo</option>
										</select>
										<label for="sta_conta" name="sta_conta">Status</label>
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
	<script src="<?= base_url(sprintf("public/js/arealogada/conta.js?v=%d", time())) ?>"></script>
</body>

</html>