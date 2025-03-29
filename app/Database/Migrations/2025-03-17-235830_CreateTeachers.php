<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTeachers extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],

            'address_id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],

            'code' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],

            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],

            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
            ],

            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],

            'cpf' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
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
        ]);

        // Definindo as chaves primárias
        $this->forge->addKey('id', true);
        $this->forge->addKey('address_id');
        $this->forge->addKey('code');
        $this->forge->addKey('name');
        $this->forge->addKey('email');
        $this->forge->addKey('phone');
        $this->forge->addKey('cpf');

       
        $this->forge->addForeignKey('address_id', 'addresses', 'id', 'CASCADE', 'CASCADE');

       
       
        $this->forge->createTable('teachers');
    }

    public function down()
    {
       
        $this->forge->dropTable('teachers');
    }
}
