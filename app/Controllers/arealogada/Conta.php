<?php

namespace App\Controllers\Arealogada;

use App\Controllers\BaseController;

class Conta extends BaseController
{
    public function __construct()
    {
        helper("form");
    }

    public function index(): string
    {
        return view("arealogada/conta/Principal");
    }

    public function insertUpdate(): \CodeIgniter\HTTP\ResponseInterface
    {
        $request = $this->request->getPost();

        $rules = [];

        $contaModel = model("arealogada/ContaModel");
        
        $save = $contaModel->save($request);

        if ($save)
        {
            return $this->response->setJSON(["error" => false, "message" => "Conta cadastrada com sucesso."]);
        }

        return $this->response->setJSON(["error" => true, "message" => "Erro ao cadastrar conta."]);
        
    }

    public function getList(): \CodeIgniter\HTTP\ResponseInterface
    {
        $request = $this->request->getPost();


        $contaModel = model("arealogada/ContaModel");
        
        $listContas = $contaModel->
            like("desc_conta", $request["filt_desc_conta"])->
            where("sta_conta", $request["filt_sta_conta"])->
            orderBy("desc_conta", "ASC")->
        findAll();

        return $this->response->setJSON([
            "error" => false, 
            "html" => view("arealogada/conta/Lista", ["listContas" => $listContas])
        ]);
    }

    public function getRegister(): \CodeIgniter\HTTP\ResponseInterface
    {
        $request = $this->request->getPost();

        $contaModel = model("arealogada/ContaModel");
        
        $data = $contaModel->find($request["id_conta"]);

        return $this->response->setJSON([
            "error" => false, 
            "data" => $data
        ]);
    }

    public function deleteRegister(): \CodeIgniter\HTTP\ResponseInterface
    {
        $request = $this->request->getPost();

        $contaModel = model("arealogada/ContaModel");
        $contaModel->delete($request["id_conta"]);

        return $this->response->setJSON([
            "error" => false, 
            "message" => "Registro excluída com sucesso."
        ]);
    }
}