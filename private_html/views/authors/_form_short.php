<?php
	$length = count($model);
	echo CHtml::activeLabel($model[0], 'Authors'); 
	for($i=0; $i < $length; $i++){
?>
<?php echo CHtml::errorSummary($model[$i]); ?>
<div class="control-group"> 
    
    <?php echo CHtml::activeDateField($model[$i], "[$i]name", array('placeholder' => 'name')); ?>
    <?php echo CHtml::activeDateField($model[$i], "[$i]surname", array('placeholder' => 'surname')); ?>
</div>

<?php
		
	}

?>