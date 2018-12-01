<?php

class Admin_MasterController extends Zend_Controller_Action {
	
	public function init() {
			$this->view->addScriptPath ( APPLICATION_PATH . '/views/partials/' );
	}
	
    public function indexAction() {
		$data = Zend_Paginator::factory (Model_Member::getAll());
		$data->setCurrentPageNumber($this->_getParam('page', 1 ));
		$data->setItemCountPerPage ( 20 );
		$this->view->rows = $data;
    }
    
    public function searchAction() {
    	$uid=$_POST['uid'];
    	$obj=Model_Member::getByEmailId($uid);
    	$this->view->row=$obj;
    }
    // Reset password    
    public function passwordAction() {
    	$id=$this->_getParam ( 'id' );
    	
    	$obj=Model_Member::getUserById($id);
    	$this->view->row=$obj;
    	$fm = new Form_Reset();
    	 
    	if ($this->getRequest ()->isPost ()) {
    		 
    		if ($fm->isValid ( $_POST )) {
    			$pass=$fm->getValue('newpwd1');
    			$obj->password=md5($pass);
    			$obj->save();
    	
    			$this->_redirect ( "/admin/master" );
    		}
    	}
    	$this->view->form=$fm;
    	 
    }
    
    // Set to top for home page
    public function topAction() {
    	$id=$this->_getParam ( 'id' );
    	$obj=Model_Member::getUserById($id);
    	$obj->sqn1=0;
    	$obj->save();
    	$this->_redirect ( "/admin/master" );
    }
    
    // Remove from top in home page for member with photo
    public function untopAction() {
    	$id=$this->_getParam ( 'id' );
    
    	$obj=Model_Member::getUserById($id);
    	$obj->sqn1=99;
    	$obj->save();
    
    	$this->_redirect ( "/admin/master" );
    }
    
    // List for members with photo and sqn1!=99
    public function sqnAction() {
    	$obj=new Model_Member();
    	$data=$obj->getMembersWithPhoto(0);
    	$this->view->rows = $data;
    }
    
    // Re-arrange the order for members with photo and sqn1!=99
    public function orderAction() {
    	$obj=new Model_Member();
    	$rows=$obj->getMembersWithPhoto(0);
    	$this->view->rows = $rows;
    	$fm=new Form_SetOrder();
    	if ($this->getRequest ()->isPost ()) {
    			
    		if ($fm->isValid ( $_POST )) {
    			unset($_POST['submit']);
    			foreach ($_POST as $key=>$sqn) {
    				$obj->setOrder($key,$sqn);
    			}
    			$this->_redirect ( "/admin/master/sqn" );
    		}
    	}
    	$this->view->form=$fm;
    }
    
    public function delAction() {
    	$id=$this->_getParam ( 'id' );
    	
    	$url=ROOT . "/public/upload_img/img/$id";
    	if (is_dir ($url)) {
    		Caclass_Files::rrmdir($url);
    	}
    	if (file_exists("upload_img/ids/$id.jpg")) {
    		unlink("upload_img/ids/$id.jpg");
    	}
    	Model_Member::delUser($id);
    	$this->_redirect ( "/admin/master" );
    	
    }
    
    //Set Subscribe flag 
    public function subscribeAction() {
    	$id = $this->_getParam ( 'id' );
    
    	$row=Model_Member::getUserById($id);
    	$row->paid_flag=1;
    	$row->save();
    	$this->_redirect ( "/admin/master" );
    
    }
    
    //Set Subscribe flag
    public function unsubscribeAction() {
    	$id = $this->_getParam ( 'id' );
    
    	$row=Model_Member::getUserById($id);
    	$row->paid_flag=0;
    	$row->save();
    	$this->_redirect ( "/admin/master" );
    
    }
    
    
    public function previewAction() {
    	$this->_helper->layout->setLayout ( 'default' );
    	$id=$this->_getParam ( 'id' );
    	$this->view->row=Model_Member::getUserById($id);
    	$images=array();
    	if ( is_dir ( ROOT . "/public/upload_img/img/$id" )) {
    		$handle = opendir ( ROOT . "/public/upload_img/img/$id/" );
    		if ($handle) {
    			while ( false !== ($file = readdir ( $handle )) ) {
    				if (preg_match("/(.*)\.(jpg)/",$file)) {
    					$images [] = $file;
    				}
    			}
    			closedir ( $handle );
    		}
    	}
    	sort($images);
    	$this->view->images=$images;
    }
     
}
?>
