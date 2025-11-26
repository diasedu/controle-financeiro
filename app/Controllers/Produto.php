<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Produto as ProdutoEntity;
use App\Models\ProdutoModel;

class Produto extends BaseController
{
    public function __construct()
    {
        helper('form');
    }

    public function index(): void
    {
        $data = [
            'titulo' => 'Produtos',
        ];

        echo view('templates/header', $data);
        echo view('arealogada/produto/principal');
        echo view('templates/footer');
    }

    public function insertUpdate(): \CodeIgniter\HTTP\ResponseInterface
    {
        $request = $this->request->getPost();
        $produtoModel = new ProdutoModel();

        $produto = new ProdutoEntity();

        if (!empty($request['id'])) {
            $produtoExistente = $produtoModel->find($request['id']);
            if ($produtoExistente) {
                $produto = $produtoExistente;
            }
        }

        $produto->setNome($request['nome'] ?? '');
        $produto->setPreco((float) str_replace(',', '.', $request['preco'] ?? 0));
        $produto->setPrecoKg((float) str_replace(',', '.', $request['preco_kg'] ?? 0));
        $produto->setStatus((int) ($request['status'] ?? 1));

        if (!$produtoModel->save($produto)) {
            $errors = $produtoModel->errors();
            return $this->response->setJSON([
                'error'   => true,
                'message' => 'Erro ao salvar produto: ' . (!empty($errors) ? implode(', ', $errors) : 'Erro desconhecido'),
            ]);
        }

        return $this->response->setJSON([
            'error'   => false,
            'message' => empty($request['id']) ? 'Produto cadastrado com sucesso.' : 'Produto atualizado com sucesso.',
        ]);
    }

    public function getList(): \CodeIgniter\HTTP\ResponseInterface
    {
        $request = $this->request->getPost();
        $produtoModel = new ProdutoModel();

        $query = $produtoModel;

        if (!empty($request['filt_nome'])) {
            $query = $query->like('nome', $request['filt_nome']);
        }

        if (isset($request['filt_status']) && $request['filt_status'] !== '') {
            $query = $query->where('status', $request['filt_status']);
        }

        $listProdutos = $query->orderBy('nome', 'ASC')->findAll();

        return $this->response->setJSON([
            'error' => false,
            'html'  => view('arealogada/produto/lista', ['listProdutos' => $listProdutos]),
        ]);
    }

    public function getRegister(): \CodeIgniter\HTTP\ResponseInterface
    {
        $request = $this->request->getPost();
        $produtoModel = new ProdutoModel();

        $produto = $produtoModel->find($request['id']);

        if (!$produto) {
            return $this->response->setJSON([
                'error'   => true,
                'message' => 'Produto não encontrado.',
            ]);
        }

        return $this->response->setJSON([
            'error' => false,
            'data'  => [
                'id'             => $produto->getId(),
                'nome'           => $produto->getNome(),
                'preco'          => number_format($produto->getPreco() ?? 0, 2, '.', ''),
                'preco_kg'       => number_format($produto->getPrecoKg() ?? 0, 2, '.', ''),
                'status'         => $produto->getStatus(),
            ],
        ]);
    }

    public function deleteRegister(): \CodeIgniter\HTTP\ResponseInterface
    {
        $request = $this->request->getPost();
        $produtoModel = new ProdutoModel();

        $produto = $produtoModel->find($request['id']);

        if (!$produto) {
            return $this->response->setJSON([
                'error'   => true,
                'message' => 'Produto não encontrado.',
            ]);
        }

        $produtoModel->delete($request['id']);

        return $this->response->setJSON([
            'error'   => false,
            'message' => 'Produto excluído com sucesso.',
        ]);
    }
}


