<?php

class ProfileController extends Zend_Controller_Action {

	public function init() {
		$this->_helper->layout->setLayout('profile');
                $this->view->addScriptPath ( APPLICATION_PATH . '/views/partials/' );
	}
	
	public function indexAction() {
		$user=Zend_Auth::getInstance()->getIdentity();
		if (!$user) {$this->_redirect ( "/index" ); exit;}
		$this->view->name=$user->name;
	}

        	//Personal messages
	public function messageAction() {
		if (Zend_Auth::getInstance()->hasIdentity ()) {
			$id = Zend_Auth::getInstance ()->getIdentity ()->id;
		} else {$this->_redirect ( "/" );}
		$row=Model_Message::getRows($id);
		$data = Zend_Paginator::factory(Model_Message::getRows($id));
		$data->setCurrentPageNumber($this->_getParam('page', 1 ));
		$data->setItemCountPerPage ( 10 );
		
		$this->view->rows = $data;
	}
	
	//View Personal messages
	public function messageviewAction() {
		$id= $this->_getParam ( 'id' );
		$obj=Model_Message::getObj($id);
		$obj->flag=1;
		$obj->save();
		
		$this->view->msg = $obj;
		
	}
	
	//Delete Personal messages
	public function messagedelAction() {
		$mid= $this->_getParam ( 'id' );
		if (Zend_Auth::getInstance()->hasIdentity ()) {
			$id = Zend_Auth::getInstance ()->getIdentity ()->id;
		}
		
		$obj=Model_Message::getObj($mid);
		
		if ($obj->rid!=$id) {
			die('You are not allowed to delete it!'); 
		} else {$obj->delete();}
		
		$this->_redirect ( "/profile/message" );
	}
	



	/*
	//Create a new profile
	public function newAction() {
		
		$userForm = new Form_Registration();
		
        if ($this->getRequest()->isPost()) {
        	
            if ($userForm->isValid($_POST)) {
            	
                // create a new page item
              $profile = new Model_User();
              $login=strtolower($userForm->getValue('nname'));
              $email=$userForm->getValue('uid');
              $password=$userForm->getValue('pwd1');
              $profile->createLogin($login,$email,$password);
              	
              	//set email 
              	$domain=Model_Site::getRow(Model_Site::SITE_DOMAIN);
              	$site=$domain->detail;
              	
              
              	$context="Please use the following link to activate your new account :"."\n"."http://".$site.
              	'/profile/activate/id/'.$login."\n\n"."Thanks!";
    

 	        $email_from="webmaster@$site";
              
              	ini_set("sendmail_from", $email_from);

		$headers = "From: $email_from";
				
		$subject="Link to activate your new account from $site";

                $message=$context;

               // $mail=new Caclass_Mail(); 

		Caclass_Mail::smtp($email, $subject, $message, $headers);

               

	 $email_from=Model_Site::getRow(Model_Site::SITE_WEBMASTER)->detail;
         $subject="Hi $login, 您的新账户已创建 !";
         $msg="
请复制下面的激活链接到浏览器进行访问，以便激活您的账户。激活链接:"."\n"."http://".$site.'/profile/activate/id/'.$login."\n\n"."谢谢!";
              	
              	Caclass_Mail::smtp($email_from,$email,$subject,$msg);

             	
                $this->_redirect( "/profile/welcome/id/$login" );
            }
            $userForm->getElement('chkcode')->setValue('');        
        }
        $this->view->form = $userForm;
       
	}
	*/
	/*
	//activate account
	public function activateAction() {
			$login = $this->_getParam ( 'id' );
            $row =Model_User::getObj($login );
            $row->status=Model_User::STATUS_ACTIVE;
            $row->save();
            $this->_redirect ( "/profile/welcome/flag/activate/id/$login" );
	}
	*/
	
