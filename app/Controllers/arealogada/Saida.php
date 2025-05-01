<?php
namespace App\Controllers\Arealogada;

error_log("Xdebug ativado");

use App\Controllers\BaseController;
use App\Models\Arealogada\PagadorModel;
use App\Models\Arealogada\SaidaModel;
use App\Models\Arealogada\ContaModel;

class Saida extends BaseController
{
    public function __construct()
    {
        helper("form");
    }

    public function index(): void
    {
        $data = [
            "titulo" => "Saída"
        ];

        echo view("templates/header", $data);
        echo view("arealogada/saida/principal");
        echo view("templates/footer");
    }

    public function consultar(): \CodeIgniter\HTTP\ResponseInterface
    {
        $saidaModel = new SaidaModel();
        $pagadorModel = new PagadorModel();
        $contaModel = new ContaModel();

        $list = $saidaModel->getSaida();
        $listPagador = $pagadorModel->where("sta_paga", "A")->orderBy("nome_paga", "ASC")->findAll();
        $listConta = $contaModel->where("sta_conta", "A")->orderBy("desc_conta", "ASC")->findAll();

        $response = [
            "error" => false, 
            "html" => view("arealogada/saida/lista", [
                "list" => $list,
                "listPagador" => $listPagador,
                "listConta" => $listConta
            ]),
        ];
        
        return $this->response->setJSON($response);
    }

    public function mudarStatus(): \CodeIgniter\HTTP\ResponseInterface
    {
        $request = $this->request->getPost();

        $rules = [
            "id_paga" => ["label" => "Pagador", "rules" => "required"],
            "dt_paga" => ["label" => "Data do pagamento", "rules" => "required"]
        ];

        if (!$this->validateData($request, $rules))
        {
            return $this->response->setJSON([
                "error" => true, 
                "html" => view("templates/erro", [
                    "list" => validation_errors()
                ])
            ]);
        }

        $saidaModel = new SaidaModel();
        $saidaModel->mudarStatus($request);

        $response = [
            "error" => false, 
            "html" => view("templates/sucesso", [
                "message" => MSG_DADOS_SALVOS
            ])
        ];
        
        return $this->response->setJSON($response);
    }
}