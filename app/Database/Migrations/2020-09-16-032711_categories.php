<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categories extends Migration
{
	public function up()
	{
		//
		$this->forge->addField([
			'id' => [
				'type' => 'BIGINT',
				'constraint' => 20,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'category_name' => [
				'type' => 'VARCHAR',
				'constraint' => 100,
				
			],
			'category_status' => [
				'type' => 'ENUM',
				'constraint' => "'Active','Inactive'",
				'default' => 'Active',
				
			],

		]);
		// $this->forge->dropTable('categories',TRUE);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('categories');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
