<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Cliente as ClienteEntity;
use App\Models\ClienteModel;
use CodeIgniter\HTTP\ResponseInterface;

class Cliente extends BaseController
{
    public function __construct()
    {
        helper('form');
    }

    public function index(): void
    {
        $data = [
            'titulo' => 'Clientes',
        ];

        echo view('templates/header', $data);
        echo view('arealogada/cliente/principal');
        echo view('templates/footer');
    }

    public function insertUpdate(): ResponseInterface 
    {
        $request = $this->request->getPost();
        $clienteModel = new ClienteModel();

        $cliente = new ClienteEntity();

        if (!empty($request['id'])) {
            $clienteExistente = $clienteModel->find($request['id']);
            if ($clienteExistente) {
                $cliente = $clienteExistente;
            }
        }

        $cliente->setNome($request['nome'] ?? '');
        $cliente->setEmail($request['email'] ?? '');
        $cliente->setTelefone($request['telefone'] ?? '');

        if (!$clienteModel->save($cliente)) {
            $errors = $clienteModel->errors();
            return $this->response->setJSON([
                'error'   => true,
                'message' => 'Erro ao salvar Cliente: ' . (!empty($errors) ? implode(', ', $errors) : 'Erro desconhecido'),
            ]);
        }

        return $this->response->setJSON([
            'error'   => false,
            'message' => empty($request['id']) ? 'Cliente cadastrado com sucesso.' : 'Cliente atualizado com sucesso.',
        ]);
    }

    public function getList(): \CodeIgniter\HTTP\ResponseInterface
    {
        $request = $this->request->getPost();
        $clienteModel = new ClienteModel();

        $query = $clienteModel;

        if (!empty($request['filt_nome'])) {
            $query = $query->like('nome', $request['filt_nome']);
        }

        if (isset($request['filt_status']) && $request['filt_status'] !== '') {
            $query = $query->where('status', $request['filt_status']);
        }

        if (isset($request['filt_tipo_cobranca']) && $request['filt_tipo_cobranca'] !== '') {
            $query = $query->where('tipo_cobranca', $request['filt_tipo_cobranca']);
        }

        $listClientes = $query->orderBy('nome', 'ASC')->findAll();

        return $this->response->setJSON([
            'error' => false,
            'html'  => view('arealogada/cliente/lista', ['listClientes' => $listClientes]),
        ]);
    }

    public function getRegister(): ResponseInterface
    {
        $request = $this->request->getPost();
        $clienteModel = new ClienteModel();

        $cliente = $clienteModel->find($request['id']);

        if (!$cliente) {
            return $this->response->setJSON([
                'error'   => true,
                'message' => 'Cliente não encontrado.',
            ]);
        }

        return $this->response->setJSON([
            'error' => false,
            'data'  => [
                'id'             => $cliente->getId(),
                'nome'           => $cliente->getNome(),
                'email'          => $cliente->getEmail(),
                'telefone'       => $cliente->getTelefone(),
            ],
        ]);
    }

    public function deleteRegister(): \CodeIgniter\HTTP\ResponseInterface
    {
        $request = $this->request->getPost();
        $clienteModel = new ClienteModel();

        $cliente = $clienteModel->find($request['id']);

        if (!$cliente) {
            return $this->response->setJSON([
                'error'   => true,
                'message' => 'Cliente não encontrado.',
            ]);
        }

        $clienteModel->delete($request['id']);

        return $this->response->setJSON([
            'error'   => false,
            'message' => 'Cliente excluído com sucesso.',
        ]);
    }
}


