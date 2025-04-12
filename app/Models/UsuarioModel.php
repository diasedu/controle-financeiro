<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = "acesso.usuario";
    protected $primaryKey = "id_usua";

    protected $useAutoIncrement = true;

    protected $allowedFields = ["id_usua", "nome_usua", "senha_usua", "email_usua", "id_sitc"];

    protected bool $allowEmptyInserts = false;
}