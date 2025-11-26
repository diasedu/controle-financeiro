<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPrecoPorKgToProdutos extends Migration
{
    public function up()
    {
        $this->forge->addColumn('produtos', [
            'preco_kg' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => true,
                'after'      => 'preco',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('produtos', 'preco_kg');
    }
}