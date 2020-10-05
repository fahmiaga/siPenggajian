<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Karyawan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_karyawan'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'id_pekerjaan'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'nama_karyawan' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'password' => [
				'password'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'tgl_lahir' => [
				'type'           => 'DATE',
			],
			'nik' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'gender' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'alamat' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'pekerjaan' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'status_kawin' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'jml_anak' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'thn_masuk' => [
				'type'           => 'YEAR',
			],
			'foto' => [
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
		$this->forge->addKey('id_karyawan', true);
		$this->forge->createTable('karyawan');
	}

	public function down()
	{
		$this->forge->dropTable('karyawan');
	}
}
