<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Usuario extends Entity {
    /**
     * Mapeamento de propriedades da entidade para colunas do banco de dados
     * 
     * @var array<string, string>
     */
    protected $datamap = [
        'id'        => 'id_usua',
        'nome'      => 'nome_usua',
        'email'     => 'email_usua',
        'senha'     => 'senha_usua',
        'idStatus'  => 'id_sitc',
    ];

    /**
     * Campos de data que serão convertidos para objetos Time
     * 
     * @var list<string>
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Conversão de tipos de dados
     * 
     * @var array<string, string>
     */
    protected $casts = [
        'id_usua'   => 'int',
        'id_sitc'   => 'int',
        'nome_usua' => 'string',
        'email_usua'=> 'string',
        'senha_usua'=> 'string',
    ];

    /**
     * Retorna o ID do usuário
     * 
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->attributes['id_usua'] ?? null;
    }

    /**
     * Retorna o nome do usuário
     * 
     * @return string|null
     */
    public function getNome(): ?string
    {
        return $this->attributes['nome_usua'] ?? null;
    }

    /**
     * Define o nome do usuário
     * 
     * @param string $nome
     * @return $this
     */
    public function setNome(string $nome): self
    {
        $this->attributes['nome_usua'] = $nome;
        return $this;
    }

    /**
     * Retorna o email do usuário
     * 
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->attributes['email_usua'] ?? null;
    }

    /**
     * Define o email do usuário
     * 
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->attributes['email_usua'] = $email;
        return $this;
    }

    /**
     * Retorna o ID do status
     * 
     * @return int|null
     */
    public function getIdStatus(): ?int
    {
        return $this->attributes['id_sitc'] ?? null;
    }

    /**
     * Define o ID do status
     * 
     * @param int $idStatus
     * @return $this
     */
    public function setIdStatus(int $idStatus): self
    {
        $this->attributes['id_sitc'] = $idStatus;
        return $this;
    }

    /**
     * Verifica se a senha fornecida corresponde à senha do usuário
     * 
     * @param string $senha
     * @return bool
     */
    public function verificarSenha(string $senha): bool
    {
        return password_verify($senha, $this->attributes['senha_usua'] ?? '');
    }

    /**
     * Define a senha do usuário (com hash)
     * 
     * @param string $senha
     * @return $this
     */
    public function setSenha(string $senha): self
    {
        $this->attributes['senha_usua'] = password_hash($senha, PASSWORD_DEFAULT);
        return $this;
    }
}
