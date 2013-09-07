<?php
/* @var $this ArticlesController */
/* @var $model Articles */

$this->breadcrumbs=array(
	'Articles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List of Articles', 'url'=>array('index')),
	array('label'=>'Manage Articles', 'url'=>array('admin')),
);
?>

<h1>Add Article</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'keyword' => $keyword)); ?>

