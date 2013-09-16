<?php
/* @var $this ArticlesController */
/* @var $data Articles */
?>

<article>

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::link($data->title, $data->url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('abstract')); ?>:</b>
	<?php echo CHtml::encode($data->abstract); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('year')); ?>:</b>
	<?php echo CHtml::encode($data->year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('page')); ?>:</b>
	<?php echo CHtml::encode($data->page); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('journal')); ?>:</b>
	<?php echo CHtml::encode($data->journal0->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('keyword')); ?>:</b>
	<?php echo CHtml::encode($data->allKeywordsString()); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('authors')); ?>:</b>
	<?php echo CHtml::encode($data->allAuthorsString()); ?>
	<br />


	<?php echo CHtml::link(CHtml::encode("Details"), array('view', 'id'=>$data->id)); ?>


</article>