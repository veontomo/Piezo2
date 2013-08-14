<?php
/* @var $this JournalsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Journals',
);

$this->menu=array(
	array('label'=>'Add Journal', 'url'=>array('create')),
	array('label'=>'Manage Journals', 'url'=>array('admin')),
);
?>

<h1>List of Journals</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
