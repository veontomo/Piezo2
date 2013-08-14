<?php
/* @var $this JournalsController */
/* @var $model Journals */

$this->breadcrumbs=array(
	'Journals'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List all Journals', 'url'=>array('index')),
	array('label'=>'Add Journal', 'url'=>array('create')),
	array('label'=>'Update Journal Info', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Remove '.$model->name, 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Journals', 'url'=>array('admin')),
);
?>

<h1>Journal</h1>
<h2><?php echo $model->name; ?></h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'url',
		'description',
	),
)); ?>
