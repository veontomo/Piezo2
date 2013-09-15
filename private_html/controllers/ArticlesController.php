<?php

class ArticlesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'delete', 'admin'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);
		// $keywords = $model ? $model->keywordsArray() : array();
		$this->render('view', array(
			'model' => $model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Articles;
		$keyword = new Keywords;
		$authors = array(new Authors);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Articles'])){
			$model->attributes=$_POST['Articles'];
			if($model->save()){
				if(isset($_POST['Keywords']['name']) && !empty($_POST['Keywords']['name'])){
					$model->setKeywordsString($_POST['Keywords']['name']);
				}
				if(isset($_POST['Authors']) && !empty($_POST['Authors'])){
					foreach ($_POST['Authors'] as $author) {
						$name = $author['name'];
						$surname = $author['surname'];
						$model->setAuthor(array('name' => $name, 'surname' => $surname));
					}
				}
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model' => $model, 
			'keyword' => $keyword,
			'authors' => $authors
		));
	
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$keyword = new Keywords;
		$keyword->name = $model->allKeywordsString();
		$authors = $model->authors();
		if(!$authors) $authors=array(new Authors);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Articles']))
		{
			$model->attributes=$_POST['Articles'];
			if($model->save()){
				if(isset($_POST['Keywords']['name'])){
					$model->setKeywordsString($_POST['Keywords']['name']);
				}
				$model->unbindAllAuthors();
				if(isset($_POST['Authors']) && !empty($_POST['Authors'])){
					foreach ($_POST['Authors'] as $author) {
						$name = $author['name'];
						$surname = $author['surname'];
						$model->setAuthor(array('name' => $name, 'surname' => $surname));
					}
				}
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'keyword' => $keyword,
			'authors' => $authors
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		$model->unbindAllAuthors();
		$keywords = $model->keywords();
		foreach ($keywords as $keyword) {
			$model->unbindKeyword($keyword);
		}
		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Articles');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Articles('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Articles']))
			$model->attributes=$_GET['Articles'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Articles the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Articles::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Articles $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='articles-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
