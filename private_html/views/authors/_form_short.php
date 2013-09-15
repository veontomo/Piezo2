<?php
	$length = count($model);
	for($i=0; $i < $length; $i++){
?>
<?php echo CHtml::errorSummary($model[$i]); ?>
 
<div class="row">
    <?php echo CHtml::activeLabel($model[$i], 'Author'); ?>
    <?php echo CHtml::activeDateField($model[$i], "[$i]name", array('placeholder' => 'name')); ?>
    <?php echo CHtml::activeDateField($model[$i], "[$i]surname", array('placeholder' => 'surname')); ?>
</div>

<?php
		
	}

?>