<?php

class m130613_172302_create_journal_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('journals', array(
            'id' => 'pk',
            'name' => 'string NOT NULL',
            'url' => 'string',
            'description' => 'text'
        ));
        echo "Table 'journals' is created successfully.";
        return true;
    }

    public function down()
    {
        $this->dropTable('journals');
        echo "Table 'journals' is deleted successfully.";
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