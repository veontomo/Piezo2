<?php 
	
	echo CHtml::errorSummary($model); ?>
 
<div class="row">
    <?php echo CHtml::activeLabel($model,'name'); ?>
    <?php //echo CHtml::dropDownList($model,'keywords', CHtml::listData(Keywords::model()->findAll(),'id','name' )); 
    foreach (Keywords::model()->findAll() as $keyword) {
    	echo $keyword->name, CHtml::activeCheckBox($keyword, 'name['.$keyword->id.']', 
    		array('checked'=> 'unchecked', 'value' => $keyword->id));
    }
    echo CHtml::activeDateField($model, "name");
    ?>
    </div>