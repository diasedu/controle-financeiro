<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Venda as EntitiesVenda;
use App\Entities\VendaItem as EntitiesVendaItem;
use App\Libraries\ResponseTrait as LibrariesResponseTrait;
use App\Models\ClienteModel;
use App\Models\ProdutoModel;
use App\Models\VendaItemModel;
use App\Models\VendaModel;
use App\Services\VendaService;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\ResponseTrait;
use Config\Services;
use InvalidArgumentException;
use ReflectionException;

class Venda extends BaseController
{
    use LibrariesResponseTrait;

    private $vendaService;

    public function __construct()
    {
        helper('form');

        $this->vendaService = new VendaService();
    }

    public function index(): void
    {
        $clienteModel = new ClienteModel();
        $produtoModel = new ProdutoModel();

        try {
            $clientes = $clienteModel->findAll();
            $produtos = $produtoModel->findAtivos();
        } catch (DatabaseException $e) {
            $clientes = [];
            $produtos = [];
        }

        echo view('templates/header', ['titulo' => 'Vendas']);
        echo view('arealogada/venda/principal', [
            'clientes' => $clientes,
            'produtos' => $produtos
        ]);
        echo view('templates/footer');
    }

    public function incluirItens(): string
    {
        $ids = $this->request->getGet('ids');

        if (empty($ids)) {
            return '';
        }

        $produtoModel = new ProdutoModel();
        try {
            $produtos = $produtoModel->findByIds($ids);
        } catch (DatabaseException $e) {
            $produtos = [];
        }

        return view(
            'arealogada/venda/produtos-adicionados', 
            ['produtos' => $produtos]
        );
    }

    public function salvar(): ResponseInterface
    {
        $data = $this->request->getJSON(true);

        [
            'preco_total' => $precoTotal,
            'prod_dados'  => $itens 
        ] = $data;

        $vendaModel = new VendaModel();
        $venda = new EntitiesVenda();

        try {
            $venda->setValorTotal($precoTotal);
            $venda->setFormaPagamento('debito');
            $venda->setStatus('pago');
        } catch (InvalidArgumentException $e) {
            return $this->response->setJSON([
                'error'   => true,
                'message' => $e->getMessage(),
            ]);
        }
        
        $vendaId = $vendaModel->insert($venda);
        if (!$vendaId) {
            $errors = $vendaModel->errors();
            return $this->response->setJSON([
                'error'   => true,
                'message' => 'Erro ao salvar produto: ' . (!empty($errors) ? implode(', ', $errors) : 'Erro desconhecido'),
            ]);
        }

        $vendaItemModel = new VendaItemModel();

        foreach ($itens as $item) {
            $vendaItem = new EntitiesVendaItem();

            $vendaItem->setVenda($vendaId);
            $vendaItem->setProduto($item['id']);
            $vendaItem->setQuantidade($item['qtd']);
            $vendaItem->setPrecoUnitario($item['valor_unitario']);
            $vendaItem->setPrecoTotal($item['valor_total_por_item']);

            $inserido = $vendaItemModel->insert($vendaItem);

            # Força a criar um novo objeto ao percorrer os itens.
            unset($vendaItem);

            if (!$inserido) {
                $errors = $vendaItemModel->errors();

                return $this->response->setJSON([
                    'error'   => true,
                    'message' => 'Erro ao salvar os itens da venda: ' . (!empty($errors) ? implode(', ', $errors) : 'Erro desconhecido'),
                ]);
            }
        }

        return $this->response->setJSON([
            'error'   => false,
            'message' => 'Venda salva com sucesso.'
        ]);
    }

    public function editar(): ResponseInterface
    {
        $data = $this->request->getPost();

        $vendaModel = new VendaModel();
        $venda = new EntitiesVenda();

        $venda->setId($data['id']);
        $venda->setFormaPagamento($data['forma_pagamento']);
        $venda->setStatus($data['status']);
        $venda->setObservacoes($data['observacoes']);
        
        try {
            $vendaModel->update($venda->getId(), $venda);
        } catch (ReflectionException $e) {
            return $this->response->setJSON([
                'error'   => true,
                'message' => 'Erro ao salvar a venda: ' . $e->getMessage(),
            ]);
        }
        
        return $this->response->setJSON([
            'error'   => false,
            'message' => 'Venda salva com sucesso.'
        ]);
    }

