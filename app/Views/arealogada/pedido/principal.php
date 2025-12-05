<body class="bg-dark text-white">
	<?= view("templates/menu") ?>
	
	<div class="container-fluid">
		

		<div id="list" class="border rounded p-3 mb-3 overflow-auto"></div>

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
			<div class="modal-dialog modal-xl">
				<div class="modal-content bg-dark text-white">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="modalInsertUpdateLabel">Cadastro</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">

						<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link active" id="pills-selecao-itens" data-bs-toggle="pill" data-bs-target="#pills-selecao" type="button" role="tab" aria-controls="pills-selecao" aria-selected="true">
									Seleção de itens
								</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link disabled text-secondary" id="pills-confirmar-itens-tab" data-bs-toggle="pill" data-bs-target="#pills-confirmar-itens" type="button" role="tab" aria-controls="pills-confirmar-itens" aria-selected="false">Confirmar</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link disabled text-secondary" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link disabled text-secondary" id="pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#pills-disabled" type="button" role="tab" aria-controls="pills-disabled" aria-selected="false" disabled>Disabled</button>
							</li>
						</ul>

						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-selecao" role="tabpanel" aria-labelledby="pills-selecao-itens" tabindex="0">
								<form id="form-add-itens-selecionados" action="pedido/add-itens-selecionados" method="get">
									<table class="table table-bordered table-hover table-dark">
										<thead>
											<th></th>
											<th>Produto</th>
										</thead>
										<tbody>
											<?php foreach ($produtos as $produto): ?>
												<tr>
													<td>
														<div class="form-check">
															<input 
																class="form-check-input itens" 
																type="checkbox" 
																name="checkbox-produto[]"
																data-id="<?= $produto->getId() ?>"	
															>
														</div>
													</td>
													<td><?=  $produto->getNome() ?></td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
									<button type="submit" class="btn btn-primary" id="btn-add-itens"><i class="fa-solid fa-circle-plus"></i> Adicionar</button>
								</form>
							
							</div>
							<div class="tab-pane fade" id="pills-confirmar-itens" role="tabpanel" aria-labelledby="pills-confirmar-itens-tab" tabindex="0">
								<div id="conteudo-confirmar-itens"></div>
							</div>
							<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">...</div>
							<div class="tab-pane fade" id="pills-disabled" role="tabpanel" aria-labelledby="pills-disabled-tab" tabindex="0">...</div>
						</div>
					</div>

					<div id="msg"></div>
				
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary " data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Fechar</button>
					</div>
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
	<script src="<?= base_url(sprintf("js/arealogada/pedido.js?v=%d", time())) ?>"></script>
</body>

</html>


