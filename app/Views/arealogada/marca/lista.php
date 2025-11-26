<span class="badge bg-primary mb-3"><i class="fa-solid fa-list"></i> <?= count($listMarcas) ?> Marca(s)</span>
<table class="table table-bordered table-hover table-dark" id="table">
	<thead>
		<tr class="bg-dark">
			<th scope="col">Id</th>
			<th scope="col">Nome</th>
			<th scope="col">Status</th>
			<th scope="col">Ações</th>
		</tr>
	</thead>
	<tbody class="table-group-divider">
		<?php if (empty($listMarcas)): ?>
			<tr>
				<td colspan="4" class="text-center">Nenhuma marca encontrada.</td>
			</tr>
		<?php else: ?>
			<?php foreach ($listMarcas as $marca): ?>
				<tr>
					<td><?= $marca->getId() ?></td>
					<td><?= esc($marca->getNome()) ?></td>
					<td>
						<?php if ($marca->isAtivo()): ?>
							<span class="badge bg-success">Ativo</span>
						<?php else: ?>
							<span class="badge bg-danger">Inativo</span>
						<?php endif; ?>
					</td>
					<td>
						<button 
							class="btn btn-primary btn-sm " 
							attr-id="<?= $marca->getId() ?>"
							onclick="getRegister(this)"
							title="Editar"
						>
							<i class="fa-solid fa-pencil"></i> 
						</button>
						<button 
							class="btn btn-danger btn-sm "
							attr-id="<?= $marca->getId() ?>"
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


