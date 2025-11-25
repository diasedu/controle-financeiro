<span class="badge bg-primary mb-3"><i class="fa-solid fa-list"></i> <?= count($listClientes) ?> Produto(s)</span>
<table class="table table-bordered table-hover table-dark" id="table">
	<thead>
		<tr class="bg-dark">
			<th scope="col">Id</th>
			<th scope="col">Nome</th>
			<th scope="col">E-mail</th>
			<th scope="col">Tel.</th>
			<th scope="col">Ações</th>
		</tr>
	</thead>
	<tbody class="table-group-divider">
		<?php if (empty($listClientes)): ?>
			<tr>
				<td colspan="6" class="text-center">Nenhum produto encontrado.</td>
			</tr>
		<?php else: ?>
			<?php foreach ($listClientes as $cliente): ?>
				<tr>
					<td><?= $cliente->getId() ?></td>
					<td><?= esc($cliente->getNome()) ?></td>
					<td><?= esc($cliente->getEmail()) ?></td>
					<td><?= esc($cliente->getTelefone()) ?></td>
					<td>
						<button 
							class="btn btn-primary btn-sm " 
							attr-id="<?= $cliente->getId() ?>"
							onclick="getRegister(this)"
							title="Editar"
						>
							<i class="fa-solid fa-pencil"></i> Editar
						</button>
						<button 
							class="btn btn-danger btn-sm "
							attr-id="<?= $cliente->getId() ?>"
							onclick="deleteRegister(this)"
							title="Excluir"
						>
							<i class="fa-solid fa-trash"></i> Excluir
						</button>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
	</tbody>
</table>


