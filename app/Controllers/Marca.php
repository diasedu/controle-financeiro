<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Marca as MarcaEntity;
use App\Models\MarcaModel;

class Marca extends BaseController
{
    public function __construct()
    {
        helper("form");
    }

    public function index(): void
    {
        $data = [
            "titulo" => "Marcas"
        ];

        echo view("templates/header", $data);
        echo view("arealogada/marca/principal");
        echo view("templates/footer");
    }

    public function insertUpdate(): \CodeIgniter\HTTP\ResponseInterface
    {
        $request = $this->request->getPost();
        $marcaModel = new MarcaModel();

        $marca = new MarcaEntity();
        
        if (!empty($request['id'])) {
            $marcaExistente = $marcaModel->find($request['id']);
            if ($marcaExistente) {
                $marca = $marcaExistente;
            }
        }

        $marca->setNome($request['nome'] ?? '');
        $marca->setStatus((int)($request['status'] ?? 1));

        if (!$marcaModel->save($marca)) {
            $errors = $marcaModel->errors();
            return $this->response->setJSON([
                "error" => true, 
                "message" => "Erro ao salvar marca: " . (!empty($errors) ? implode(', ', $errors) : 'Erro desconhecido')
            ]);
        }

        return $this->response->setJSON([
            "error" => false, 
            "message" => empty($request['id']) ? "Marca cadastrada com sucesso." : "Marca atualizada com sucesso."
        ]);
    }

    public function getList(): \CodeIgniter\HTTP\ResponseInterface
    {
        $request = $this->request->getPost();
        $marcaModel = new MarcaModel();

        $query = $marcaModel;

        // Filtro por nome
        if (!empty($request["filt_nome"])) {
            $query = $query->like("nome", $request["filt_nome"]);
        }

        // Filtro por status
        if (isset($request["filt_status"]) && $request["filt_status"] !== '') {
            $query = $query->where("status", $request["filt_status"]);
        }

        $listMarcas = $query->orderBy("nome", "ASC")->findAll();

        return $this->response->setJSON([
            "error" => false, 
            "html" => view("arealogada/marca/lista", ["listMarcas" => $listMarcas])
        ]);
    }

    public function getRegister(): \CodeIgniter\HTTP\ResponseInterface
    {
        $request = $this->request->getPost();
        $marcaModel = new MarcaModel();
        
        $marca = $marcaModel->find($request["id"]);

        if (!$marca) {
            return $this->response->setJSON([
                "error" => true, 
                "message" => "Marca não encontrada."
            ]);
        }

        return $this->response->setJSON([
            "error" => false, 
            "data" => [
                'id' => $marca->getId(),
                'nome' => $marca->getNome(),
                'status' => $marca->getStatus()
            ]
        ]);
    }

    public function deleteRegister(): \CodeIgniter\HTTP\ResponseInterface
    {
        $request = $this->request->getPost();
        $marcaModel = new MarcaModel();
        
        $marca = $marcaModel->find($request["id"]);
        
        if (!$marca) {
            return $this->response->setJSON([
                "error" => true, 
                "message" => "Marca não encontrada."
            ]);
        }

        $marcaModel->delete($request["id"]);

        return $this->response->setJSON([
            "error" => false, 
            "message" => "Marca excluída com sucesso."
        ]);
    }
}

