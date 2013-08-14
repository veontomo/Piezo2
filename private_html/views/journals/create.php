<?php
/* @var $this JournalsController */
/* @var $model Journals */

$this->breadcrumbs=array(
	'Journals'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List of Journals', 'url'=>array('index')),
	array('label'=>'Manage Journals', 'url'=>array('admin')),
);
?>

<h1>Add Journal</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>