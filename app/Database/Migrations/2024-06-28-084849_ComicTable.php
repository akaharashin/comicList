<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ComicTable extends Migration
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
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'author' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'mangaLabel' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'genre' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'cover' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);

        // Add primary key
        $this->forge->addKey('id', true);

        // Create the table
        $this->forge->createTable('comics');
    }

    public function down()
    {
        $this->forge->dropTable('comics');
    }
}
