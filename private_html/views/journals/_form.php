<?php
/* @var $this JournalsController */
/* @var $model Journals */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'journals-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('class' => 'ink-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<fieldset>
	<div class="control-group">
		<?php echo $form->labelEx($model,'name'); ?>
		<br />
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<div class="control">
			<?php echo $form->error($model,'name'); ?>
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
		<?php echo $form->labelEx($model,'description'); ?>
		<br />
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<div class="control">
			<?php echo $form->error($model,'description'); ?>
		</div>
	</div>
	</fieldset>
	<div class="control-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Add' : 'Update'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->