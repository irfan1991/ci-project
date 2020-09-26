<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Suppliers extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'BIGINT',
				'constraint' => 20,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'supplier_name' => [
				'type' => 'VARCHAR',
				'constraint' => 30,
				
			],
			'supplier_phone' => [
				'type' => 'VARCHAR',
				'constraint' => 20,	
			],
			'lat' => [
				'type' => 'VARCHAR',
				'constraint' => 20,	
			],
			'long' => [
				'type' => 'VARCHAR',
				'constraint' => 20,	
			],
			'street' => [
				'type' => 'VARCHAR',
				'constraint' => 20,	
			],
			'city' => [
				'type' => 'VARCHAR',
				'constraint' => 20,	
			],
			'country' => [
				'type' => 'VARCHAR',
				'constraint' => 20,	
			],

		]);
		$this->forge->dropTable('suppliers',TRUE);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('suppliers');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('suppliers',TRUE);
	}
}
