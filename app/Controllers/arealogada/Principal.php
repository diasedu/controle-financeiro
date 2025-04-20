<?php

namespace App\Controllers\Arealogada;

use App\Controllers\BaseController;

class Principal extends BaseController
{
    public function __construct()
    {
        helper("form");
    }

    public function index(): string
    {
        return view("arealogada/principal/principal");
    }
}