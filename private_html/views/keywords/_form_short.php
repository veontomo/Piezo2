<?php echo CHtml::errorSummary($model); ?>
 
<div class="row">
    <?php echo CHtml::activeLabel($model,'name'); ?>
    <?php echo CHtml::activeDateField($model, 'name'); ?>
</div>