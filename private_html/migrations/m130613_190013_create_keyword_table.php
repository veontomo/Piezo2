<?php

class m130613_190013_create_keyword_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('keywords', array(
            'id' => 'pk',
            'name' => 'string NOT NULL',
        ));
        echo "Table 'keywords' is created successfully.";
        return true;
    }

    public function down()
    {
        echo "Table 'keywords' is deleted successfully.";
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