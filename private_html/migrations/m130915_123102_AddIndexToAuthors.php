<?php

class m130915_123102_AddIndexToAuthors extends CDbMigration
{
	public function up()
	{
		$this->createIndex('name_surname', 'authors', 'name, surname', true);
		echo 'added index on the articles(name, surname)';
	}

	public function down()
	{
		echo "m130915_123102_AddIndexToAuthors does not support migration down.\n";
		$this->dropIndex('name_surname', 'authors');
		return true;
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