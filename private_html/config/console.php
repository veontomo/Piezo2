<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// application components
	'components'=>array(
		'db'=>require(dirname(__FILE__) . '/dev_db.php'),
		'testDb'=>require(dirname(__FILE__) . '/test_db.php'),
//		'db'=>array(
//			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
//		),
		// uncomment the following to use a MySQL database
		// 'db'=>array(
		// 	'connectionString' => 'mysql:host=localhost;dbname=piezonuc_biblio',
		// 	'emulatePrepare' => true,
		// 	'username' => 'piezonuc_a1',
		// 	'password' => 'vYk*n4A',
		// 	'charset' => 'utf8',
		// ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),
);