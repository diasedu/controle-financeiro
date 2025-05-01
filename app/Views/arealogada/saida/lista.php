<div class="alert alert-warning shadow" role="alert">
	<h6><?= sprintf("%s Qtd. contas a pagar: %d", ICONE_ATENCAO, count($list["listNaoPaga"])) ?></h6>
</div>

<table class="table table-bordered table-hover shadow mb-3">
	<thead>
		<tr class="bg-dark">
			<th scope="col">Conta</th>
			<th scope="col">Pagador</th>
			<th scope="col">Dt. Pag.</th>
			<th scope="col">Dt. Venc.</th>
			<th scope="col" data-orderable="false">Obs.</th>
			<th scope="col" data-orderable="false"></th>
		</tr>
	</thead>
	<tbody class="table-group-divider">
		<?php foreach ($list["listNaoPaga"] as $row): ?>
			<tr>
				<td>
					<select class="form-control" name="id_conta" disabled>
						<?php foreach ($listConta as $rowConta): ?>
							<option 
								value="<?= $rowConta["id_conta"] ?>" 
								<?= ($rowConta["id_conta"] == $row["id_conta"] ? "selected" : null) ?>
							><?= $rowConta["desc_conta"] ?></option>
						<?php endforeach; ?>
					</select>
				</td>
				<td>
					<select name="id_paga" id="" class="form-control">
						<option value="" disabled selected>Selecione</option>
						<?php foreach ($listPagador as $rowPaga): ?>
							<option value="<?= $rowPaga["id_paga"] ?>"><?= $rowPaga["nome_paga"] ?></option>
						<?php endforeach; ?>
					</select>
				</td>
				<td><input type="date" name="dt_paga" class="form-control" value="<?= $row["dt_paga"] ?>"/></td>
				<td><input type="date" name="dt_venc" class="form-control" value="<?= $row["dt_venc"] ?>" disabled/></td>
				<td>
					<span class="notificacao" style="display: none;">
						<i 
							class="fa-solid fa-triangle-exclamation text-warning tooltip-msg" 
							data-bs-toggle="tooltip" 
							data-bs-html="true" 
							data-bs-title="Atenção"
							aria-hidden="true"
							style="cursor: pointer;"
						></i>
					</span>
				</td>
				<td>
					<input 
						type="checkbox" 
						name="pago" 
						class="form-check-input" 
						onchange="mudarStatus(this)"
					/>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<hr>

<div class="alert alert-success shadow" role="alert">
	<h6><?= sprintf("%s Qtd. contas pagas: %d", ICONE_SUCESSO, count($list["listPaga"])) ?></h6>
</div>

<table class="table table-bordered table-hover shadow">
	<thead>
		<tr class="bg-dark">
			<th scope="col">Saída</th>
			<th scope="col">Informações</th>
		</tr>
	</thead>
	<tbody class="table-group-divider">
		<?php foreach ($list["listPaga"] as $row): ?>
			<tr>
				<td>
					<?php 
						foreach ($listConta as $rowConta)
						{
							if ($rowConta["id_conta"] == $row["id_conta"])
							{
								echo sprintf("%s <span class='text-muted' style='font-size: 12px;'>referente a %s</span>", $rowConta["desc_conta"], $row["ref"]);
							}
						}
					?>
				</td>
				
				<td>
					<p class="badge bg-success"><?= sprintf("%s Pago em %s", ICONE_SUCESSO, date("d/m/Y", strtotime($row["dt_paga"])), ) ?></p>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>