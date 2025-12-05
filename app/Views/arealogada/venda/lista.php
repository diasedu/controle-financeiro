<span class="badge bg-primary mb-3"><i class="fa-solid fa-list"></i> <?= count($vendas) ?> Venda(s)</span>
<table class="table table-bordered table-hover table-dark table-responsible" id="table">
	<thead>
		<tr class="bg-dark">
			<th scope="col">Data</th>
			<th scope="col">Valor</th>
			<th scope="col">Forma de pagamento</th>
			<th scope="col" style="width: 5%;">Ações</th>
		</tr>
	</thead>
	<tbody class="table-group-divider">
		<?php if (empty($vendas)): ?>
			<tr>
				<td colspan="6" class="text-center">Nenhum produto encontrado.</td>
			</tr>
		<?php else: ?>
			<?php 
				$total = 0;
				foreach ($vendas as $venda): 
					$total += $venda->getValorTotal();
			?>
				<tr>
					<td><?= $venda->getCreationDate(true) ?></td>
					<td><?= $venda->getValorTotalFormatado() ?></td>
					<td><?= $venda->getFormaPagamento(true) ?></td>
					<td>
						<button 
							class="btn btn-primary btn-sm mb-2" 
							data-id="<?= $venda->getId() ?>"
							onclick="getVenda(<?= $venda->getId() ?>)"
							title="Editar"
						>
							<i class="fa-solid fa-pencil"></i>
						</button>
						<button 
							class="btn btn-danger btn-sm mb-2"
							data-id="<?= $venda->getId() ?>"
							onclick="excluir(this)"
							title="Excluir"
						>
							<i class="fa-solid fa-trash"></i>
						</button>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="4">Total <span class="badge bg-success"><?= number_format($total, 2, ',', '.') ?></span></td>
		</tr>
	</tfoot>
</table>


