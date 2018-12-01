<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
    public function __construct($application) {
        parent::__construct($application); 
        // make the config available to everyone
        Zend_Registry::set('config', new Zend_Config($this->getOptions()));      
    }

    public function run() {
        
    	$this->view->setEscape('htmlentities');
    	$this->view->addHelperPath('ZendX/JQuery/View/Helper', 'ZendX_JQuery_View_Helper');
    	
    	$this->view->addHelperPath(APPLICATION_PATH . '/views/helpers');
    	
        /*
        $this->view->addHelperPath('App/JQuery/View/Helper', 'App_JQuery_View_Helper');
        $this->view->jQuery()->setVersion('1.3.2');
        $this->view->jQuery()->setUiVersion('1.7.2');
        
        */
        Zend_Session::start();
        
      	parent::run();
    }

    protected function _initAutoload() {
        $loader = new Zend_Application_Module_Autoloader(array(
            'namespace' => '',
            'basePath'  => APPLICATION_PATH)
        );
                
        return $loader;
    }
    
	protected function _initSession()
	{
		$config = Zend_Registry::get('config');
		$default = $config->default->session->name;

		$session = new Zend_Session_Namespace($default, true);

		return $session;
	}
	
}


