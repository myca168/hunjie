<?php

class EventController extends Zend_Controller_Action {
	
	public function init() {
		$this->view->addScriptPath ( APPLICATION_PATH . '/views/partials/' );
	}
	
	public function indexAction() {
	//	$row=Model_Site::getRow(Model_Site::SITE_WEBMASTER);
	//	die($row->detail);
		$data = Zend_Paginator::factory(Model_Event::getAll());
 		$data->setCurrentPageNumber($this->_getParam('page', 1 ));
 		$data->setItemCountPerPage ( 30 );
 		$this->view->rows=$data;
 	}
	public function addAction() {
		$this->view->headScript ()->appendFile ( '/editor/tiny_mce/tiny_mce.js', 'text/javascript' );
		$this->view->headScript ()->appendFile ( '/editor/tiny_mce/user_tiny_mce-init.js', 'text/javascript' );
		
		$fm = new Form_Event ( );
		
		$formArray=array();
		$this->view->imgs = array ();
		if (Zend_Auth::getInstance()->hasIdentity ()) {
		$loginid = Zend_Auth::getInstance ()->getIdentity ()->id;
		} else {$this->_redirect ( "/" );}
		
		$dirModel=Model_Event::getDir($loginid);
			if (count($dirModel)>0) {
			$dir=$dirModel->dir+1;
		} else {$dir=1;}
		
		$this->view->dir=$dir;
		
		$images = array ();
		
		if ($this->getRequest ()->isPost ()) {
			
			$formData = $this->_request->getPost();
				
				if ( is_dir ( ROOT . "/public/upload_img/events/$loginid/$dir" )) {
					$handle = opendir ( ROOT . "/public/upload_img/events/$loginid/$dir/" );
					if ($handle) {
					while ( false !== ($file = readdir ( $handle )) ) {
					//	if (ereg ( "(.*)\.(jpg)", $file )) {
						if (preg_match("/(.*)\.(jpg)/",$file)) {	
						$images [] = $file;
						}
					}
						closedir ( $handle );
					}
				}
			
			if (isset ( $_POST ['upload'] )){
				
				if (! is_dir ( ROOT . "/public/upload_img/events/$loginid" )) {
				@mkdir ( ROOT . "/public/upload_img/events/$loginid" );
				}
				
				if (! is_dir ( ROOT . "/public/upload_img/events/$loginid/$dir" )) {
				@mkdir ( ROOT . "/public/upload_img/events/$loginid/$dir" );
				}
				
				if (count($images) < 5) {
				$adapter = new Zend_File_Transfer_Adapter_Http ( );
				$adapter->addValidator ( 'Extension', false, 'jpg,png,gif,jpeg' );
				$adapter->addValidator ( 'Size', false, array ('max' => '3Mb' ) );
				
				if ($adapter->isValid ()) {
					
						$id = uniqid ();
						$adapter->addFilter ( 'Rename', array ('target' => "$id.jpg", 'overwrite' => true ) );
						$adapter->setDestination ( "upload_img/events/$loginid/$dir" );
						$adapter->receive ();
						$images[]=$id.'.jpg';
					} else {$fm->getElement('image')->addError('Max size is 300KB for each image. Only jpg,jpeg,png and gif files !');}
				}
			} else  
			
			if (isset($_POST['submit'])) {
				
				if ($fm->isValid ( $formData )) {
					
						$eModel=new Model_Event();
						$row=$eModel->addRecord(
								$loginid,
								$dir,
								$fm->getValue ('city'),
								trim($fm->getValue ('title')),
								trim($fm->getValue ('address')),
								trim($fm->getValue ('contact')),
								$fm->getValue ('phone'),
								$fm->getValue ('email'), 
								$fm->getValue ('start'),
								$fm->getValue ('end'),
								$fm->getValue ('time1'),
								$fm->getValue ('time2'),
								$fm->getValue ('m1'),
								$fm->getValue ('m2'),
								trim($fm->getValue ('editor1')),
								$_SERVER['REMOTE_ADDR']
								);
								
								$this->_redirect ( "/event/admin" );
					} 
			}
			$formData['chkcode']='';
			$formArray=$formData;
		}
		$this->view->form=$fm;
		sort($images);
		$this->view->imgs = $images;
		$this->view->form->populate ( $formArray );
		$this->view->login=$loginid;
	}
	
