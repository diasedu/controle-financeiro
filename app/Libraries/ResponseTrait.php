<?php
namespace App\Libraries;

use CodeIgniter\HTTP\ResponseInterface;

trait ResponseTrait
{
    protected function jsonSuccess(
        string $message = '', 
        array $data = []
    ): ResponseInterface {
        return $this->response->setJSON([
            'error'   => false,
            'message' => $message ?: 'Operação realizada com sucesso',
            'data'    => $data
        ]);
    }

    protected function jsonError(string $message = ''): ResponseInterface {
        return $this->response->setJSON([
            'error'   => true,
            'message' => $message ?: 'Ops, houve um problema técnico, tente novamente'
        ]);
    }
}
