<?php

/**
 * This is the model class for table "articles".
 *
 * The followings are the available columns in table 'articles':
 * @property integer $id
 * @property string $title
 * @property string $abstract
 * @property string $url
 * @property string $year
 * @property string $page
 * @property integer $journal
 *
 * The followings are the available model relations:
 * @property Journals $journal0
 */
class Articles extends ManyManyActiveRecord{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Articles the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'articles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('journal', 'numerical', 'integerOnly'=>true),
			array('title, url', 'length', 'max'=>255),
			array('year', 'length', 'max'=>4),
			array('page', 'length', 'max'=>8),
			array('abstract', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, abstract, url, year, page, journal', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'journal0' => array(self::BELONGS_TO, 'Journals', 'journal'),
			//'keywords' => array(self::HAS_MANY, 'Keywords', 'articles_keywords(article_id, keyword_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'abstract' => 'Abstract',
			'url' => 'Url',
			'year' => 'Year',
			'page' => 'Page',
			'journal' => 'Journal',
		);
	}


	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('abstract',$this->abstract,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('year',$this->year,true);
		$criteria->compare('page',$this->page,true);
		$criteria->compare('journal',$this->journal);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	*	Returns an array which elements are instances of class 'Keywords'. These instances are associated
	* 	to the 'Articles' instance
	*	@return array of 'Articles'
	*/
	public function keywords(){
		$rels = ArticlesKeywords::model()->findAll('article_id = :aid', array(':aid' => $this->id));
		$keywords = array();
		foreach ($rels as $value) {
			$keyword = Keywords::model()->findByPk($value->keyword_id);
			if($keyword){
				$keywords[] = $keyword;
			}
		}
		return $keywords;
	}

	public function authors(){
		$rels = ArticlesAuthors::model()->findAll('article_id = :aid', array(':aid' => $this->id));
		$authors = array();
		foreach ($rels as $value) {
			$author = Authors::model()->findByPk($value->author_id);
			if($author){
				$authors[] = $author;
			}
		}
		return $authors;
	}

	public function allKeywordsString(){
		$keywordModels = $this->keywords();
		$keywords = array();
//		if(!$keywordModels){$keywords[] = "empty! for {$this->id}";}
		foreach ($keywordModels as $value) {

			$keywords[] = $value->name;
		}
		return implode(", ", $keywords);
	}

	public function allAuthorsString(){
		$authorsModels = $this->authors();
		$authors = array();
		foreach ($authorsModels as $value) {

			$authors[] = $value->name . ' ' . $value->surname;
		}
		return implode(", ", $authors);
	}

	public function bindKeyword(Keywords $keyword){
		$article_id = $this->id;
		$keyword_id = $keyword->id;
		$rel = ArticlesKeywords::model()->find('article_id = :aid AND keyword_id = :kid', 
			array(':aid' => $article_id, ':kid' => $keyword_id));
		if(!$rel){
			$rel = new ArticlesKeywords;
			$rel->article_id = $article_id;
			$rel->keyword_id = $keyword_id;
			$rel->save();
		}
	}

	public function unbindKeyword(Keywords $keyword){
		$article_id = $this->id;
		$keyword_id = $keyword->id;
		$rel = ArticlesKeywords::model()->find('article_id = :article_id AND keyword_id = :keyword_id', 
			array(':article_id' => $article_id, ':keyword_id' => $keyword_id));
		if($rel){
			$rel->delete();
		}		
	}

	/**
	*	set keywords given as a string of comma separated words
	*	@param $keywordsString a comma separated string of keywords
	* 	The method compares the keywords already associated with the fiven Article
	*	with those to be set. The keywords that should be present but missing are bound to the
	*	Article, those that are present but that should not be present are unbound from the Article.
	*/
	public function setKeywordsString($keywordsString){
		$newKeywordsArray = array_unique(array_map('trim', explode(',', $keywordsString)));
		$presentKeywordsArray = array_unique(array_map('trim', explode(',', $this->allKeywordsString())));
		$keywordsToAddArray = array_diff($newKeywordsArray, $presentKeywordsArray);
		$keywordsToDropArray = array_diff($presentKeywordsArray, $newKeywordsArray);
		foreach ($keywordsToAddArray as $value) {
			$keyword = Keywords::model()->find_or_create_by_name($value);
			if($keyword){
				$this->bindKeyword($keyword);
			}
		}				
		foreach ($keywordsToDropArray as $value) {
			echo Yii::trace(CVarDumper::dumpAsString('unbinding: '. $value),'vardump');
			$keyword = Keywords::model()->find('name = :name', array(':name' => $value));
			if($keyword){
				$this->unbindKeyword($keyword);
			}
		}			
	}

	/**
	*	bind an instance of the Authors class to the Article
	*	@param $author 
	*	@return false (if the binding fails) or null (otherwise)
	* 	The method consults the ArticlesAuthors table in order to find article_id and  author_id.
	*	If not found, the record will be created with corresponding article_id and  author_id.
	*	If found, nothing is executed. 
	*/
	public function bindAuthor(Authors $author){
		$article_id = $this->id;
		$author_id = $author->id;
		$rel = ArticlesAuthors::model()->find('article_id = :article_id AND author_id = :author_id', 
			array(':article_id' => $article_id, ':author_id' => $author_id));
		if(!$rel){
			$rel = new ArticlesAuthors;
			$rel->article_id = $article_id;
			$rel->author_id = $author_id;
			if(!$rel->save()){
				return false;
			}
		}
	}

	/**
	*	unbind an instance of the Authors class to the Article
	*	@param $author 
	*	@return false (if the unbinding failed) or null (otherwise)
	* 	The method consults the ArticlesAuthors table in order to find article_id and  author_id.
	*	If found, the corresponding record will be deleted.
	*	If not found, nothing is executed. 
	*/
	public function unbindAuthor(Authors $author){
		$article_id = $this->id;
		$author_id = $author->id;
		$rel = ArticlesAuthors::model()->find('article_id = :article_id AND author_id = :author_id', 
			array(':article_id' => $article_id, ':author_id' => $author_id));
		if($rel){
			if(!$rel->delete()){
				return false;
			};
		}
	}

	public function unbindAllAuthors(){
		$article_id = $this->id;
		$rel = ArticlesAuthors::model()->findAll('article_id = :article_id', 
			array(':article_id' => $article_id));
		foreach ($rel as $value) {
			$value->delete();		
		}		
	}

	public function setAuthor($authorInfo){
		$name = trim($authorInfo['name']);
		$surname = trim($authorInfo['surname']);
		if($name && $surname){
			$author = Authors::model()->find_or_create_by_name_and_surname(array('name' => $name, 'surname' => $surname));
			$this->bindAuthor($author);
		}
	}

}