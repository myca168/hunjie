<?php

class LoginController extends Zend_Controller_Action {
	
	public function loginAction() {
		
		if ($this->_request->isXmlHttpRequest ()) {
		//	$this->_helper->viewRenderer->setNoRender ();
		//	$this->_helper->getHelper ( 'layout' )->disableLayout ();
			
			$filters = array ('*' => 'StringTrim' );
			$validators = array ('*' => 'NotEmpty', 'password' => 
			array (array ('StringLength', 'min' => 1, 'max' => 30 ), Zend_Filter_Input::PRESENCE => 'required' ) );
			
			$input = new Zend_Filter_Input ( $filters, $validators, $this->_request->getParams () );
			
			if ($input->hasMissing () || $input->hasInvalid ()) {
			
				$this->_helper->json ( array ('flag' => 'no', 'message' => 'Incorrect login data !' ) );
			} else {
				$login = strtolower($input->login);
				//set up the auth adapter
				// get the default db adapter
				$db = Zend_Db_Table::getDefaultAdapter ();
				//create the auth adapter
				//$authAdapter = new Zend_Auth_Adapter_DbTable ( $db, 'users', 'nickname','password');
				$authAdapter = new Zend_Auth_Adapter_DbTable ( $db, 'member', 'email','password','MD5(?) AND status = "Active"');
				//set the username and password
				$authAdapter->setIdentity ($login);
				$authAdapter->setCredential ($input->password);
				//authenticate
				$result = $authAdapter->authenticate ();
				if ($result->isValid ()) {
					$row=new Model_Member();
					$row->newVisit($login);
					// store the username, first and last names of the user
					$auth = Zend_Auth::getInstance ();
					$storage = $auth->getStorage ();
					$storage->write ( $authAdapter->getResultRowObject ( array ('id', 'email','name', 'role_id' ) ) );
					$this->_helper->json ( array ('flag' => 'yes') );
						
				} else {
					$this->_helper->json ( array ('flag' => 'no', 'message' => 'User not found !' ) );
				}
			}
			// echo Zend_Json::encode($json);
		} else {
			$this->_redirect ( '/' );
		}
	}
	
	public function logoutAction() {
		Zend_Auth::getInstance ()->clearIdentity ();
		$this->_redirect ( '/' );
	}
}
