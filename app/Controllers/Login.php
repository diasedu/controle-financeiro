<?php

namespace App\Controllers;

use App\Entities\Usuario;
use App\Models\UsuarioModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\HTTP\RedirectResponse;

class Login extends BaseController
{
    public function __construct()
    {
        helper("form");
    }

    public function index()
    {
        $logged = session()->get("logged");

        if ($logged) {
            return redirect()->route("arealogada/venda");
        }

        return view("login");
    }

    public function auth(): RedirectResponse {
        $email = esc($this->request->getPost('email'));
        $senha = esc($this->request->getPost('senha'));

        $r = redirect();
        $s = session();

        $params = ['email' => $email, 'senha' => $senha];

        $rules = [
            "email" => "required",
            "senha" => "required"
        ];

        if (!$this->validateData($params, $rules)) {
            return $r->back()->withInput()->with('error', validation_errors());
        }

        $userModel = new UsuarioModel();

        try {
            $user = $userModel->findByEmail($email);
        } catch (DatabaseException $e) {
            return $r->back()->withInput()->with('error', $e->getMessage());
        }

        if (is_null($user) || !$user->verificarSenha($senha)) {
            return $r->back()->withInput()->with('error', 'Credenciais inválidas');
        }

        $s->set([
            'logged'     => true,
            'id_usua'    => $user->getId(),
            'nome_usua'  => $user->getNome(),
            'email_usua' => $user->getEmail()
        ]);

        return $r->to('arealogada/venda');
    }

    public function newUser(): string {
        return view('new-user');
    }

    public function saveUser(): RedirectResponse {
        $user_data = $this->request->getPost();
        $r = redirect();

        # Regras de validação
        $rules = [
            'nome' => [
                'label' => 'Nome',
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório.',
                    'min_length' => 'O campo {field} deve ter no mínimo {param} caracteres.',
                    'max_length' => 'O campo {field} deve ter no máximo {param} caracteres.'
                ]
            ],
            'email' => [
                'label' => 'E-mail',
                'rules' => 'required|valid_email|max_length[100]|is_unique[usuarios.email_usua]',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório.',
                    'valid_email' => 'O campo {field} deve conter um e-mail válido.',
                    'max_length' => 'O campo {field} deve ter no máximo {param} caracteres.',
                    'is_unique' => 'Este {field} já está cadastrado no sistema.'
                ]
            ],
            'senha' => [
                'label' => 'Senha',
                'rules' => 'required|min_length[6]|max_length[255]',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório.',
                    'min_length' => 'O campo {field} deve ter no mínimo {param} caracteres.',
                    'max_length' => 'O campo {field} deve ter no máximo {param} caracteres.'
                ]
            ],
            'confirma_senha' => [
                'label' => 'Confirmação de Senha',
                'rules' => 'required|matches[senha]',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório.',
                    'matches' => 'O campo {field} deve ser igual ao campo Senha.'
                ]
            ]
        ];

        # Validação dos dados
        if (!$this->validate($rules)) {
            return $r->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        # Preparar dados para inserção
        $userModel = new UsuarioModel();
        
        $usuario = new Usuario();
        $usuario->setNome(esc($user_data['nome']))
                ->setEmail(esc($user_data['email']))
                ->setSenha($user_data['senha'])
                ->setIdStatus(1); // Ajuste conforme sua necessidade (status ativo)

        try {
            $userModel->save($usuario);
            return $r->to('/')->with('success', 'Usuário cadastrado com sucesso! Faça login para continuar.');
        } catch (DatabaseException $e) {
            return $r->back()->withInput()->with('error', 'Erro ao cadastrar usuário: ' . $e->getMessage());
        }
    }

    public function logout(): RedirectResponse {
        session()->destroy();

        return redirect()->route("/");
    }
}