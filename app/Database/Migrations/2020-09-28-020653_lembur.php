<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Lembur extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_lembur'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'id_tanggal'          => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'id_karyawan'          => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'deskripsi'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'lama_lembur'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '11',
			],
			'status'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'total'       => [
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
		$this->forge->addKey('id_lembur', true);
		$this->forge->createTable('lembur');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('lembur');
	}
}
