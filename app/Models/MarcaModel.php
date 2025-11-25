<?php

namespace App\Models;

use App\Entities\Marca;
use CodeIgniter\Model;

class MarcaModel extends Model
{
    protected $table = 'marcas';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = Marca::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nome', 'status'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'nome' => [
            'label' => 'Nome',
            'rules' => 'required|min_length[2]|max_length[100]',
            'errors' => [
                'required' => 'O campo {field} é obrigatório.',
                'min_length' => 'O campo {field} deve ter no mínimo {param} caracteres.',
                'max_length' => 'O campo {field} deve ter no máximo {param} caracteres.',
            ]
        ],
        'status' => [
            'label' => 'Status',
            'rules' => 'permit_empty|in_list[0,1]',
            'errors' => [
                'in_list' => 'O campo {field} deve ser 0 (Inativo) ou 1 (Ativo).',
            ]
        ],
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    /**
     * Busca apenas marcas ativas
     * 
     * @return array|Marca[]
     */
    public function findAtivas(): array
    {
        return $this->where('status', 1)->findAll();
    }

    /**
     * Busca uma marca pelo nome
     * 
     * @param string $nome
     * @return Marca|null
     */
    public function findByNome(string $nome): ?Marca
    {
        return $this->where('nome', $nome)->first();
    }
}
