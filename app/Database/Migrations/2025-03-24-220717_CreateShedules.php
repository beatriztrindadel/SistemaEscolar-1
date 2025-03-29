<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateShedules extends Migration
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

            'class_id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],

            'subject_id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],

            'teacher_id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],

            'day_of_week' => [
                'type' => 'TINYINT',
                'constraint' => 1,
            ],

            
            'start_at' => [
                'type' => 'TIME',
                
            ],

            'end_at' => [
                'type' => 'TIME',
                
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
        $this->forge->addKey('class_id');
        $this->forge->addKey('subject_id');
        $this->forge->addKey('teacher_id');
        $this->forge->addKey('day_of_week');
        $this->forge->addKey('start_at');
        $this->forge->addKey('end_at');
        $this->forge->addKey('created_at');
        $this->forge->addKey('updated_at');

        // Adicionando a chave estrangeira
        $this->forge->addForeignKey('class_id', 'classes', 'id', 'CASCADE', 'CASCADE');

       
        // Criando a tabela 'parents'
        $this->forge->addForeignKey('subject_id', 'subjects', 'id', 'CASCADE', 'CASCADE');

        $this->forge->addForeignKey('teacher_id', 'teachers', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('schedules');
    }

    public function down()
    {
        // Caso precise desfazer a migração
        $this->forge->dropTable('schedules');
    }
}
