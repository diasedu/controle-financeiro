<?php

namespace App\Models\Arealogada;

use CodeIgniter\Model;

class PagadorModel extends Model
{
	protected $table = "pagador";
	protected $primaryKey = "id_paga";

	protected $useAutoIncrement = false;

	protected $allowedFields = ["id_paga", "nome_paga", "sta_paga"];

	protected bool $allowEmptyInserts = false;

	protected $useSoftDeletes = false;


	public function getId(): int
	{	
		$sql = "
			SELECT NVL(MAX(id_paga), 0) + 1 AS id_paga FROM pagador
		";

		$lastId = $this->db->query($sql)->getRowArray()["id_paga"];

		return $lastId;
	}
}
