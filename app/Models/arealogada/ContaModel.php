<?php

namespace App\Models\Arealogada;

use CodeIgniter\Model;

class ContaModel extends Model
{
	protected $table = "conta";
	protected $primaryKey = "id_conta";

	protected $useAutoIncrement = true;

	protected $allowedFields = ["id_conta", "desc_conta", "valor_conta", "sta_conta", "tipo_conta", "dia_venct"];

	protected bool $allowEmptyInserts = false;
}
