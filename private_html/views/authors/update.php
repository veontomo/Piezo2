<?php
/* @var $this AuthorsController */
/* @var $model Authors */

$this->breadcrumbs=array(
	'Authors'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List of Authors', 'url'=>array('index')),
	array('label'=>'Add Author', 'url'=>array('create')),
	array('label'=>'View Author info', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Authors', 'url'=>array('admin')),
);
?>

<h1>Update author info </h1>
<h2><?php echo $model->surname. ' ' . $model->name; ?></h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>