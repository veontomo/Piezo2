<!DOCTYPE html>
<head>
		<meta charset="utf-8" />
		<meta name="language" content="en" />
		<meta name="viewport" content="width=device-width" />
		<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/ink/docs.css" />
		<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/ink/ink.css" />
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<nav class="ink-navigation">
	<?php 
		$this->widget('zii.widgets.CMenu',array(
			'htmlOptions' => array(
                    'class'=>'menu horizontal shadowed black',
                        ),
			'encodeLabel' => false,
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Articles', 'url'=>array('/articles/index')),
				array('label'=>'Journals', 'url'=>array('/journals/index'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Authors', 'url'=>array('/authors/index'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 
					'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
				),
			)
		); 
	?>
</nav><!-- mainmenu -->
<nav class="ink-navigation">
<?php 
	if(isset($this->breadcrumbs)):
?>
<?php 
	$this->widget('zii.widgets.CBreadcrumbs', array(
		'links' => $this->breadcrumbs,
		'htmlOptions' => array(
                    'class' => 'breadcrumbs',
                        ),
		'separator' => '',
        'tagName'=>'ul', // will change the container to ul
        'activeLinkTemplate'=>'<li><a href="{url}">{label}</a></li>', // will generate the clickable breadcrumb links 
        'inactiveLinkTemplate'=>'<li>{label}</li>', // will generate the current page url : <li>News</li>
        'homeLink'=>'<li><a href="'.Yii::app()->homeUrl.'">Home</a></li>' ,
		)); 
?><!-- breadcrumbs -->
<?php endif?>
</nav>

<?php 
	echo $content; 
?>

<div class="clear">
</div>

<footer>
	<div class="large-33"></div>
	<div class="large-33">
		Copyright &copy; <?php echo date('Y'); ?> by PiezoWorld. 
	</div>
	<div class="large-33"></div>
</footer>
</body>
</html>
