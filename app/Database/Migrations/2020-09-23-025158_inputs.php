<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Inputs extends Migration
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
			'supplier_id' => [
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
		$this->forge->dropTable('inputs',TRUE);
		// $this->forge->addForeignKey('product_id','product','product_id','CASCADE','CASCADE');
		// $this->forge->addForeignKey('supplier_id','suppliers','id','CASCADE','CASCADE');
		$this->forge->createTable('inputs');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('inputs',TRUE);
	}
}
