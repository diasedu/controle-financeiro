<body class="bg-dark text-white">
	<?= view("templates/menu") ?>
	
	<div class="container-fluid">
		<form id="form-buscar" action="venda/buscar" method="post" class=" border rounded p-3 mb-3">
			<span class="badge bg-primary mb-3"><i class="fa-solid fa-filter"></i> Filtros</span>
			<div class="row mb-2">
				<div class="col-md-6">
					<div class="form-floating mb-3">
						<input type="date" class="form-control" id="data-inicio" name="data-inicio" placeholder="Data início">
						<label for="data-inicio">Data início</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-floating mb-3">
						<input type="date" class="form-control" id="data-fim" name="data-fim" placeholder="Data início">
						<label for="data-fim">Data fim</label>
					</div>
				</div>
			</div>
			<div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
				<button type="submit" class="btn btn-primary" id="btn-consultar">
					<i class="fa-solid fa-search"></i>
				</button>
			</div>
		</form>
		<div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalIncluirVenda">
				<i class="fa-solid fa-plus"></i>
			</button>
		</div>

		<div id="conteudo-vendas"></div>
	</div>

	<div class="modal fade" id="modalIncluirVenda" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalIncluirVendaLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div class="modal-content bg-dark text-white">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="modalIncluirVendaLabel">Cadastro</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">

					<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active" id="pills-selecao-itens" data-bs-toggle="pill" data-bs-target="#pills-selecao" type="button" role="tab" aria-controls="pills-selecao" aria-selected="true">
								<i class="fa-solid fa-check-double"></i> Seleção de itens
							</button>
						</li>
						<li class="nav-item" role="presentation">
							<button 
								class="nav-link disabled text-secondary" 
								id="pills-itens-adicionados-tab" 
								data-bs-toggle="pill" 
								data-bs-target="#pills-itens-adicionados" 
								type="button" 
								role="tab" 
								aria-controls="pills-itens-adicionados" 
								aria-selected="false"
							><i class="fa-solid fa-clipboard-check"></i> Finalizar</button>
						</li>
					</ul>

					<div class="tab-content" id="pills-tabContent">
						<div class="tab-pane fade show active" id="pills-selecao" role="tabpanel" aria-labelledby="pills-selecao-itens" tabindex="0">
							<div id="conteudo-incluir-itens" class="mb-2">
								<div class="row mb-3">
									<div class="col">
										<div class="form-floating">
											<input class="form-control" id="input-pesquisa">
											<label for="input-pesquisar">Pesquisar</label>
										</div>
									</div>
								</div>

								<div class="row mb-3 overflow-auto">
									<div class="col-12">
										<table class="table table-bordered table-hover table-dark table-responsive d-none" id="tabela-produtos">
											<thead>
												<tr class="bg-dark">
													<th scope="col"><input type="checkbox" class="form-check" id="check-all"></th>
													<th scope="col">Nome</th>
													<th scope="col">Preço</th>
												</tr>
											</thead>
											<tbody class="table-group-divider">
												<?php if (empty($produtos)): ?>
													<tr>
														<td colspan="6" class="text-center">Nenhum produto encontrado.</td>
													</tr>
												<?php else: ?>
													<?php foreach ($produtos as $produto): ?>
														<tr>
															<td><input type="checkbox" class="form-check check-produto" data-id="<?= $produto->getId() ?>"></td>
															<td class="nome-produto"><?= esc($produto->getNome()) ?></td>
															<td><?= esc($produto->getPreco()) ?></td>
														</tr>
													<?php endforeach; ?>
												<?php endif; ?>
											</tbody>
										</table>
									</div>
								</div>

								
								<button type="button" class="btn btn-primary" id="btn-add-itens"><i class="fa-solid fa-plus"></i></button>
							</div>
						</div>
						<div class="tab-pane fade" id="pills-itens-adicionados" role="tabpanel" aria-labelledby="pills-itens-adicionados-tab" tabindex="0">
							<div id="conteudo-itens-adicionados"></div>
						</div>
					</div>
				</div>
			
				<div class="modal-footer">
					<div id="msg"></div>
					<button type="button" class="btn btn-secondary" id="btnFecharModalIncluirVenda" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Fechar</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalEditar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div class="modal-content bg-dark text-white">
				<form action="venda/editar" method="post" id="form-editar">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="modalEditarLabel">Cadastro</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div id="conteudo-formulario"></div>
					</div>
				
					<div class="modal-footer">
						<div id="modal-editar-msg"></div>

						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Fechar</button>
						<button 
							type="submit" 
							class="btn btn-primary" 
							id="btn-salvar-edicao" 
						><i class="fa-solid fa-floppy-disk"></i> Gravar</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalIncluirEditarItem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalIncluirEditarItemLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div class="modal-content bg-dark text-white">
				<form action="venda/incluir-editar-item" method="post" id="form-incluir-editar-item">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="modalIncluirEditarItemLabel">Cadastro</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						
						<div class="row mb-3">
							<div class="col">
								<div class="form-floating">
									<input class="form-control" id="input-pesquisa-produto" class="input-pesquisa-produto">
									<label for="input-pesquisa-produto">Pesquisar</label>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col">
								<label for="produto-id">Produto</label>
								<select 
									class="form-control" 
									id="produto-id" 
									name="produto-id" 
									aria-label="Produto" 
									onchange="buscarDadosDoProduto(this.value)"
									size="3"
								>
									<?php foreach ($produtos as $produto): ?>
										<option value="<?=  $produto->getId() ?>"><?=  $produto->getNome() ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-6">
								<div class="form-floating">
									<div class="form-floating mb-3">
										<input type="number" class="form-control" id="produto-qtd" name="produto-qtd" placeholder="Quantidade" value="1">
										<label for="produto-qtd">Quantidade</label>
									</div>
								</div>
							</div>
							<div class="col-6">
								<div class="form-floating">
									<div class="form-floating mb-3">
										<input type="number" class="form-control" id="produto-preco" name="produto-preco" placeholder="Preço" readonly>
										<label for="produto-preco">Preço</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				
					<div class="modal-footer">
						<div id="modal-incluir-editar-item-msg"></div>

						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Fechar</button>
						<button 
							type="submit" 
							class="btn btn-primary" 
							id="btn-salvar-item" 
						><i class="fa-solid fa-floppy-disk"></i> Gravar</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div id="loader-overlay" class="d-none">
		<svg
			xmlns="http://www.w3.org/2000/svg"
			style="margin:auto; background:none; display:block"
			width="60px"
			height="60px"
			viewBox="0 0 100 100"
		>
			<circle
				cx="50"
				cy="50"
				fill="none"
				stroke="#3498db"
				stroke-width="8"
				r="32"
				stroke-dasharray="50.26548245743669 50.26548245743669"
			>
				<animateTransform
					attributeName="transform"
					type="rotate"
					dur="1s"
					repeatCount="indefinite"
					from="0 50 50"
					to="360 50 50"
				/>
			</circle>
		</svg>
	</div>


	<script src="<?= base_url(sprintf("js/arealogada/venda.js?v=%d", time())) ?>"></script>
</body>

</html>


