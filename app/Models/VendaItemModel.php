<?php

namespace App\Models;

use App\Entities\VendaItem;
use CodeIgniter\Model;

class VendaItemModel extends Model
{
    protected $table = 'vendas_itens';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = VendaItem::class; 
    // Se quiser entity, me avise e eu gero também.

    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id',
        'venda_id',
        'produto_id',
        'quantidade',
        'preco_unitario',
        'preco_total',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validação opcional
    protected $validationRules = [
        'venda_id'       => 'required|integer',
        'produto_id'     => 'required|integer',
        'quantidade'     => 'required|integer|greater_than[0]',
        'preco_unitario' => 'required|decimal',
        'preco_total'    => 'required|decimal',
    ];

    public function findItensWithNameByID($id)
    {
        $colunas = [
            'veit.id',
            'veit.venda_id',
            'veit.produto_id',
            'prod.nome as produto_nome',
            'veit.quantidade',
            'veit.preco_unitario',
            'veit.preco_total',
        ];

        $builder = $this->db->table('vendas_itens veit');

        $rows = $builder->select($colunas)
            ->join('vendas', 'vendas.id = veit.venda_id', 'inner')
            ->join('produtos prod', 'veit.produto_id = prod.id', 'inner')
            ->where('veit.venda_id', $id)
            ->get()
            ->getResultArray();

        return array_map(fn($row) => new VendaItem($row), $rows);
    }

    public function checkItemExiste($vendaId, $produtoId)
    {
        $this->where('venda_id', $vendaId);
        $this->where('produto_id', $produtoId);

        return count($this->findAll()) > 0;
    }

    public function atualizarCampos($vendaId, $produtoId, $campos)
    {
        $this->set($campos)
            ->where('venda_id', $vendaId)
            ->where('produto_id', $produtoId)
        ->update();
    }
}
