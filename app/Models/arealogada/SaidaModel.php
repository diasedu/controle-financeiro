<?php

namespace App\Models\Arealogada;

use CodeIgniter\Model;
use DateTime;

class SaidaModel extends Model
{
	protected $table = "saida";
	protected $primaryKey = "id_conta";

	protected $useAutoIncrement = false;

	protected $allowedFields = ["id_conta", "mes", "ano", "id_paga", "dt_paga", "dt_venc", "pago"];

	protected bool $allowEmptyInserts = false;

	protected $useSoftDeletes = false;

	public function getSaida()
	{
		$contaModel = new ContaModel();

		$listConta = $contaModel->where("sta_conta", "A")->findAll();

		$mes = date("m");
		$ano = date("Y");

		# Verifica se a saída existe considerando o mês e o ano
		foreach ($listConta as $row)
		{
			# Lógica para evitar popular a tabela com contas inativas.
			if ($row["sta_conta"] != "A")
			{
				continue;
			}

			$saidaExiste = $this->
				where("id_conta", $row["id_conta"])->
				where("mes", $mes)->
				where("ano", $ano)->
			findAll();

			# Lógica para inserir uma saída.
			if (!$saidaExiste)
			{
				$dtVenc = sprintf("%d-%s-%s", $ano, $mes, $row["dia_venct"]);

				$schema = [
					"id_conta" => $row["id_conta"],
					"mes" => $mes,
					"ano" => $ano,
					"id_paga" => null,
					"dt_paga" => null,
					"dt_venc" => $dtVenc,
					"pago" => false
				];

				$this->insert($schema);
			}
		}

		# Resgata as saídas do mês e ano atual.
		$list = $this->findAll();

		$pagas = [];
		$naoPagas = [];

		foreach ($list as $row)
		{
			$row["ref"] = date("m/Y", strtotime(sprintf("%s -1 month", $row["dt_venc"])));

			if (!$row["pago"])
			{
				array_push($naoPagas, $row);
				continue;
			}

			array_push($pagas, $row);
		}
		usort($naoPagas, function ($a, $b) {
			return strtotime($a["dt_venc"]) - strtotime($b["dt_venc"]);
		});

		usort($pagas, function ($a, $b) {
			return strtotime($a["dt_venc"]) - strtotime($b["dt_venc"]);
		});
		return [
			"listPaga" => $pagas,
			"listNaoPaga" => $naoPagas
		];
	}

	public function mudarStatus($data)
	{
		$dtVencArray = explode("-", $data["dt_venc"]);

		$mes = $dtVencArray[1];
		$ano = $dtVencArray[0];
		$pago = ($data["pago"] ? true : false);

		$binds = [
			"id_conta" => $data["id_conta"],
			"mes" => $mes,
			"ano" => $ano,
			"id_paga" => $data["id_paga"],
			"dt_paga" => $data["dt_paga"],
			"pago" => $pago
		];

		$sql = "
			UPDATE saida
			   SET id_paga = :id_paga:,
			   	   dt_paga = :dt_paga:,
				   pago = :pago:
			 WHERE id_conta = :id_conta:
			   AND mes = :mes:
			   AND ano = :ano:
		";

		$this->db->query($sql, $binds);
	}
}
