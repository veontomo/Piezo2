<?php
return CMap::mergeArray(
	require(dirname(__FILE__).'/main.php'),
	array(
		'components'=>array(
			'fixture'=>array(
				'class'=>'system.test.CDbFixtureManager',
			),
			// 'log'=>array(
		 //        'class' => 'CLogRouter',
   //     			'routes' => array(
		 //            array(
		 //                'class'=>'ext.yii-debug-toolbar.yii-debug-toolbar.YiiDebugToolbarRoute',
		 //                // Access is restricted by default to the localhost
		 //                'ipFilters'=>array('127.0.0.1'),
		 //            ),
		 //            array(
			// 			'class'=>'CWebLogRoute',
			// 			'levels'=>'trace',
			// 			'categories'=>'vardump',
			// 			'showInFireBug'=>true
			// 		),
		 //            array(
	  //                   'class'=>'CFileLogRoute',
	  //                   'levels'=>'trace, info',
	  //                   'categories'=>'system.*',
   //              	),
		 //        ),
		 //    ),
			'db' => require(dirname(__FILE__) . '/test_db.php'),
		),
	)
);
