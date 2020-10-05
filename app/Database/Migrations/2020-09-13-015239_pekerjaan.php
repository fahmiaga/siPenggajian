<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pekerjaan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_pekerjaan'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'nama_pekerjaan'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'gaji' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
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
		$this->forge->addKey('id_pekerjaan', true);
		$this->forge->createTable('pekerjaan');
	}

	public function down()
	{
		$this->forge->dropTable('pekerjaan');
	}
}
