<span class="badge bg-primary mb-3"><i class="fa-solid fa-list"></i> <?= count($listProdutos) ?> Produto(s)</span>
<table class="table table-bordered table-hover table-dark" id="table">
	<thead>
		<tr class="bg-dark">
			<th scope="col">Id</th>
			<th scope="col">Nome</th>
			<th scope="col">Preço</th>
			<th scope="col">Preço por quilo</th>
			<th scope="col">Status</th>
			<th scope="col">Ações</th>
		</tr>
	</thead>
	<tbody class="table-group-divider">
		<?php if (empty($listProdutos)): ?>
			<tr>
				<td colspan="6" class="text-center">Nenhum produto encontrado.</td>
			</tr>
		<?php else: ?>
			<?php foreach ($listProdutos as $produto): ?>
				<tr>
					<td><?= $produto->getId() ?></td>
					<td><?= esc($produto->getNome()) ?></td>
					<td>R$ <?= number_format($produto->getPreco() ?? 0, 2, ',', '.') ?></td>
					<td>R$ <?= number_format($produto->getPrecoKg() ?? 0, 2, ',', '.') ?></td>
					<td>
						<?php if ($produto->isAtivo()): ?>
							<span class="badge bg-success">Ativo</span>
						<?php else: ?>
							<span class="badge bg-danger">Inativo</span>
						<?php endif; ?>
					</td>
					<td>
						<button 
							class="btn btn-primary btn-sm " 
							attr-id="<?= $produto->getId() ?>"
							onclick="getRegister(this)"
							title="Editar"
						>
							<i class="fa-solid fa-pencil"></i>
						</button>
						<button 
							class="btn btn-danger btn-sm "
							attr-id="<?= $produto->getId() ?>"
							onclick="deleteRegister(this)"
							title="Excluir"
						>
							<i class="fa-solid fa-trash"></i>
						</button>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
	</tbody>
</table>


