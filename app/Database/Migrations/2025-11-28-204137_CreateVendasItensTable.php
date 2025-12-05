<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVendasItensTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'venda_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],

            'produto_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],

            'quantidade' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'default'    => 1,
            ],

            'preco_unitario' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],

            'preco_total' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
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

        // Foreign keys
        $this->forge->addForeignKey('venda_id', 'vendas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('produto_id', 'produtos', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('vendas_itens');
    }

    public function down()
    {
        $this->forge->dropTable('vendas_itens');
    }
}
