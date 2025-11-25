<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Produto extends Entity
{
    /**
     * @var array<string, string>
     */
    protected $datamap = [];

    /**
     * @var list<string>
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'id'             => 'int',
        'nome'           => 'string',
        'preco'          => 'float',
        'tipo_cobranca'  => 'string',
        'status'         => 'int',
    ];

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

    public function getPreco(): ?float
    {
        return $this->attributes['preco'] ?? null;
    }

    public function setPreco(float $preco): self
    {
        $this->attributes['preco'] = $preco;
        return $this;
    }

    public function getTipoCobranca(): ?string
    {
        return $this->attributes['tipo_cobranca'] ?? null;
    }

    public function setTipoCobranca(string $tipo): self
    {
        $this->attributes['tipo_cobranca'] = $tipo;
        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->attributes['status'] ?? null;
    }

    public function setStatus(int $status): self
    {
        $this->attributes['status'] = $status;
        return $this;
    }

    public function isAtivo(): bool
    {
        return ($this->attributes['status'] ?? 0) === 1;
    }

    public function isCobradoPorQuilo(): bool
    {
        return ($this->attributes['tipo_cobranca'] ?? '') === 'quilo';
    }
}


