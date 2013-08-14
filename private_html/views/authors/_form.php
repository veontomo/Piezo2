<?php
/* @var $this AuthorsController */
/* @var $model Authors */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'authors-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('class' => 'ink-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="control-group">
		<?php echo $form->labelEx($model,'name'); ?>
		<br />
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<div class="control">
			<?php echo $form->error($model,'name'); ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'surname'); ?>
		<br />
		<?php echo $form->textField($model,'surname',array('size'=>60,'maxlength'=>255)); ?>
		<div class="control">
			<?php echo $form->error($model,'surname'); ?>
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
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->