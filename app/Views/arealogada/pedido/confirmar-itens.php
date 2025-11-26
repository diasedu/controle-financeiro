<div class="row mb-2">
    <div class="col-6">
        <div class="form-floating">
            <input 
                type="text" 
                class="form-control" 
                id="nome_usua" 
                name="nome_usua" 
                placeholder="Nome" 
                value="<?= session()->get('nome_usua') ?>"
                readonly
            >
            <label for="nome_usua">Comprador</label>
        </div>
    </div>
    <div class="col-2">
        <div class="form-floating">
            <input 
                type="date" 
                class="form-control" 
                id="data_pedido" 
                name="data_pedido" 
                placeholder="Data do Pedido" 
                value="<?= date('Y-m-d') ?>"
                readonly
            >
            <label for="data_pedido">Data</label>
        </div>
    </div>
</div>

<table class="table table-bordered table-hover table-dark table-responsive">
    <thead>
        <th>Produto</th>
        <th>Preço (por unidade)</th>
        <th>Preço (por quilo)</th>
        <th>Qtd</th>
        <th>Tipo de Cobrança</th>
    </thead>
    <tbody>
        <?php foreach ($produtos as $produto): ?>
            <tr>
                <td><?= $produto->getNome() ?></td>
                <td><?= $produto->getPreco() ?></td>
                <td><?= $produto->getPrecoKg() ?></td>
                <td>
                    <div class="form-floating">
                        <input 
                            type="text" 
                            class="form-control"  
                            name="" 
                            placeholder="Nome" 
                            value="1"
                            
                        >
                        <label for="qtd">Qtd</label>
                    </div>
                </td>
                <td></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<button type="submit" class="btn btn-primary" id="btn-confirmar-itens"><i class="fa-solid fa-circle-check"></i> Confirmar</button>