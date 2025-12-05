<?php

namespace App\Models;

use App\Entities\Venda;
use CodeIgniter\Model;

class VendaModel extends Model
{
    protected $table = 'vendas';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    // Caso queira usar Entity futuramente, só trocar aqui:
    protected $returnType = Venda::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'cliente_id',
        'valor_total',
        'forma_pagamento',
        'status',
        'observacoes',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Timestamps
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Regras de validação
    protected $validationRules = [
        'cliente_id' => [
            'label' => 'Cliente',
            'rules' => 'permit_empty|is_natural_no_zero',
        ],
        'valor_total' => [
            'label' => 'Valor Total',
            'rules' => 'required|decimal',
        ],
        'forma_pagamento' => [
            'label' => 'Forma de Pagamento',
            'rules' => 'required|in_list[dinheiro,pix,credito,debito,boleto]',
        ],
        'status' => [
            'label' => 'Status',
            'rules' => 'required|in_list[pendente,pago,cancelado]',
        ],
        'observacoes' => [
            'label' => 'Observações',
            'rules' => 'permit_empty|max_length[5000]',
        ],
    ];

    /**
     * Retorna somente as vendas pagas
     */
    public function findPagas(): array
    {
        return $this->where('status', 'pago')->findAll();
    }

    /**
     * Retorna as vendas por faixa de datas
     */
    public function findBetweenDates(?string $inicio, ?string $fim): array
    {
        return $this->where('created_at >=', $inicio)
            ->where('created_at <=', $fim)
            ->findAll();
    }

    /**
     * Retorna as vendas de um cliente específico
     */
    public function findByCliente(int $clienteId): array
    {
        return $this->where('cliente_id', $clienteId)->findAll();
    }
}
