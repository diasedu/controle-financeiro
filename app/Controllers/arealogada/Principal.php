<?php

namespace App\Controllers\Arealogada;

use App\Controllers\BaseController;

class Principal extends BaseController
{
    public function __construct()
    {
        helper("form");
    }

    public function index()
    {
        echo view("templates/header", ["titulo" => "Principal"]);
        echo view("arealogada/principal/principal");
        echo view("templates/footer");
    }
}