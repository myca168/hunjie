<?php

class Admin_AgentController extends Zend_Controller_Action {
	
	public function init() {
			$this->view->addScriptPath ( APPLICATION_PATH . '/views/partials/' );
	}
	
    public function indexAction() {
		$data = Zend_Paginator::factory (Model_Member::getAgentsOnly());
		$data->setCurrentPageNumber($this->_getParam('page', 1 ));
		$data->setItemCountPerPage ( 10 );
		$this->view->rows = $data;
    }
    //Get member by agent ID    
    public function memberAction() {
    	$agent=$this->_getParam ( 'id' );
    	$data = Zend_Paginator::factory (Model_Member::getUsersByAgent($agent));
    	$data->setCurrentPageNumber($this->_getParam('page', 1 ));
    	$data->setItemCountPerPage ( 10 );
    	$this->view->rows = $data;
    }
    
    //Delete an agent and all its members
    public function deleteAction() {
    	$agent=$this->_getParam ( 'id' );
    	$agentObj=Model_Member::getUserById($agent);
    	$members=Model_Member::getUsersByAgent($agent);
    	
    	try {
    		 
    		$adapter = Zend_Db_Table::getDefaultAdapter ();
    		$adapter->beginTransaction ();
    		
            $where1=$adapter->quoteInto('agent_id = ?', $agent);
            $adapter->delete('member', $where1);
            $agentObj->delete();
    		
    		$adapter->commit ();
    	
    	} catch ( Exception $ex ) {
    		 
    		$adapter->rollBack ();
    		throw $ex;
    	}
    	
    	foreach ($members as $mem) {
    	$mid=$mem->id;	
    	$url=ROOT . "/public/upload_img/img/$mid";
    	if (is_dir ($url)) {
    		Caclass_Files::rrmdir($url);
    	}
    	if (file_exists("upload_img/ids/$mid.jpg")) {
    		unlink("upload_img/ids/$mid.jpg");
    	}
    	}
    	$this->_redirect ( "/admin/agent" );
    	
    }
    
    //**Set role and status fo a member **/
    public function roleAction() {
    	$id=$this->_getParam ( 'id' );
    	$obj=Model_Member::getUserById($id);
    	$this->view->row=$obj;
    	$fm = new Form_Permission();
    	
    	if ($this->getRequest ()->isPost ()) {
    			
    		if ($fm->isValid ( $_POST )) {
    			$status=$fm->getValue('status');
    			$role_id=$fm->getValue('role_id');
    			$obj->status=$status;
    			$obj->role_id=$role_id;
    			$obj->save();
    				
    			$this->_redirect ( "/admin/agent" );
    		}
    	}
    	$this->view->form=$fm;
    }
    
    public function searchAction() {
    $uid=$_POST['uid'];
    $obj=Model_Member::getByEmailId($uid);
    if ($obj) {
    	if ($obj->role_id!=Caclass_Acl::ROLE_AGENT) {
    		$obj='';
    	}
    	
    }
    $this->view->row=$obj;
    }  
     
    
}
?>
