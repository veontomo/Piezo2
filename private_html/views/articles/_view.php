<?php
/* @var $this ArticlesController */
/* @var $data Articles */
?>

<article>

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::link($data->title, $data->url, array('class' => 'capitalize')); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('authors')); ?>:</b>
	<?php echo CHtml::encode($data->allAuthorsString()); ?>
	<br />

	
	<b><?php echo CHtml::encode('Reference'); ?>:</b>
	<?php echo CHtml::encode($data->journal0->name . ', '); ?>
	<?php echo CHtml::encode('vol. ' . $data->volume . ', '); ?>
	<?php echo CHtml::encode($data->year . ', '); ?>
	<?php echo CHtml::encode('p.') ?>
	<?php echo CHtml::encode($data->page); ?>
	<br />

	
	<b><?php echo CHtml::encode($data->getAttributeLabel('keyword')); ?>:</b>
	<?php echo CHtml::encode($data->allKeywordsString()); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('abstract')); ?>:</b>
	<?php echo CHtml::encode($data->abstract); ?>
	<br />


	<?php echo CHtml::link(CHtml::encode("Details"), array('view', 'id'=>$data->id)); ?>


</article>