<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tanggal extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_tanggal'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'tanggal'       => [
				'type'           => 'date',
			],
			'created_at' => [
				'type'           => 'DATETIME',
				'null'    		 => true,
			],
			'updated_at' => [
				'type'           => 'DATETIME',
				'null'    		 => true,
			]
		]);
		$this->forge->addKey('id_tanggal', true);
		$this->forge->createTable('tanggal');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tanggal');
	}
}
