<?php

class m130915_112635_ArticlesAuthors extends CDbMigration
{
	public function up()
	{
		 $this->createTable('articles_authors', array(
            'article_id' => 'integer NOT NULL',
            'author_id' => 'integer NOT NULL',
            'PRIMARY KEY (`article_id`, `author_id`)'
        ));
		$this->addForeignKey('reference_to_article2', 'articles_authors', 'article_id',
			'articles', 'id', 'RESTRICT', 'RESTRICT');
		$this->addForeignKey('reference_to_author', 'articles_authors', 'author_id',
			'authors', 'id', 'RESTRICT', 'RESTRICT');
		echo 'the table articles_authors along with the FKs has been created successefully';
	}

	public function down()
	{
		echo "m130915_112635_ArticlesAuthors does not support migration down.\n";
		$this->dropForeignKey('reference_to_author', 'articles_authors');
		$this->dropForeignKey('reference_to_article2', 'articles_authors');
		$this->dropTable('articles_authors');
		echo 'the table articles_authors along with the FKs has been dropped successefully';
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