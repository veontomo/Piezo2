<?php

/**
 * This is the model class for table "authors".
 *
 * The followings are the available columns in table 'authors':
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $description
 */
class Authors extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Authors the static model class
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
		return 'authors';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('surname', 'required'),
			array('name, surname', 'length', 'max'=>255),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, surname, description', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'surname' => 'Surname',
			'description' => 'Additional information',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	* Retrieves the author by the given name and surname. If the model does not exist, creates it.
	* @param $arr array of the form: array('name' => ..., 'surname' => ...)
	* @return an instance of Authors model
	*/
	public static function find_or_create_by_name_and_surname($arr){
		$name = trim($arr['name']);
		$surname = trim($arr['surname']);
		$authorModel = Authors::model()->find('name = :name AND surname = :surname', 
				array(':name' => $name, ':surname' => $surname));
		if(!$authorModel){
			$authorModel = new Authors;
			$authorModel->name = $name;
			$authorModel->surname = $surname;
			$authorModel->save();
		}
		return $authorModel;
	}

	/** 
	*	Retrieves articles associated with the author
	*/
	public function articles(){
		$articles = array();
		$articles_authors = ArticlesAuthors::model()->findAll('author_id = :author_id', 
			array(':author_id' => $this->id));
		foreach($articles_authors as $record){
			$article = Articles::model()->findByPk($record['article_id']);
			if($article){
				$articles[] = $article;
			}
		}
		return $articles;
	}
	/** 
	*	Produces a string with article titles associated with the author
	*/
	public function articlesString(){
		$articles = $this->articles();
		$output = array();
		foreach ($articles as $article) {
			$output[] = $article['title'];
		}
		return implode(', ', $output);
	}
}