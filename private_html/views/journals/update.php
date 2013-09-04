1qazxsw2
<?php
/* @var $this JournalsController */
/* @var $model Journals */

$this->breadcrumbs=array(
	'Journals'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Journals', 'url'=>array('index')),
	array('label'=>'Create Journals', 'url'=>array('create')),
	array('label'=>'View Journals', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Journals', 'url'=>array('admin')),
);
?>

<h1>Update <?php echo $model->name; ?></h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

