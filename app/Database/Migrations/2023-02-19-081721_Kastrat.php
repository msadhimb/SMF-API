<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kastrat extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'kastrat_author' => [
                'type' => 'text',
                'null' => true,
            ],
            'kastrat_image' => [
                'type' => 'text',
                'null' => true,
            ],
            'kastrat_title' => [
                'type' => 'text',
                'null' => true,
            ],
            'kastrat_subject' => [
                'type' => 'text',
                'null' => true,
            ],
            'kastrat_desc' => [
                'type' => 'text',
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
        $this->forge->createTable('kastrats');
    }

    public function down()
    {
        //
    }
}
