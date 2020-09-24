<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Outputs extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'BIGINT',
				'constraint' => 20,
				'unsigned' => TRUE,
				'unique'   => TRUE,
				'auto_increment' => TRUE
			],
			'product_id' => [
				'type' => 'INT',
				'constraint' => 20,
				
			],
			'customer_id' => [
				'type' => 'INT',
				'constraint' => 20,	
			],
			'amount' => [
				'type' => 'INT',
				'constraint' => 50,	
			],
			'time' => [
				'type' => 'TIMESTAMP',
			],
			'createdby' => [
				'type' => 'VARCHAR',
				'constraint' => 50,	
				'null'   => TRUE,
			]
			
		]);

		$this->forge->addForeignKey('product_id','product','product_id','CASCADE','CASCADE');
		$this->forge->addForeignKey('customer_id','customers','id','CASCADE','CASCADE');
		$this->forge->createTable('outputs');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
