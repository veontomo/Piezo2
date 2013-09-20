<?php

class m130920_091021_AddVolumeToArticle extends CDbMigration
{
	public function up()
	{
		$this->addColumn('articles', 'volume', 'string');
		echo 'column "volume" is added to the table "articles"', PHP_EOL;

	}

	public function down()
	{
		$this->dropColumn('articles', 'volume');
		echo 'column "volume" is dropped from the table "articles"', PHP_EOL;
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