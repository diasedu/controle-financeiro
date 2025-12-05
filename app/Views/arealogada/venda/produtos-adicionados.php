<?php
	$precoTotal = 0;
?>
<span class="badge bg-primary mb-3"><i class="fa-solid fa-list"></i> <?= count($produtos) ?> Produto(s)</span>
<table class="table table-bordered table-hover table-dark" id="table">
	<thead>
		<tr class="bg-dark">
			<th scope="col">Nome</th>
			<th scope="col">Preço</th>
			<th scope="col">Qtd.</th>
			<th scope="col">Preço total</th>
		</tr>
	</thead>
	<tbody class="table-group-divider">
		<?php if (empty($produtos)): ?>
			<tr>
				<td colspan="6" class="text-center">Nenhum produto encontrado.</td>
			</tr>
		<?php else: ?>
			<?php 
				foreach ($produtos as $produto):
					$precoTotal += $produto->getPreco();
				?>

				<tr>
					<td><?= esc($produto->getNome()) ?></td>
					<td>R$ <?= number_format($produto->getPreco() ?? 0, 2, ',', '.') ?></td>
					<td>
						<input 
							type="number" 
							class="form-control qtd" 
							data-id="<?= $produto->getId() ?>"
							data-preco="<?= $produto->getPreco() ?>"
							value="1"
							onkeyup="recalcularPrecoTotalUnitario(this); recalcularPrecoTotal();"
						>
					</td>
					<td>
						<input 
							type="number" 
							class="form-control preco-total-por-produto" 
							data-id="<?= $produto->getId() ?>"
							value="<?= $produto->getPreco() ?>"
							readonly
						>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
	</tbody>
	<tfoot>
        <tr>
            <td colspan="3">Total</td>
            <td>
				<input 
					type="number" 
					id="preco-total"
					class="form-control" 
					value="<?= $precoTotal ?>"
					readonly
				>
			</td>
        </tr>
    </tfoot>
</table>

<button type="button" class="btn btn-primary" id="btn-salvar-venda" onclick="salvarVenda()"><i class="fa-solid fa-floppy-disk"></i> Gravar</button>


