<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class VendaItem extends Entity
{
    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'id'             => 'integer',
        'venda_id'       => 'integer',
        'produto_id'     => 'integer',
        'produto_nome'   => 'string',
        'quantidade'     => 'integer',
        'preco_unitario' => 'float',
        'preco_total'    => 'float',
    ];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function setProduto(int $produtoId): self {
        $this->attributes['produto_id'] = $produtoId;
        return $this;
    }

    public function getProduto(): int {
        return $this->attributes['produto_id'];
    }

    public function setProdutoNome(string $produtoNome): self {
        $this->attributes['produto_nome'] = $produtoNome;
        return $this;
    }

    public function getProdutoNome(): string {
        return $this->attributes['produto_nome'];
    }

    public function setPrecoTotal(float $precoTotal): self {
        $this->attributes['preco_total'] = $precoTotal;
        return $this;
    }

    public function getPrecoTotal(): float {
        return $this->attributes['preco_total'];
    }

    public function getPrecoTotalFormatado(string $formato): string
    {
        $valor = '';

        switch ($formato) {
            case 'BR':
                $valor = number_format(
                    $this->attributes['preco_total'], 
                    2, 
                    ',', 
                    '.'
                );
                break;
        }

        return $valor;
    }

    public function setQuantidade($quantidade): self
    {
        $this->attributes['quantidade'] = (int) $quantidade;
        $this->recalcularTotal();
        return $this;
    }

    public function getQuantidade(): int
    {
        return $this->attributes['quantidade'];
    }

    public function setPrecoUnitario($preco)
    {
        $this->attributes['preco_unitario'] = (float) $preco;
        $this->recalcularTotal();
        return $this;
    }

    public function getPrecoUnitario(): float
    {
        return $this->attributes['preco_unitario'];
    }

    public function getPrecoUnitarioFormatado(string $formato): string
    {
        $valor = '';

        switch ($formato) {
            case 'BR':
                $valor = number_format(
                    $this->attributes['preco_unitario'], 
                    2, 
                    ',', 
                    '.'
                );
                break;
        }

        return $valor;
    }

    public function setVenda(int $vendaId) {
        $this->attributes['venda_id'] = $vendaId;
        return $this;
    }

    public function getVenda(): int {
        return $this->attributes['venda_id'];
    }

    public function recalcularTotal()
    {
        if (
            isset($this->attributes['quantidade']) &&
            isset($this->attributes['preco_unitario'])
        ) {
            $this->attributes['preco_total'] =
                $this->attributes['quantidade'] * $this->attributes['preco_unitario'];
        }
    }
}
