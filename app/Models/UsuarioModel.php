<?php

namespace App\Models;

use App\Entities\Usuario;
use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usua';

    protected $useAutoIncrement = true;

    protected $returnType = Usuario::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_usua', 'nome_usua', 'senha_usua', 'email_usua', 'id_sitc'];

    protected bool $allowEmptyInserts = false;

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /**
     * Busca um usuário pelo email
     * 
     * @param string $email
     * @return Usuario|null
     */
    public function findByEmail(string $email): ?Usuario {
        return $this->where('email_usua', $email)->first();
    }
}