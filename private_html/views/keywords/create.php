<?php
/* @var $this KeywordsController */
/* @var $model Keywords */

$this->breadcrumbs=array(
	'Keywords'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Keywords', 'url'=>array('index')),
	array('label'=>'Manage Keywords', 'url'=>array('admin')),
);
?>

<h1>Add keyword</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>