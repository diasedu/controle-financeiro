<?php
namespace App\Services;

use App\Controllers\Produto;
use App\Entities\VendaItem;
use App\Models\ProdutoModel;
use App\Models\VendaItemModel;
use App\Models\VendaModel;
use CodeIgniter\Config\Services;
use Exception;

class VendaItemService {
    private $vendaModel;
    private $vendaItemModel;
    private $produtoModel;

    public function __construct()
    {
        $this->vendaModel = new VendaModel();
        $this->vendaItemModel = new VendaItemModel();
        $this->produtoModel = new ProdutoModel();
    }

    public function validarItem($data)
    {
        $validacao = Services::validation();
        $validacao->setRuleGroup('vendas_itens');

        if (!$validacao->run($data)) {
            throw new Exception(implode('.', $validacao->getErrors()));
        }
    }

    public function processarInclusaoDeItem($vendaId, $produtoId, $produtoQtd) {
        $this->validarItem([
            'venda_id'   => $vendaId,
            'produto_id' => $produtoId,
            'quantidade' => $produtoQtd
        ]);

        # Busca o preço atualizado do produto.
        $produtoData  = $this->produtoModel->find($produtoId);

        $vendaItem = new VendaItem();
        $vendaItem->setVenda($vendaId);
        $vendaItem->setProduto($produtoId);
        $vendaItem->setQuantidade($produtoQtd);
        $vendaItem->setPrecoUnitario($produtoData->getPreco());

        # Verifica se o produto já está vinculado a venda em questão.
        $itemExiste = $this->vendaItemModel
            ->checkItemExiste($vendaId, $produtoId);

        if (!$itemExiste) {
            $this->vendaItemModel->insert($vendaItem);
        } else {
            $this->vendaItemModel->atualizarCampos($vendaId, $produtoId, [
                'quantidade'  => $vendaItem->getQuantidade(),
                'preco_total' => $vendaItem->getPrecoTotal()
            ]);
        }
            
        $itens = $this->vendaItemModel->findItensWithNameByID($vendaId);
        $venda = $this->vendaModel->find($vendaId);
        $venda->setItens($itens);
        $venda->calcularValorTotal();

        $this->vendaModel->atualizaValorTotal($vendaId, $venda->getValorTotal());
    }

}