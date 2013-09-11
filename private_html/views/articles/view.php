<?php
/* @var $this ArticlesController */
/* @var $model Articles */

$this->breadcrumbs=array(
	'Articles'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List of Articles', 'url'=>array('index')),
	array('label'=>'Add Article', 'url'=>array('create')),
	array('label'=>'Update Article', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Article', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
		'confirm'=>'Are you sure you want to delete this item?'
		)
	),
	array('label'=>'Manage Articles', 'url'=>array('admin')),
);
?>

<h1>Article #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		'abstract',
		'url',
		'year',
		'page',
		array(               
            'label'=>'Journal',
            'type'=>'raw',
            'value'=>CHtml::encode($model->journal0->name)
        ),
		array(               
            'label'=>'Keywords',
            'type'=>'raw',
            'value'=>CHtml::encode($model->allKeywordsString()),
        ),
	),
)); ?>
