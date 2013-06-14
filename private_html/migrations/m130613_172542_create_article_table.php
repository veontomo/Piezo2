<?php

class m130613_172542_create_article_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('articles', array(
            'id' => 'pk',
            'title' => 'string NOT NULL',
            'abstract' => 'text',
            'url' => 'string',
            'year' => 'int(4) UNSIGNED',
            'page' => 'varchar(8)',
            'journal' => 'int'
        ));
        $this->addForeignKey('reference_to_journal','articles','journal','journals','id','RESTRICT','CASCADE');
        echo "Table 'articles' is created successfully.\n";
        return true;
    }

    public function down()
    {
        $this->dropForeignKey('reference_to_journal','articles');
        $this->dropTable('articles');
        echo "Table 'articles' is deleted successfully.\n";
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