<?php
/* @var $this JournalsController */
/* @var $model Journals */

$this->breadcrumbs=array(
	'Journals'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Journals', 'url'=>array('index')),
	array('label'=>'Create Journals', 'url'=>array('create')),
	array('label'=>'Update Journals', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Journals', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Journals', 'url'=>array('admin')),
);
?>

<h1>View Journals #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'url',
		'description',
	),
)); ?>
