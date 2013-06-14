<?php
/* @var $this KeywordsController */
/* @var $model Keywords */

$this->breadcrumbs=array(
	'Keywords'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Keywords', 'url'=>array('index')),
	array('label'=>'Create Keywords', 'url'=>array('create')),
	array('label'=>'View Keywords', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Keywords', 'url'=>array('admin')),
);
?>

<h1>Update Keywords <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>