	public function editAction() {
		
		$id = $this->_getParam ( 'id' );
		if (! $id) {
			throw new Exception ( "ID must be provided !" );
		}
		
		$this->view->headScript ()->appendFile ( '/editor/tiny_mce/tiny_mce.js', 'text/javascript' );
		$this->view->headScript ()->appendFile ( '/editor/tiny_mce/user_tiny_mce-init.js', 'text/javascript' );
		
		$Model=new Model_Event();
		$ads=$Model->getModel($id);
                $ownerId=$ads->login;
		
		if (Zend_Auth::getInstance()->hasIdentity ()) {
			$loginid = Zend_Auth::getInstance ()->getIdentity ()->id;
			$role=Zend_Auth::getInstance()->getIdentity ()->role_id;
		} else {$this->_redirect ( "/" );}
	
		$arr=array(
				Caclass_Acl::ROLE_SALE,
				Caclass_Acl::ROLE_MANAGER,
				Caclass_Acl::ROLE_ADMIN,
				Caclass_Acl::ROLE_SUPERADMIN,
				Caclass_Acl::ROLE_IT
				);
		if (!in_array($role, $arr) && $loginid !=$ads->login ){
			throw new Exception ( "You do not have privileges to access! " );
		}
		
		$dir=$ads->dir;
		
		$fm = new Form_Event ( );
		
		$formArray = array (
			'city' => $ads->city,
			'title' => $ads->title, 
			'address' => $ads->address,
			'contact' => $ads->contact,
			'phone' => $ads->phone,
			'email' => $ads->email,
			'start' => date('Y-m-d',strtotime($ads->start_date)),	
			'end' => date('Y-m-d',strtotime($ads->end_date)),
			'time1' => $ads->time1,
			'time2' => $ads->time2,
			'm1' => $ads->min1,
			'm2' => $ads->min2,		
			'editor1' => $ads->details
		);
		
		$images = array ();
		
		if ( is_dir ( ROOT . "/public/upload_img/events/$ownerId/$dir" )) {
					$handle = opendir ( ROOT . "/public/upload_img/events/$ownerId/$dir/" );
					if ($handle) {
					while ( false !== ($file = readdir ( $handle )) ) {
					//	if (ereg ( "(.*)\.(jpg)", $file )) {
						if (preg_match("/(.*)\.(jpg)/",$file)) {	
						$images [] = $file;
						}
					}
						closedir ( $handle );
					}
		}
		
		if ($this->getRequest ()->isPost ()) {
			$formData = $this->_request->getPost();
			if (isset ( $_POST ['upload'] )){
				
				if (! is_dir ( ROOT . "/public/upload_img/events/$ownerId" )) {
				@mkdir ( ROOT . "/public/upload_img/events/$ownerId" );
				}
				
				if (! is_dir ( ROOT . "/public/upload_img/events/$ownerId/$dir" )) {
				@mkdir ( ROOT . "/public/upload_img/events/$ownerId/$dir" );
				}
				
				if (count($images) < 5) {
				$adapter = new Zend_File_Transfer_Adapter_Http ( );
				$adapter->addValidator ( 'Extension', false, 'jpg,png,gif,jpeg' );
				$adapter->addValidator ( 'Size', false, array ('max' => '3Mb' ) );
				
				if ($adapter->isValid ()) {
					
						$id = uniqid ();
						$adapter->addFilter ( 'Rename', array ('target' => "$id.jpg", 'overwrite' => true ) );
						$adapter->setDestination ( "upload_img/events/$ownerId/$dir" );
						$adapter->receive ();
						$images[]=$id.'.jpg';
					}
				}
			} 
			
			else if (isset($_POST['submit'])) {
				if ($fm->isValid ($formData)) {
					
							$Model->updateRecord(
								$id,
								$fm->getValue ('city'),
								trim($fm->getValue ('title')),
								trim($fm->getValue ('address')),
								trim($fm->getValue ('contact')),
								$fm->getValue ('phone'),
								$fm->getValue ('email'), 
								$fm->getValue ('start'),
								$fm->getValue ('end'),
								$fm->getValue ('time1'),
								$fm->getValue ('time2'),
								$fm->getValue ('m1'),
								$fm->getValue ('m2'),
								trim($fm->getValue ('editor1')),
								$_SERVER['REMOTE_ADDR']
								);
					$this->_redirect ( "/event/admin" );
				}
			}
			$formData['chkcode']='';	
			$formArray=$formData;
		}
		$this->view->form=$fm;
		sort($images);
		$this->view->imgs = $images;
		$this->view->form->populate ( $formArray );
		$this->view->login=$ownerId;
		$this->view->dir=$dir;
		$this->render('add');
	}
	
