<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Marca extends Entity
{
    /**
     * Mapeamento de propriedades da entidade para colunas do banco de dados
     * 
     * @var array<string, string>
     */
    protected $datamap = [];

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
        'id'     => 'int',
        'nome'   => 'string',
        'status' => 'int',
    ];

    /**
     * Retorna o ID da marca
     * 
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->attributes['id'] ?? null;
    }

    /**
     * Retorna o nome da marca
     * 
     * @return string|null
     */
    public function getNome(): ?string
    {
        return $this->attributes['nome'] ?? null;
    }

    /**
     * Define o nome da marca
     * 
     * @param string $nome
     * @return $this
     */
    public function setNome(string $nome): self
    {
        $this->attributes['nome'] = $nome;
        return $this;
    }

    /**
     * Retorna o status da marca
     * 
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->attributes['status'] ?? null;
    }

    /**
     * Define o status da marca
     * 
     * @param int $status 1 = Ativo, 0 = Inativo
     * @return $this
     */
    public function setStatus(int $status): self
    {
        $this->attributes['status'] = $status;
        return $this;
    }

    /**
     * Verifica se a marca está ativa
     * 
     * @return bool
     */
    public function isAtivo(): bool
    {
        return ($this->attributes['status'] ?? 0) === 1;
    }

    /**
     * Ativa a marca
     * 
     * @return $this
     */
    public function ativar(): self
    {
        $this->attributes['status'] = 1;
        return $this;
    }

    /**
     * Desativa a marca
     * 
     * @return $this
     */
    public function desativar(): self
    {
        $this->attributes['status'] = 0;
        return $this;
    }
}
