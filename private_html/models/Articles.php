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
class Articles extends CActiveRecord
{
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
}