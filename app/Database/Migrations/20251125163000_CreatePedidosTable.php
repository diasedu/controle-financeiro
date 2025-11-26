<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePedidosTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'cliente_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true
            ],
            'usuario_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'data_pedido' => [
                'type' => 'DATETIME',
                'null' => false
            ],
            'subtotal' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0
            ],
            'desconto_total' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0
            ],
            'valor_total' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['aberto', 'finalizado', 'cancelado'],
                'default' => 'aberto'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('cliente_id', 'clientes', 'id');
        $this->forge->addForeignKey('usuario_id', 'usuarios', 'id_usua');

        $this->forge->createTable('pedidos');
    }

    public function down()
    {
        $this->forge->dropTable('pedidos');
    }
}
