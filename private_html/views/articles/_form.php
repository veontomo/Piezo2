<?php
/* @var $this ArticlesController */
/* @var $model Articles */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'articles-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('class' => 'ink-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<fieldset>
	<div class="control-group">
		<?php echo $form->labelEx($model,'title'); ?>
		<br />
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<div class="control">
			<?php echo $form->error($model,'title'); ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'abstract'); ?>
		<br />
		<?php echo $form->textArea($model,'abstract',array('rows'=>6, 'cols'=>50)); ?>
		<div class="control">
			<?php echo $form->error($model,'abstract'); ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'url'); ?>
		<br />
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
		<div class="control">
			<?php echo $form->error($model,'url'); ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'year'); ?>
		<br />
		<?php echo $form->textField($model,'year',array('size'=>4,'maxlength'=>4)); ?>
		<div class="control">
			<?php echo $form->error($model,'year'); ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'page'); ?>
		<br />
		<?php echo $form->textField($model,'page',array('size'=>8,'maxlength'=>8)); ?>
		<div class="control">
			<?php echo $form->error($model,'page'); ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'journal'); ?>
		<br />
		<?php echo $form->dropDownList($model,'journal', CHtml::listData(Journals::model()->findAll(),'id','name' )); ?>
		<div class="control">
			<?php echo $form->error($model,'journal'); ?>
		</div>
	</div>

<div id="authors">
	<?php echo $this->renderPartial('/authors/_form_short', array('model' => $authors)); ?>
</div>

<div class="control-group">
	<?php echo $this->renderPartial('/keywords/_form_short', array('model' => $keyword)); ?>
</div>


	<div class="control-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Add' : 'Update'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->