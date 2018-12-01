<?php
/**

*/
class Plugin_Module extends Zend_Controller_Plugin_Abstract
{
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		$auth=Zend_Auth::getInstance();
		$view=Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('view');
		$view->loginfm=new Form_Login();
		$logoutUrl=$view->baseUrl().'/login/logout';
		if ($auth->hasIdentity ()){
        	$id=$auth->getIdentity ();
        	$view->loginfm="&nbsp;&nbsp;&nbsp; 欢迎 $id->name ! &nbsp;&nbsp;
        	<a href='/profile/index'>会员中心</a>&nbsp;&nbsp;<a href='$logoutUrl'>退出</a>";
    	}
		
		$module = $request->getModuleName();
		$controller = $request->getControllerName();
		$action = $request->getActionName();

		$front_controller = Zend_Controller_Front::getInstance();
		$error_handler = $front_controller->getPlugin('Zend_Controller_Plugin_ErrorHandler');
		$error_handler->setErrorHandlerModule($module);
		// check the module and automatically set the layout
		$layout = Zend_Layout::getMvcInstance();

		switch ($module) {
			
			case 'admin':
				$layout->setLayout('admin');
				break;
			
			default:
				$layout->setLayout('default');
				break;
		}
	}

}