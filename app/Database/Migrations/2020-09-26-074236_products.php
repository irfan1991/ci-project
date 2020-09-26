<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Products extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'product_id' => [
				'type' => 'BIGINT',
				'constraint' => 20,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'product_name' => [
				'type' => 'VARCHAR',
				'constraint' => 30,
				
			],
			'product_price' => [
				'type' => 'INT',
				'constraint' => 20,	
			],
			'product_stock' => [
				'type' => 'INT',
				'constraint' => 20,	
			],
			'product_category' => [
				'type' => 'INT',
				'constraint' => 20,	
			],
			'photo' => [
				'type' => 'VARCHAR',
				'constraint' => 40,	
			],
			'description' => [
				'type' => 'TEXT',
			
			]
		]);

		
		$this->forge->dropTable('product',TRUE);
		$this->forge->addKey('product_id', TRUE);
		$this->forge->createTable('product');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('product',TRUE);
	}
}
