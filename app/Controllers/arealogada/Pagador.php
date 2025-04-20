<?php

namespace App\Controllers\Arealogada;

use App\Controllers\BaseController;
use App\Models\Arealogada\PagadorModel;

class Pagador extends BaseController
{
    public function __construct()
    {
        helper("form");
    }

    public function index(): void
    {
        $data = [
            "titulo" => "Pagador"
        ];

        echo view("templates/header", $data);
        echo view("arealogada/pagador/principal");
        echo view("templates/footer");
    }

    public function salvar(): \CodeIgniter\HTTP\ResponseInterface
    {
        $request = $this->request->getPost();

        $rules = [
            "nome_paga" => ["label" => "Nome", "rules" => "required|max_length[150]"],
            "sta_paga" => ["label" => "Status", "rules" => "required|max_length[150]"],
        ];

        if (!$this->validateData($request, $rules))
        {
            return $this->response->setJSON([
                "error" => true,
                "message" => "",
                "html" => view("templates/erro", [
                    "list" => validation_errors()
                ])
            ]);
        }

        $pagadorModel = new PagadorModel();
        
        if (empty($request["id_paga"]))
        {
            $request["id_paga"] = $pagadorModel->getId();
        }
        
        $pagadorModel->save($request);

        return $this->response->setJSON([
            "error" => false,
            "message" => "",
            "html" => view("templates/sucesso", [
                "message" => MSG_DADOS_SALVOS
            ])
        ]);
    }

    public function consultar(): \CodeIgniter\HTTP\ResponseInterface
    {
        $request = $this->request->getPost();

        $pagadorModel = new PagadorModel();

        $list = [];
        $response = [];

        if (!isset($request["id_paga"]))
        {
            $list = $pagadorModel->
                like("nome_paga", $request["nome_paga"])->
                where("sta_paga", $request["sta_paga"])->
                orderBy("nome_paga", "ASC")->
            findAll();

            $response = [
                "error" => false, 
                "html" => view("arealogada/pagador/lista", [
                    "list" => $list
                ]),
            ];
        } else 
        {
            $list = $pagadorModel->find($request["id_paga"]);

            $response = [
                "error" => false, 
                "list" => $list
            ];
        }        

        return $this->response->setJSON($response);
    }

    public function excluir(): \CodeIgniter\HTTP\ResponseInterface
    {
        $request = $this->request->getPost();

        $pagadorModel = model("arealogada/PagadorModel");
        $pagadorModel->delete($request["id_paga"]);

        return $this->response->setJSON([
            "error" => false, 
            "message" => "Registro excluído com sucesso."
        ]);
    }
}