    public function buscar(): string
    {   
        $dtInicio = $this->request->getPost('data-inicio');
        $dtFim    = $this->request->getPost('data-fim');

        $vendaModel = new VendaModel();

        try {
            if (!empty($dtInicio) && !empty($dtFim)) {
                $vendas = $vendaModel->findBetweenDates($dtInicio, $dtFim);
            } else {
                $vendas = $vendaModel->findAll();
            }
        } catch (DatabaseException $e) {
            return view('templates/error', ['message' => $e->getMessage()]);
        }

        return view('arealogada/venda/lista', ['vendas' => $vendas]);
    }

    public function getVendaByID(): string
    {
        $data = $this->request->getJSON(true);
        $id = $data['id'];

        if (empty($id)) {
            return view('templates/error', ['message' => 'Parâmetros não informados']);
        }

        $vendaModel     = new VendaModel();
        $vendaItemModel = new VendaItemModel();

        try {
            $venda = $vendaModel->find($id);
            $itens = $vendaItemModel->findItensWithNameByID($id);
        } catch (DatabaseException $e) {
            return view('templates/error', ['message' => $e->getMessage()]);
        }

        return view('arealogada/venda/venda-e-itens', [
            'venda' => $venda,
            'itens' => $itens
        ]);
    }

    public function excluir(): ResponseInterface
    {
        $data = $this->request->getJSON(true);

        ['id' => $id] = $data;

        if (empty($id)) {
            return $this->response->setJSON([
                'error'   => true,
                'message' => 'Parâmetros não informados.',
            ]);
        }
        
        $vendaModel = new VendaModel();

        try {
            $vendaModel->delete($id);
        } catch (DatabaseException $e) {
            return $this->response->setJSON([
                'error'   => false,
                'message' => $e->getMessage(),
            ]);
        };
        
        return $this->response->setJSON([
            'error'   => false,
            'message' => 'Venda excluída com sucesso.',
        ]);
    }

    public function excluirItem(): ResponseInterface
    {
        [
            'id' => $id, 
            'venda_id' => $vendaId
        ] = $this->request->getJSON(true);;

        if (empty($id) || empty($vendaId)) {
            return $this->response->setJSON([
                'error'   => true,
                'message' => 'Parâmetros não informados.',
            ]);
        }
        
        $vendaModel = new VendaModel();
        $vendaItemModel = new VendaItemModel();

        try {
            $vendaItens = $vendaItemModel
                ->where('venda_id', $vendaId)
                ->findAll();

            $venda = $vendaModel->find($vendaId);
            $venda->setItens($vendaItens);

            if (!$venda->itemPodeSerExcluido()) {
                return $this->response->setJSON([
                    'error'   => true,
                    'message' => 'O item não pode ser excluído.',
                ]);
            }

            $venda->removerItem($id);
            $vendaItemModel->delete($id);
            $venda->calcularValorTotal();
            
            $vendaModel->update($vendaId, [
                'valor_total' => $venda->getValorTotal()
            ]);
        } catch (DatabaseException $e) {
            return $this->response->setJSON([
                'error'   => true,
                'message' => $e->getMessage(),
            ]);
        };
        
        return $this->response->setJSON([
            'error'   => false,
            'message' => 'O item foi excluído com sucesso e o valor total foi recalculado.',
        ]);
    }

    public function getProdutoByID(): ResponseInterface
    {
        $data = $this->request->getJSON(true);

        ['id' => $id] = $data;

        if (empty($id)) {
            return $this->response->setJSON([
                'error'   => true,
                'message' => 'Parâmetros não informados'
            ]);
        }

        $produtoModel = new ProdutoModel();

        try {
            $produto = $produtoModel->find($id);
        } catch (DatabaseException $e) {
            return $this->response->setJSON([
                'error'   => true,
                'message' => $e->getMessage()
            ]);
        }

        
        return $this->response->setJSON([
            'error' => false,
            'data'  => [
                'preco' => $produto->getPreco()
            ]
        ]);
    }

    public function incluirEditarItem(): ResponseInterface
    {
        [
            'venda-id' => $venda_id, 
            'produto-id' => $produto_id, 
            'produto-qtd' => $produto_qtd
        ] = $this->request->getPost();

        if (empty($venda_id) || empty($produto_id) || empty($produto_qtd)) {
            return $this->jsonError('Parâmetros não informados');
        }

        $response = $this->vendaService->processarInclusaoDeItem(
            $venda_id, $produto_id, $produto_qtd
        );

        return $response['error']
            ? $this->jsonError($response['message'])
            : $this->jsonSuccess($response['message']);
    }

}


