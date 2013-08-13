<?php

class m130614_172240_seed_users extends CDbMigration
{
	public function up()
	{
        return $this->insert('users', array('login' => 'Andrew', 'pswd' => md5('test')));
    }

	public function down()
	{
       return $this->delete('users', 'login=:login', array(':login' => 'Andrew'));
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