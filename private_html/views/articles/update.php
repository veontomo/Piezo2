<?php
	Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl .'/js/jquery-2.0.3.min.js', CClientScript::POS_END); 
?>
<?php
/* @var $this ArticlesController */
/* @var $model Articles */

$this->breadcrumbs=array(
	'Articles'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List of Articles', 'url'=>array('index')),
	array('label'=>'Add Article', 'url'=>array('create')),
	array('label'=>'View Article Info', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Articles', 'url'=>array('admin')),
);
?>

<h1>Update Article Info</h1>

<?php echo $this->renderPartial('_form', array('model' => $model, 'keyword' => $keyword, 'authors' => $authors)); ?>

<?php
	Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl .'/js/articles/add_authors.js', CClientScript::POS_END); 
?>