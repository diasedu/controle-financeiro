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

    protected $allowedFields = ['nome', 'preco', 'tipo_cobranca', 'status'];

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
        'tipo_cobranca' => [
            'label' => 'Tipo de Cobrança',
            'rules' => 'required|in_list[unidade,quilo]',
        ],
        'status' => [
            'label' => 'Status',
            'rules' => 'permit_empty|in_list[0,1]',
        ],
    ];
}


