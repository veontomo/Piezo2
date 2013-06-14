<?php

class m130613_190013_create_keyword_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('keywords', array(
            'id' => 'pk',
            'name' => 'string NOT NULL',
        ));
        echo "Table 'keywords' is created successfully.\n";
        return true;
    }

    public function down()
    {
        $this->dropTable('keywords');
        echo "Table 'keywords' is deleted successfully.\n";
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