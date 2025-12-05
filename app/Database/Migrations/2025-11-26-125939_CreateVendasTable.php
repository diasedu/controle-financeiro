<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVendasTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'cliente_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],

            'valor_total' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => false,
            ],

            'forma_pagamento' => [
                'type'       => 'ENUM',
                'constraint' => ['dinheiro', 'pix', 'credito', 'debito', 'boleto'],
                'default'    => 'dinheiro',
            ],

            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pendente', 'pago', 'cancelado'],
                'default'    => 'pendente',
            ],

            'observacoes' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);

        # 🔗 Foreign Key - cliente_id → clientes.id
        $this->forge->addForeignKey('cliente_id', 'clientes', 'id', 'CASCADE', 'SET NULL');

        $this->forge->createTable('vendas');
    }

    public function down()
    {
        $this->forge->dropTable('vendas');
    }
}
