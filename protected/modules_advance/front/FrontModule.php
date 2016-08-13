<?php

class FrontModule extends CWebModule
{
	public function init()
	{
	
	$this->setComponents(array(
            'errorHandler' => array(
                'errorAction' => 'admin/default/error'),
            'user' => array(
                'class' => 'CWebUser',             
                'loginUrl' => Yii::app()->createUrl('front/default/login'),
            )
        ));
 
       Yii::app()->user->setStateKeyPrefix('_front');
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'front.models.*',
			'front.components.*',
		));
	}
	
	
	

	public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            $route = $controller->id . '/' . $action->id;
           // echo $route;
            $publicPages = array(
                'default/login',
                'default/error',
            );
          /*  if (Yii::app()->user->isGuest && !in_array($route, $publicPages)){            
                  $request = Yii::app()->request->getUrl();
        Yii::app()->user->returnURL = $request;
      
        Yii::app()->getModule("{$this->id}")->user->loginRequired();           
            }
            else*/
                return true;
        }
        else
            return false;
    }
	
	
}