	//Welcome Page
	public function welcomeAction() {
		$id= $this->_getParam ( 'id' );
	//	die($login);
		$row=Model_Member::getUserByEmail($id);
		if ($row) {$name=$row->name;}else {$name='';}
		$flag= $this->_getParam ( 'flag' );
		if ($flag=='activate') {
			$this->view->msg="
			<br/>您好 $name :<br/><br/>
			您的新账户已激活. <br/><br/> 
			谢谢!<br/><br/>系统管理员";
		}else if ($flag=='recovery') {
		$this->view->msg="
		<br/>Hi $name :<br/><br/>
		密码已经重设并用电邮通知您， 请查看您的邮件。 如果没找到，请查看垃圾文件夹是否被过滤掉，若无法收到邮件，请与我们联系。  
		 <br/><br/> 
		谢谢!<br/><br/>系统管理员";
		} else {
		$this->view->msg="
		<br/>您好 $name  :<br/><br/>
		本站已发送一封电邮给您， 请用电邮中的链接激活您的账户. 
		如果没收到，请查看垃圾文件夹看看是否被过滤掉，若还是没有，请与我们联系。 <br/><br/> 
		谢谢!<br/><br/>系统管理员";
		
		}
	}
	
	//add my photo
	public function photoAction() {
		$user=Zend_Auth::getInstance()->getIdentity();
		if (!$user) {$this->_redirect ( "/" ); exit;}
		$this->view->id=$user->id;
		$userForm = new Form_Photo();
		
		if ($this->getRequest()->isPost()) {
 			
 			
			$upload = new Zend_File_Transfer_Adapter_Http(); 
			$upload->addValidator('Count',false, array(1)) 
       		->addValidator('Extension',false,array('jpg','png','gif','jpeg')) 
       		->addValidator('Size', false, array('max' =>'300Kb'));
    		$upload->setDestination('upload_img/ids/');
       	    $upload->addFilter('Rename', array('target' =>"$user->id".'.jpg','overwrite' =>true));
 			
			 if ($upload->isValid()){
			 	$upload->receive();
			 	$row=Model_Member::getUserById($user->id);
			 	$row->img=1;
			 	$row->save();
			 } else { 
			 $userForm->getElement('photo')->addError('文件最大为300KB. 仅 jpg,jpeg,png,gif 格式 !');
          	}
        }
        if (file_exists("upload_img/ids/$user->id.jpg")) {$this->view->flag="True";}
 		$this->view->form = $userForm;
	}
	
	//Change password
	public function passwordAction() {
		$user=Zend_Auth::getInstance()->getIdentity();
		if (!$user) {$this->_redirect ( "/" ); exit;}
		$this->view->email=$user->email;
		$userForm = new Form_Password();
		if ($this->getRequest()->isPost()) {
        	
            if ($userForm->isValid($_POST)) {
            	$profile = new Model_Member();
                $profile->updatePassword($user->id,
                					$userForm->getValue('newpwd2')
                					);
            $this->_redirect ( "/profile/index" );
            }
		 }
		$this->view->form = $userForm;
	}
	
	//Password recovery
	public function recoveryAction() {
		$this->_helper->layout->setLayout('default');
		$fm = new Form_Recovery();
		if ($this->getRequest()->isPost()) {
        	
            if ($fm->isValid($_POST)) {
            	$user=new Model_Member();
            	$row=$user->resetPassword($fm->getValue('email'));
             $this->_redirect ( "/profile/welcome/flag/recovery/id/{$row->email}" );	
            }
		 }
		$this->view->form = $fm;
	}
	
