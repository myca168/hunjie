<?php
/**

*/
class App_Controller_Action extends Zend_Controller_Action {

	protected function getUserId()
	{
		// get the user-id from the session
		$bootstrap = $this->getInvokeArg('bootstrap');
		$session = $bootstrap->getResource('session');
		$storage = new App_Auth_Storage_Session($session);
		return $storage->getUserId();
	}

	protected function getUserRole()
	{
		// get the user-id from the session
		$bootstrap = $this->getInvokeArg('bootstrap');
		$session = $bootstrap->getResource('session');
		$storage = new App_Auth_Storage_Session($session);
		return $storage->getUserRole();
	}

	protected function sendJsonResponse($results)
	{
		$response = $this->getResponse();

		// send back a JSON response
		$response->clearAllHeaders();
		$response->clearBody();
		$response->setHeader('Content-Type', 'application/json');
		$response->setBody(Zend_Json::encode($results));
	}

	protected function getSession()
	{
		$bootstrap = $this->getInvokeArg('bootstrap');
		return $bootstrap->getResource('session');
	}

}
