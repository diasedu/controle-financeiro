<span class="badge bg-primary mb-3"><i class="fa-solid fa-list"></i> <?= count($listContas) ?> Registro(s)</span>
<table class="table table-bordered table-hover shadow" id="table">
	<thead>
		<tr class="bg-dark">
			<th scope="col">Id.</th>
			<th scope="col">Descrição</th>
			<th scope="col">Valor</th>
			<th scope="col">Dia do Vencimento</th>
			<th scope="col">Status</th>
			<th scope="col">Ações</th>
		</tr>
	</thead>
	<tbody class="table-group-divider">
		<?php foreach ($listContas as $conta): ?>
			<tr>
				<td><?= $conta["id_conta"] ?></td>
				<td><?= $conta["desc_conta"] ?></td>
				<td>R$ <?= number_format($conta["valor_conta"], 2, ",", ".") ?></td>
				<td><?= $conta["dia_venct"] ?></td>
				<td><?= $conta["sta_conta"] ?></td>
				<td>
					<button 
						class="btn btn-primary shadow" 
						attr-id="<?= $conta["id_conta"] ?>"
						onclick="getRegister(this)"
					>Editar</button>
					<button 
						class="btn btn-danger shadow"
						attr-id="<?= $conta["id_conta"] ?>"
						onclick="deleteRegister(this)"
					>Excluir</button>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>