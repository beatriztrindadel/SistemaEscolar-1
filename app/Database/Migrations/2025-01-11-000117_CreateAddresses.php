<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAddresses extends Migration
{
    public function up()
    {
        // Verifica se a tabela 'addresses' existe
        $db = \Config\Database::connect();
        $result = $db->query("SHOW TABLES LIKE 'addresses'")->getRow();

        if (!$result) {
            // A tabela não existe, então criamos
            $this->forge->addField([
                'id' => [
                    'type'              => 'INT',
                    'constraint'        => 11,
                    'unsigned'          => true,
                    'auto_increment'    => true,
                ],
                'street' => [
                    'type' => 'VARCHAR',
                    'constraint' => 70,
                ],
                'address' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                ],
                'city' => [
                    'type' => 'VARCHAR',
                    'constraint' => 70,
                ],
                'district' => [
                    'type' => 'VARCHAR',
                    'constraint' => 70,
                ],
                'postal_code' => [
                    'type' => 'VARCHAR',
                    'constraint' => 9,
                ],
                'state' => [
                    'type' => 'VARCHAR',
                    'constraint' => 2,
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                    'default' => null,
                ],
                'updated_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                    'default' => null,
                ],
                'number' => [
                    'type' => 'VARCHAR',
                    'constraint' => 20,
                    'null' => true,
                    'default' => null,
                ],
            ]);

            $this->forge->addKey('id', true);
            $this->forge->addKey('postal_code');
            $this->forge->addKey('state');
            $this->forge->addKey('city');
            $this->forge->addKey('district');
            $this->forge->addKey('street');

            // Cria a tabela 'addresses'
            $this->forge->createTable('addresses');
        }
    }

    public function down()
    {
        // Remove a tabela 'addresses' se ela existir
        $db = \Config\Database::connect();
        $result = $db->query("SHOW TABLES LIKE 'addresses'")->getRow();

        if ($result) {
            $this->forge->dropTable('addresses');
        }
    }
}