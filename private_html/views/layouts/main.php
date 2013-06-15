<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <meta name="language" content="en" />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/custom.modernizr.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

        <nav class="top-bar" data-options="is_hover:false">
        <section class="top-bar-section">
        <?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                array('label'=>'Articles', 'url'=>array('/articles/index')),
                array('label'=>'Journals', 'url'=>array('/journals/index')),
                array('label'=>'Authors', 'url'=>array('/authors/index')),
                array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),

			),
		)); ?>
        </section>
	</nav><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by PiezoWorld.<br/>
		All Rights Reserved.<br/>
	</div><!-- footer -->

</body>
</html>
