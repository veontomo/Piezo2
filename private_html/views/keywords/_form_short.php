<?php echo CHtml::errorSummary($model); ?>
 
<div class="row">
    <?php echo CHtml::activeLabel($model,'name'); ?>
    <?php echo CHtml::activeDateField($model, 'name', array('placeholder' => 'comma separate list of keywords')); ?>
</div>