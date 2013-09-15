<?php

class m130907_183909_articles_keywords extends CDbMigration
{
	public function up()
	{
		 $this->createTable('articles_keywords', array(
            'article_id' => 'integer NOT NULL',
            'keyword_id' => 'integer NOT NULL',
            'PRIMARY KEY (`article_id`, `keyword_id`)'
        ));
		$this->addForeignKey('reference_to_article', 'articles_keywords', 'article_id',
			'articles', 'id', 'RESTRICT', 'RESTRICT');
		$this->addForeignKey('reference_to_keyword', 'articles_keywords', 'keyword_id',
			'keywords', 'id', 'RESTRICT', 'RESTRICT');
		echo 'the table articles_keywords along with the FKs has been created successefully';
	}

	public function down()
	{
		$this->dropForeignKey('reference_to_keyword', 'articles_keywords');
		$this->dropForeignKey('reference_to_article', 'articles_keywords');
		$this->dropTable('articles_keywords');
		echo 'the table articles_keywords along with the FKs has been dropped successefully';
		return true;
	}
}