<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;

class Login extends BaseController
{
    public function __construct()
    {
        helper("form");
    }

    public function index(): string|RedirectResponse
    {
        $logged = session()->get("logged");

        if ($logged)
        {
            return redirect()->route("arealogada/principal");
        }

        return view("login");
    }

    public function auth(): \CodeIgniter\HTTP\ResponseInterface
    {
        $request = $this->request->getPost();

        $request["email"] = esc($request["email"]);
        $request["senha"] = esc($request["senha"]);
        
        $rules = [
            "email" => "required",
            "senha" => "required"
        ];

        if (!$this->validateData($request, $rules))
        {
            $response = [
                "error" => true,
                "message" => validation_list_errors(),
                "url" => ""
            ];

            return $this->response->setJSON($response);
        }

        $usuarioModel = model("UsuarioModel");

        $usuarioExists = $usuarioModel->where("email_usua", $request["email"])->find();

        if (empty($usuarioExists))
        {
            $response = [
                "error" => true,
                "message" => "Usuário e senha incorretos.",
                "url" => ""
            ];

            return $this->response->setJSON($response);
        }

        $passIsValid = password_verify($request["senha"], $usuarioExists[0]["senha_usua"]);
        
        if (!$passIsValid)
        {
            $response = [
                "error" => true,
                "message" => "Usuário e senha incorretos.",
                "url" => ""
            ];

            return $this->response->setJSON($response);
        }

        unset($usuarioExists[0]["senha_usua"]);

        # Inicia a sessão após o usuário efetuar o login.
        session()->start();

        session()->set([
            "logged" => true,
            "id_usua" => $usuarioExists[0]["id_usua"],
            "nome_usua" => $usuarioExists[0]["nome_usua"],
            "email_usua" => $usuarioExists[0]["email_usua"],
            "id_sitc" => $usuarioExists[0]["id_sitc"]
        ]);

        $response = [
            "error" => false,
            "message" => "Autenticado com sucesso.",
            "url" => "arealogada/principal"
        ];

        return $this->response->setJSON($response);
    }

    public function logout(): RedirectResponse
    {
        session()->destroy();

        return redirect()->route("/");
    }
}