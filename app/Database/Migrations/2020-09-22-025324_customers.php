<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Customers extends Migration
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
			'customer_name' => [
				'type' => 'VARCHAR',
				'constraint' => 30,
				
			],
			'customer_phone' => [
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
		$this->forge->dropTable('customers',TRUE);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('customers');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('customers',TRUE);
	}
}
