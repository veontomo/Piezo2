<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

/**
*	This method prints a string in the console, if in the debugging mode.
* Prints the argument in the console when YII_DEBUG is set to TRUE
* @param 	string $text
* @return void
*/
public function showinfo($text){
   if(defined('YII_DEBUG') && 'YII_DEBUG'){
       echo Yii::trace(CVarDumper::dumpAsString($text),'vardump');
   }
}
}