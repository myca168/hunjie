<?php
/**
 */
class Plugin_Access extends Zend_Controller_Plugin_Abstract {
	public function preDispatch(Zend_Controller_Request_Abstract $request) {
		
		$controller = $request->getControllerName ();
		
		$privilege = $request->getActionName ();
		
		// skip some controllers (ie. error)
		if ($controller == 'error') {
			return; // do nothing
		}
		
		if ($controller == 'login' || $privilege == 'login') {
			return; // do nothing
		}
		
		$module = $request->getModuleName ();
		$response = $this->getResponse ();
		
		$resourceId = $module . '/' . $controller;
		
		$acl = Caclass_Acl::getInstance (); 

		$auth = Zend_Auth::getInstance ();
		
		// get the ACL resource
		$resource = null;
		
		if ($acl->has ( $resourceId )) {
			$resource = $acl->get ( $resourceId );
		}
		
			$role = Caclass_Acl::ROLE_GUEST;
			if ($resource) {
				if ($auth->hasIdentity ()) {
					$identity = $auth->getIdentity ();
					$role = $identity->role_id;
				}
			}
			try {
				if (! $acl->isAllowed ( $role, $resource, $privilege )) {
					
					if ($auth->hasIdentity ()) {
						throw new Exception ( 'Sorry, the requested resource is unavailable !' );
					} else {
						
						$request->setModuleName ( 'default' );
						$request->setControllerName ( 'index' );
						$request->setActionName ( 'index' );
					}
				}
			}
			 catch ( Exception $thrown ) {
			 	
				$this->forwardException ( $request, $thrown, 'default' );
			}
			
		
		$menus = array(

		  array(
	        	'label'		=> '首页',
		  		'module'	=> 'default',
	        ),
	        
	        array(
	        	'label'		=> '新会员',
	        	'module'	=> 'default',
	        	'controller'=> 'member',
	        	'action'	=> 'index',
	        ),

                		array(
						'label'		=> '高级搜索',
						'module'	=> 'default',
						'controller'=> 'index',
						'action'	=> 'asearch',
				),

				
				array(
						'label'		=> '使用指南',
						'module'	=> 'default',
						'controller'=> 'index',
						'action'	=> 'help',
				),
				
				array(
						'label'		=> '关于我们',
						'module'	=> 'default',
						'controller'=> 'index',
						'action'	=> 'about',
				),
	       
	      );
			
	      $nav = new Zend_Navigation($menus);
	      
	      $arr=array(
			Caclass_Acl::ROLE_BILLING,
			Caclass_Acl::ROLE_MANAGER,
			Caclass_Acl::ROLE_ADMIN
			);
	      
	        if ($role==Caclass_Acl::ROLE_AGENT) {
	        	$apage = new Zend_Navigation_Page_Mvc(
	        			array('label'=>'婚介所会员管理','action' =>'index', 'controller' => 'agent','module'=> 'default')
	        	);
	        	$nav->addPage($apage);
	        	
	        }
			
			if (in_array($role, $arr)){
			$page = new Zend_Navigation_Page_Mvc(
				array('label'=>'Admin','action' =>'index', 'controller' => 'index','module'=> 'admin')
				);
				$nav->addPage($page);
			}
			
		$fc = Zend_Controller_Front::getInstance();
        $bootstrap = $fc->getParam('bootstrap');
        $view = $bootstrap->getResource('view');
        
        $navHelper = $view->getHelper('navigation');
        $navHelper->navigation($nav); 
        $navHelper->setAcl($acl);
        $navHelper->setRole($role);
			
		//	Zend_Registry::set ( 'Zend_Navigation', $nav );
	
	}
	private function forwardException($request, $exception, $module) {
		$error = new ArrayObject ( array (), ArrayObject::ARRAY_AS_PROPS );
		$error->exception = $exception;
		$error->type = 'EXCEPTION_OTHER';
		
		// Keep a copy of the original request
		$error->request = clone $request;
		
		// Forward to the error handler
		$request->setParam ( 'error_handler', $error )->setModuleName ( $module )
		->setControllerName ( 'error' )->setActionName ( 'error' )->setDispatched ( false );
	}
}