<?php
namespace App\Libraries;

trait ExceptionTrait
{
    public function returnError($message)
    {
        return [
            'error'   => true,
            'message' => $message
        ];
    }
}
