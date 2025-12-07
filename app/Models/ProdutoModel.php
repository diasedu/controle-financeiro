<?php

namespace App\Models;

use App\Entities\Produto;
use CodeIgniter\Model;

class ProdutoModel extends Model
{
    protected $table = 'produtos';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = Produto::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nome', 'preco', 'preco_kg', 'tipo_cobranca', 'status'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'nome' => [
            'label' => 'Nome',
            'rules' => 'required|min_length[2]|max_length[150]',
        ],
        'preco' => [
            'label' => 'Preço',
            'rules' => 'required|decimal',
        ],
        'preco_kg' => [
            'label' => 'Preço por quilo',
            'rules' => 'decimal',
        ],
        'status' => [
            'label' => 'Status',
            'rules' => 'permit_empty|in_list[0,1]',
        ],
    ];

    public function findAtivos(): array {
        return $this->where('status', 1)->findAll();
    }

    public function findByIds(array $ids): array {
        return $this->whereIn('id', $ids)->findAll();
    }

    public function getPrecoPorID($id)
    {
        $this->select('preco');

        return $this->find($id);
    }
}


