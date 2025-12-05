<input type="hidden" id="id" name="id" value="<?= $venda->getId() ?>">
<div class="row mb-3">
	<div class="col-2">
		<div class="form-floating">
			<input type="date" class="form-control" placeholder="Data" value="<?= $venda->getCreationDateWithFormat('Y-m-d') ?>" disabled>
			<label for="data">Data</label>
		</div>
	</div>
	<div class="col-5">
		<div class="form-floating">
			<select class="form-select " id="forma_pagamento" name="forma_pagamento" aria-label="Forma de pagamento">
				<option value="dinheiro" <?= $venda->getFormaPagamento() === 'dinheiro' ? 'selected' : null ?>>Dinheiro</option>
				<option value="pix" <?= $venda->getFormaPagamento() === 'pix' ? 'selected' : null ?>>Pix</option>
				<option value="credito" <?= $venda->getFormaPagamento() === 'credito' ? 'selected' : null ?>>Crédito</option>
				<option value="debito" <?= $venda->getFormaPagamento() === 'debito' ? 'selected' : null ?>>Débito</option>
			</select>
			<label for="forma_pagamento">Forma de Pagamento</label>
		</div>
	</div>
	<div class="col-5">
		<div class="form-floating">
			<select class="form-select " id="status" name="status" aria-label="Status">
				<option value="pendente" <?= $venda->getStatus() === 'pendente' ? 'selected' : null ?>>Pendente</option>
				<option value="pago" <?= $venda->getStatus() === 'pago' ? 'selected' : null ?>>Pago</option>
				<option value="cancelado" <?= $venda->getStatus() === 'cancelado' ? 'selected' : null ?>>Cancelado</option>
			</select>
			<label for="status">Status</label>
		</div>
	</div>
</div>

<div class="row mb-3">
	<div class="col">
		<div class="form-floating">
			<textarea class="form-control" name="observacoes" id="observacoes"><?= esc($venda->getObservacoes()) ?></textarea>
			<label for="observacoes">Observações</label>
		</div>
	</div>
</div>

<span class="badge bg-primary mb-3"><i class="fa-solid fa-list"></i> <?= count($itens) ?> Produto(s) vendido(s)</span>

<div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
	<button 
		type="button" 
		class="btn btn-primary" 
		onclick="abrirModalIncluirEditarItem()"
	>
		<i class="fa-solid fa-plus"></i>
	</button>
</div>
<table class="table table-bordered table-hover table-dark" id="table">
	<thead>
		<tr class="bg-dark">
			<th scope="col">Nome</th>
			<th scope="col">Qtd.</th>
			<th scope="col">Preço</th>
			<th scope="col">Preço total</th>
			<th scope="col">Ações</th>

		</tr>
	</thead>
	<tbody class="table-group-divider">
		<?php if (empty($itens)): ?>
			<tr>
				<td colspan="5" class="text-center">Nenhum produto encontrado.</td>
			</tr>
		<?php else: ?>
			<?php foreach ($itens as $item): ?>
				<tr>
					<td><?= esc($item->getProdutoNome()) ?></td>
					<td>
						<span class="badge bg-danger">
							<?= $item->getQuantidade() ?>
						</span>
					</td>
					<td>R$ <?= $item->getPrecoUnitarioFormatado('BR') ?></td>
					<td>R$ <?= $item->getPrecoTotalFormatado('BR') ?></td>
					<td>
						<button 
							type="button"
							class="btn btn-primary btn-sm mb-2" 
							data-id="<?= $item->getId() ?>"
							data-venda-id="<?= $venda->getId() ?>"
							onclick="editarItem(this)"
							title="Editar"
						>
							<i class="fa-solid fa-pencil"></i>
						</button>
						<button
							type="button"
							class="btn btn-danger btn-sm mb-2"
							data-id="<?= $item->getId() ?>"
							data-venda-id="<?= $venda->getId() ?>"
							onclick="excluirItem(this)"
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
            <td colspan="3">Total</td>
            <td>
				<span class="badge bg-success">
					R$ <?= $venda->getValorTotalFormatado() ?>
				</span>
			</td>
			<td></td>
        </tr>
    </tfoot>
</table>

