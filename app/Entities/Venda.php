<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use InvalidArgumentException;

class Venda extends Entity
{
    protected $attributes = [
        'id'             => null,
        'cliente_id'     => null,
        'valor_total'    => null,
        'forma_pagamento'=> null,
        'status'         => null,
        'observacoes'    => null,
        'created_at'     => null,
        'updated_at'     => null,
    ];

    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'id'              => 'integer',
        'cliente_id'      => '?integer',
        'valor_total'     => 'float',
        'forma_pagamento' => 'string',
        'status'          => 'string',
        'observacoes'     => '?string',
        'itens'           => 'array'
    ];

    // -------------------------
    // Métodos auxiliares
    // -------------------------

    public function isPago(): bool
    {
        return $this->attributes['status'] === 'pago';
    }

    public function isPendente(): bool
    {
        return $this->attributes['status'] === 'pendente';
    }

    public function isCancelado(): bool
    {
        return $this->attributes['status'] === 'cancelado';
    }

    public function marcarComoPago(): self
    {
        $this->attributes['status'] = 'pago';
        return $this;
    }

    public function marcarComoCancelado(): self
    {
        $this->attributes['status'] = 'cancelado';
        return $this;
    }

    public function setStatus(string $status): self
    {
        $permitidos = ['pendente', 'pago', 'cancelado'];

        if (!in_array($status, $permitidos)) {
            throw new InvalidArgumentException('Informe um status válido (' . implode(', ', $permitidos) . ')');
        }

        $this->attributes['status'] = $status;
        return $this;
    }
    
    public function getStatus(): string
    {
        return $this->attributes['status'];
    }

    public function setValorTotal($valor): self
    {
        $this->attributes['valor_total'] = (float) $valor;
        return $this;
    }

    public function getValorTotal(): float
    {
        return $this->attributes['valor_total'];
    }

    public function getValorTotalFormatado(): string
    {
        return number_format($this->attributes['valor_total'], 2, ',', '.');
    }

    public function getDataVendaFormatada(): ?string
    {
        if (!$this->attributes['created_at']) {
            return null;
        }

        return $this->attributes['created_at']->format('d/m/Y H:i');
    }

    public function setFormaPagamento(string $forma): self
    {
        $this->attributes['forma_pagamento'] = $forma;
        return $this;
    }

    public function getFormaPagamento(bool $formatar = false): string
    {
        return ($formatar ? ucfirst($this->attributes['forma_pagamento']) : $this->attributes['forma_pagamento']);
    }

    public function getCreationDate(bool $formatar = false): string
    {
        $data = $this->attributes['created_at'];

        if ($formatar) {
            return date('d/m/Y', strtotime($data));
        }

        return $data;
    }

    public function getCreationDateWithFormat(string $format): string
    {
        return date($format, strtotime($this->attributes['created_at']));
    }

    public function setId(int $id): self
    {
        $this->attributes['id'] = $id;
        return $this;
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function setObservacoes(string $observacoes): self
    {
        $this->attributes['observacoes'] = $observacoes;
        return $this;
    }

    public function getObservacoes(): ?string
    {
        return $this->attributes['observacoes'];
    }

    public function setItens(array $itens): self
    {
        $this->attributes['itens'] = $itens;
        return $this;
    }

    public function getItens(): array
    {
        return $this->attributes['itens'];
    }

    /**
     * Verifica se o item pode ser excluído.
     */
    public function itemPodeSerExcluido(): bool
    {
        $itens = $this->getItens();

        return count($itens) > 1;
    }

    /**
     * Verifica se o item pode ser adicionado.
     */
    public function itemPodeSerIncluido(int $itemId): bool
    {

        $itens = $this->getItens();

        foreach ($itens as $key => $item) {
            $podeIncluir = $itemId != $item->getId();
            
            if (!$podeIncluir) {
                throw new InvalidArgumentException('Esse item não pode ser incluído pois ele já está vinculado a esta venda.');
            }
        }

        return true;
    }

    /**
     * @param $itemId -> O id do item (venda_item)
     * Retira o item do objeto.
     */
    public function removerItem(int $itemId): void
    {
        $itens = $this->getItens();

        foreach ($itens as $key => $item) {
            if ($item->getId() != $itemId) {
                continue;
            }

            unset($this->attributes['itens'][$key]);
        }
    }

    /**
     * Calcula o valor total de acordo com os itens.
     */
    public function calcularValorTotal(): void
    {

        $itens = $this->getItens();
        $valorTotal = 0;

        foreach ($itens as $item) {
            $valorTotal += $item->getPrecoTotal();
        }

        $this->setValorTotal($valorTotal);
    }
}