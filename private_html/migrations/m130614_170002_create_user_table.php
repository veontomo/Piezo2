<?php

class m130614_170002_create_user_table extends CDbMigration
{
	public function up()
	{
        return $this->createTable('users',array('id'=>"pk",
            'login'=>'string NOT NULL',
            'pswd' => 'varchar(255)'));
	}

	public function down()
	{
       return $this->dropTable('users');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}