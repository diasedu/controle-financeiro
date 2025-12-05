<?php
namespace App\Services;

use App\Entities\Venda;
use App\Models\VendaItemModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use InvalidArgumentException;

class VendaService {
    public function processarInclusaoDeItem(
        int $venda_id, 
        int $produto_id, 
        int $qtd
    ): array {
        $vendaItemModel = new VendaItemModel();
        $venda = new Venda();

        try {
            $itens = $vendaItemModel->findItensWithNameByID($venda_id);

            $venda->setItens($itens);
            $venda->itemPodeSerIncluido($produto_id);
        } catch (DatabaseException $e) {
            return [
                'error'   => true,
                'message' => $e->getMessage(),
            ];
        } catch (InvalidArgumentException $e) {
            return [
                'error'   => true,
                'message' => $e->getMessage(),
            ];
        }

        return [];
    }

}