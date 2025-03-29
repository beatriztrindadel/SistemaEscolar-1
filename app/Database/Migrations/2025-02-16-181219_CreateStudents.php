<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStudents extends Migration
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

            'parent_id' => [
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
        $this->forge->addKey('parent_id');
        $this->forge->addKey('code');
        $this->forge->addKey('name');
        $this->forge->addKey('email');
        $this->forge->addKey('phone');
        $this->forge->addKey('cpf');

        // Adicionando a chave estrangeira
        $this->forge->addForeignKey('parent_id', 'parents', 'id', 'CASCADE', 'CASCADE');

       
        // Criando a tabela 'parents'
        $this->forge->createTable('students');
    }

    public function down()
    {
        // Caso precise desfazer a migração
        $this->forge->dropTable('students');
    }
}
