<span class="badge bg-primary mb-3"><i class="fa-solid fa-list"></i> <?= count($list) ?> Registro(s)</span>
<table class="table table-bordered table-hover shadow" id="table">
	<thead>
		<tr class="bg-dark">
			<th scope="col">Id.</th>
			<th scope="col">Nome</th>
			<th scope="col">Status</th>
			<th scope="col"></th>
		</tr>
	</thead>
	<tbody class="table-group-divider">
		<?php foreach ($list as $row): ?>
			<tr>
				<td><?= $row["id_paga"] ?></td>
				<td><?= $row["nome_paga"] ?></td>
				<td><span class="badge <?= ($row["sta_paga"] == "A" ? "bg-primary" : "bg-danger") ?>"><?= LIST_STATUS[$row["sta_paga"]] ?></span></td>
				<td>
					<button 
						class="btn btn-primary shadow" 
						attr-id_paga="<?= $row["id_paga"] ?>"
						onclick="consultar(this)"
					>Editar</button>
					<button 
						class="btn btn-danger shadow"
						attr-id="<?= $row["id_paga"] ?>"
						onclick="excluir(this)"
					>Excluir</button>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>