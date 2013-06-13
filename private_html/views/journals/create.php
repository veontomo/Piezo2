<?php
/* @var $this JournalsController */
/* @var $model Journals */

$this->breadcrumbs=array(
	'Journals'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Journals', 'url'=>array('index')),
	array('label'=>'Manage Journals', 'url'=>array('admin')),
);
?>

<h1>Create Journals</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>