	public function adminAction() {
	 if (!Zend_Auth::getInstance()->hasIdentity ()) {
		throw new Exception ( "You are not allowed to access the admin section !" );
	 }
	 $id=Zend_Auth::getInstance()->getIdentity ()->id;
	 $this->view->rows=Model_Event::getUserEvents($id);
	}
	
	public function viewAction() {
		
		$id = $this->_getParam ( 'id' );
		if (! $id) {
			throw new Exception ( "ID must be provided !" );
		}
		$item=Model_Event::getRowById($id);
		
		$this->view->item=$item;
		$dir=$item->dir;
		$login=$item->login;
		
		$this->view->dir=$dir;
		$this->view->login=$login;
			$images=array();
			if ( is_dir ( ROOT . "/public/upload_img/events/$login/$dir" )) {
					$handle = opendir ( ROOT . "/public/upload_img/events/$login/$dir/" );
					if ($handle) {
					while ( false !== ($file = readdir ( $handle )) ) {
					//	if (ereg ( "(.*)\.(jpg)", $file )) {
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
	
	public function removeAction() {
		
		$id = $this->_getParam ( 'id' );
		if (! $id) {
			throw new Exception ( "ID must be provided !" );
		}
		
		$item=Model_Event::getRowById($id);
		$dir=$item->dir;
                $login=$item->login;
		
		if (Zend_Auth::getInstance()->hasIdentity ()) {
			$loginid = Zend_Auth::getInstance ()->getIdentity ()->id;
			$role=Zend_Auth::getInstance()->getIdentity ()->role_id;
		} else {$this->_redirect ( "/" );}
	
		$arr=array(
				Caclass_Acl::ROLE_SALE,
				Caclass_Acl::ROLE_MANAGER,
				Caclass_Acl::ROLE_ADMIN,
				Caclass_Acl::ROLE_SUPERADMIN,
				Caclass_Acl::ROLE_IT
				);
		if (!in_array($role, $arr) && $loginid !=$item->login ){
			throw new Exception ( "You do not have privileges to access! " );
		}
			$url=ROOT . "/public/upload_img/events/$login/$dir";
			Caclass_Files::rrmdir($url);
		$item->delete();
		$this->_redirect ( "/event/admin" );
			
	}
	
	//Remove Image 	
	public function delimgAction() {
		$id = $this->_getParam ( 'fileid' );
		$dir = $this->_getParam ( 'dir' );
                $login = $this->_getParam ( 'login' );
		if ($id == '' || $dir=='' || $login=='') {
			exit ();
		}
		
		if (Zend_Auth::getInstance()->hasIdentity ()) {
		$loginid = Zend_Auth::getInstance ()->getIdentity ()->id;
		} else {$this->_redirect ( "/" );}
		
		if (file_exists("upload_img/events/$login/$dir/$id.jpg")) {
			unlink("upload_img/events/$login/$dir/$id.jpg");
			$this->_helper->json ( array ('flag' => 'yes') );
		} else {$this->_helper->json ( array ('flag' => 'no')); }
		
	}
	
}