	//Upload pictures
	public function uploadAction() {
		$user=Zend_Auth::getInstance()->getIdentity();
		if (!$user) {$this->_redirect ( "/" ); exit;}
		$this->view->id=$user->id;
		$dir=$user->id;
		$userForm = new Form_Image();
		
		$images=array();
		
		if (! is_dir ( ROOT . "/public/upload_img/img/$dir" )) {
			@mkdir ( ROOT . "/public/upload_img/img/$dir" );
		}
			
		$handle = opendir ( ROOT . "/public/upload_img/img/$dir" );
		if ($handle) {
			while ( false !== ($file = readdir ( $handle )) ) {
				if (preg_match("/(.*)\.(jpg)/",$file)) {
					$images [] = $file;
				}
			}
			closedir ( $handle );
		}
		
		if ($this->getRequest()->isPost()) {
			
			if (count($images)<5) { 
				
			$id = uniqid ();
		
			$upload = new Zend_File_Transfer_Adapter_Http();
			$upload->addValidator('Count',false, array(1))
			->addValidator('Extension',false,array('jpg','png','gif','jpeg'))
			->addValidator('Size', false, array('max' =>'2Mb'));
			$upload->setDestination("upload_img/img/$dir/");
			$upload->addFilter('Rename', array('target' =>"$id".'.jpg','overwrite' =>true));
		
			if ($upload->isValid()){
				$upload->receive();
			} else {
				$userForm->getElement('photo')->addError('文件最大为2Mb. 仅 jpg,jpeg,png,gif 格式 !');
			}
			$this->_redirect ( "/profile/upload" );
			} else {$this->view->msg="You already uploaded 5 photos!";}
		}
		$this->view->form = $userForm;
		sort($images);
		$this->view->images = $images;
		
	}
	
	//Remove image file
	public function rmfileAction() {
		$file=$this->_getParam ( 'id' );
		$dir=$this->_getParam ( 'dir' );
			
		if (file_exists("upload_img/img/$dir/$file.jpg")){
			unlink("upload_img/img/$dir/$file.jpg");
		}
		$this->_redirect ( "/profile/upload" );
	}
	
	//Delete Member
	public function removeAction() {
		
		$id=Zend_Auth::getInstance()->getIdentity ()->id;

                $role=Zend_Auth::getInstance()->getIdentity ()->role_id;
		$arr=array(
				Caclass_Acl::ROLE_BILLING,
				Caclass_Acl::ROLE_MANAGER,
				Caclass_Acl::ROLE_ADMIN,
				Caclass_Acl::ROLE_AGENT
		);
		
		if (in_array($role, $arr)){
			die('Only Admin can delete your record !');
		}
		
		if ($this->getRequest ()->isPost ()) {
				
			if ($_POST['del']!=1) {
				$this->_redirect ( "/profile" );
			}
			
		$url=ROOT . "/public/upload_img/img/$id";
		if (is_dir ($url)) {
			Caclass_Files::rrmdir($url);
		}
		if (file_exists("upload_img/ids/$id.jpg")) {
			unlink("upload_img/ids/$id.jpg");
		}
		Model_Member::delUser($id);
		$this->_redirect ( "/login/logout" );
	}
	}

        	//Ads extension Page
	public function extendAction() {
			$uid=Zend_Auth::getInstance()->getIdentity ()->id;
		
			$agentId=0;
		
			$this->view->user=Model_Member::getUserById($uid);
				
			$this->view->rows = Model_Invoice::getMemberAds($uid);
				
			$fm = new Form_Extend();
				
			$this->view->form=$fm;
			
			if ($this->getRequest()->isPost()) {
				 
				if ($fm->isValid($_POST)) {
					$ads=$fm->getValue('ads');
					$lastPaid=Model_Invoice::getLastPaidAds($uid);
			
					try {
							
						$adapter = Zend_Db_Table::getDefaultAdapter ();
						$adapter->beginTransaction ();
			
						$where = array();
						$where[] = $adapter->quoteInto('uid = ?', $uid);
						$where[] = $adapter->quoteInto('paid_flag = ?', 0);
			
						$adapter->delete('invoice', $where);
			
						if (!$lastPaid) {
			
							$inv = new Model_Invoice();
							$inv->createAds($uid,$agentId,$ads);
			
						} else {
							$start_date=$lastPaid->end_date;
							$inv = new Model_Invoice();
							$inv->extendAds($uid,$agentId,$ads,$start_date);
						}
							
						$adapter->commit ();
							
					} catch ( Exception $ex ) {
							
						$adapter->rollBack ();
						throw $ex;
					}
			
				}
			
				$this->_redirect ( "/profile/thank" );
			
			}

	}
 
	
	//Thanks Page
	public function thankAction() {
	}
	
}
