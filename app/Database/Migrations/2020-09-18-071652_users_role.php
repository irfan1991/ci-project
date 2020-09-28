<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsersRole extends Migration
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
			'user_id' => [
				'type' => 'INT',
				'constraint' => 20,
				
			],
			'role_id' => [
				'type' => 'INT',
				'constraint' => 20,
				
			],

		]);
		$this->forge->dropTable('user_role',TRUE);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('user_role');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		
		$this->forge->dropTable('user_role',TRUE);
	
	}
}
