<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Cliente;

class ClienteModel extends Model
{
    protected $table            = 'clientes';
    protected $primaryKey       = 'id';

    protected $returnType       = Cliente::class;
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'nome',
        'telefone',
        'email'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
