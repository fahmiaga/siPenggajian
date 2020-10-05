<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Gaji extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_gaji'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'id_pekerjaan'          => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'id_karyawan'          => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'id_tanggal'          => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'tgl_gaji'           => [
				'type' 			 => 'DATE'
			],
			'tjg_pekerjaan' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'tjg_anak' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'lembur' => [
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
		$this->forge->addKey('id_gaji', true);
		$this->forge->createTable('gaji');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('gaji');
	}
}
