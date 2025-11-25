<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Cliente extends Entity
{
    protected $attributes = [
        'id'        => null,
        'nome'      => null,
        'telefone'  => null,
        'email'     => null,
        'created_at'=> null,
        'updated_at'=> null,
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function getId(): ?int
    {
        return $this->attributes['id'] ?? null;
    }

    public function getNome(): ?string
    {
        return $this->attributes['nome'] ?? null;
    }

    public function setNome(string $nome): self
    {
        $this->attributes['nome'] = $nome;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->attributes['email'] ?? null;
    }

    public function setEmail(string $telefone): self
    {
        $this->attributes['email'] = $telefone;
        return $this;
    }

    public function getTelefone(): ?string
    {
        return $this->attributes['telefone'] ?? null;
    }

    public function setTelefone(string $telefone): self
    {
        $this->attributes['telefone'] = $telefone;
        return $this;
    }
}
