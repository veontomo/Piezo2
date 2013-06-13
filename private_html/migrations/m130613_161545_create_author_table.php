<?php

class m130613_161545_create_author_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('authors', array(
            'id' => 'pk',
            'name' => 'string',
            'surname' => 'string NOT NULL',
            'description' => 'text'
        ));
        echo "Table 'authors' is created successfully.";
        return true;
    }

    public function down()
    {
        $this->dropTable('authors');
        echo "Table 'authors' is deleted successfully.";
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