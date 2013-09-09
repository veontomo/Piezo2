<?php

class m130907_183909_articles_keywords extends CDbMigration
{
	public function up()
	{
		 $this->createTable('articles_keywords', array(
            'article_id' => 'integer',
            'keyword_id' => 'integer',
        ));
		$this->addForeignKey('reference_to_article', 'articles_keywords', 'article_id',
			'articles', 'id', 'RESTRICT', 'CASCADE');
		$this->addForeignKey('reference_to_keyword', 'articles_keywords', 'keyword_id',
			'keywords', 'id', 'RESTRICT', 'CASCADE');
		echo 'the table articles_keywords along with the FKs has been created succesefully';
	}

	public function down()
	{
		$this->dropForeignKey('reference_to_keyword', 'articles_keywords');
		$this->dropForeignKey('reference_to_article', 'articles_keywords');
		$this->dropTable('articles_keywords');
		echo 'the table articles_keywords along with the FKs has been dropped succesefully';
		return true;
	}
}