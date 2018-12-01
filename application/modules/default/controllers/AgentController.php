<?php

class AgentController extends Zend_Controller_Action {
	public function init() {
		$this->_helper->layout->setLayout ( 'profile' );
		$this->view->addScriptPath ( APPLICATION_PATH . '/views/partials/' );
	}
	
	public function indexAction() {
		$user=Zend_Auth::getInstance()->getIdentity();
		if (!$user) {$this->_redirect ( "/index" ); exit;}
		$this->view->name=$user->name;
	}
	
	//Create a new profile
	public function newAction() {
		$user=Zend_Auth::getInstance()->getIdentity();
		if (!$user) {$this->_redirect ( "/index" ); exit;}
		
		$this->_helper->layout->setLayout ( 'default' );
		
		$userForm = new Form_Member();
		
        if ($this->getRequest()->isPost()) {
        	
            if ($userForm->isValid($_POST)) {
            	

            	try {
            		 
            		$adapter = Zend_Db_Table::getDefaultAdapter ();
            		$adapter->beginTransaction ();
            	
                // create a new page item
              $obj = new Model_Member();
              $email=$userForm->getValue('email');
              $pwd=$userForm->getValue('pwd');
              $agent=$user->id;
              $name=$userForm->getValue('name');
              $lname=$userForm->getValue('lname');
              $birth=$userForm->getValue('dob');
              $sex=$userForm->getValue('sex');
              $tel=$userForm->getValue('tel');
              $city=$userForm->getValue('city');
              $country=$userForm->getValue('live');
              $height=$userForm->getValue('height');
              $weight=$userForm->getValue('weight');
              $ethics=$userForm->getValue('ethic');
              $rel=$userForm->getValue('rel');
              $drink=$userForm->getValue('drink');
              $smoke=$userForm->getValue('smoke');
              $marrige=$userForm->getValue('mar');
              $child=$userForm->getValue('child');
              $job=$userForm->getValue('job');
              $pay=$userForm->getValue('pay');
              $nation=$userForm->getValue('country');
              $edu=$userForm->getValue('edu');
              $english=$userForm->getValue('eng');
              $chinese=$userForm->getValue('chinese');
              $hobby=$userForm->getValue('hobby');
              $animal=$userForm->getValue('sx');
              $star=$userForm->getValue('star');
              $title=$userForm->getValue('title');
              $me=$userForm->getValue('editor');
              $love=$userForm->getValue('obj');
              
     //         $ads=$userForm->getValue('ads');
              
              $row=$obj->createUser(
              		$email, $pwd,$agent,$name,$lname,$birth,$sex,$tel,$city,$country,
              		$height,$weight,$ethics,$rel,$drink,$smoke,$marrige,
              		$child,$job,$pay,$nation,$edu,$english,
              		$chinese,$hobby,$animal,$star,$title,$me,$love);
              
              // create invoice
          /*    
              $inv = new Model_Invoice();
              $invoice=$inv->createAds($row->id,$agent,$ads);
          */    
              $adapter->commit ();
              
              } catch ( Exception $ex ) {
              	
              	$adapter->rollBack ();
              	throw $ex;
              }
              
              $upload = new Zend_File_Transfer_Adapter_Http();
              $upload->addValidator('Count',false, array(1))
              ->addValidator('Extension',false,array('jpg','png','gif','jpeg'))
              ->addValidator(new Zend_Validate_File_ImageSize(array(
              		'minheight' => 150, 'minwidth' => 150,
              		'maxheight' =>300, 'maxwidth' =>300)))
              ->addValidator('Size', false, array('max' =>'300Kb'));
              $upload->setDestination('upload_img/ids/');
              $upload->addFilter('Rename', array('target' =>"$row->id".'.jpg','overwrite' =>true));
              
              if ($upload->isValid()){
              	$upload->receive();
              	$row->img=1;
              	$row->save();
              } else {
              	$userForm->getElement('photo')
              	->addError('【头像最大为300KB，最小尺寸150X150px,最大尺寸300X300px. 仅 jpg,jpeg,png,gif 格式 ! 】');
              }

              $msg="Hi， 您的婚介所已帮您在www.hunjie.ca注册，登录ID是您的邮箱地址，密码是：$pwd\n\n谢谢！"
              ."\n"."\n"."系统管理员"."\n".'www.hunjie.ca';
              $subject='佳丽会员注册通知!';
              $fmEmail='admin@hunjie.ca';
              
              Caclass_Mail::smtp($fmEmail,$email,$subject,$msg);  
              
              $flag=Model_Member::FLAG;   //flag to decide whether is free to agents
              
              if (!$flag) {
                $payArr=array();
              	$payArr['uid']=$row->id;
              	$payArr['inv_id']=$invoice->id;
              	$payArr['email']=$row->email;
              	$payArr['name']=$row->name;
              	$payArr['agent']=$agent;
              	$payArr['tax']=Zend_Registry::get('config')->sales->tax;
              	$payArr['price']=Model_Rate::getById($ads)->price;
              	
              	$payArr['url']='/agent';   //after payment, will return to the section
              		
              	$_SESSION['adsInfo']=$payArr;
              	$this->_redirect ( "/payment/paynow" ); 
            
              } else {
              	$this->_redirect ( "/agent" );
              }
                           
            }
            $userForm->getElement('chkcode')->setValue('');        
        }
        $this->view->form = $userForm;
        
 	}
 	
 	//List all member for an agent
 	public function listAction() {
 		$user=Zend_Auth::getInstance()->getIdentity();
 		if (!$user) {$this->_redirect ( "/index" ); exit;}
 		
 		$data = Zend_Paginator::factory (Model_Member::getUsersByAgent($user->id));
 		$data->setCurrentPageNumber($this->_getParam('page', 1 ));
 		$data->setItemCountPerPage (20);
 		$this->view->rows = $data;
 	}
 	
 	//Edit Member Profile
 	public function editAction() {
 		
 		$this->_helper->layout->setLayout ( 'default' );
 		
 		$id = $this->_getParam ( 'id' );  //for agent or admin to edit member data
 		
 		$uid=Zend_Auth::getInstance()->getIdentity ()->id;
 		$role=Zend_Auth::getInstance()->getIdentity ()->role_id;
 		$arr=array(
 				Caclass_Acl::ROLE_BILLING,
 				Caclass_Acl::ROLE_MANAGER,
 				Caclass_Acl::ROLE_ADMIN,
 		);
 		$chk=false;
 		$agent=false;
 		if (in_array($role, $arr)){
 			$chk=true;
 		}
 		if ($role==Caclass_Acl::ROLE_AGENT) {
 			if (Model_Member::getUserById($id)->agent_id==$uid) {
 				$agent=true;
 			} else {die('非法操作！'); }
 		}
 		
 		if (!($chk||$agent )) {die('test非法操作！');}

         
        $obj=new Model_Member();
        
 		$rd=$obj->getObjById($id);
 		
 		if (!$rd) {$this->_redirect ( "/" );}
 		
 		$userForm = new Form_EditMember();
 		
 		$wt='';
 		if ($rd->weight!=0) {
 			$wt=$rd->weight;
 		}
 		
 		$formArray = array (
 				
 				'name'=>$rd->name,
 				'lname'=>$rd->lname,
 				'dob'=>$rd->birth,
 				'sex'=>$rd->sex,
 				'tel'=>$rd->tel,
 				'city'=>$rd->city,
 				'live'=>$rd->country,
 				'height'=>$rd->height,
 				'weight'=>$wt,
 				'ethic'=>$rd->ethics,
 				'rel'=>$rd->religion,
 				'drink'=>$rd->drink,
 				'smoke'=>$rd->smoke,
 				'mar'=>$rd->marriage,
 				'child'=>$rd->child,
 				'job'=>$rd->job,
 				'pay'=>$rd->pay,
 				'country'=>$rd->nationality,
 				'edu'=>$rd->edu,
 				'eng'=>$rd->english,
 				'chinese'=>$rd->chinese,
 				'hobby'=>$rd->hobby,
 				'sx'=>$rd->animal,
 				'star'=>$rd->star,
 				'title'=>$rd->title,
 				'editor'=>$rd->me,
 				'obj'=>$rd->love
 		);
 	
 		if ($this->getRequest()->isPost()) {
 			 
 			if ($userForm->isValid($_POST)) {
 				 
 				// create a new page item
 				$obj = new Model_Member;
 				$pwd=$userForm->getValue('pwd');
 				$name=$userForm->getValue('name');
 				$lname=$userForm->getValue('lname');
 				$birth=$userForm->getValue('dob');
 				$sex=$userForm->getValue('sex');
 				$tel=$userForm->getValue('tel');
 				$city=$userForm->getValue('city');
 				$live=$userForm->getValue('live');
 				$height=$userForm->getValue('height');
 				$weight=$userForm->getValue('weight');
 				$ethics=$userForm->getValue('ethic');
 				$rel=$userForm->getValue('rel');
 				$drink=$userForm->getValue('drink');
 				$smoke=$userForm->getValue('smoke');
 				$marrige=$userForm->getValue('mar');
 				$child=$userForm->getValue('child');
 				$job=$userForm->getValue('job');
 				$pay=$userForm->getValue('pay');
 				$nation=$userForm->getValue('country');
 				$edu=$userForm->getValue('edu');
 				$english=$userForm->getValue('eng');
 				$chinese=$userForm->getValue('chinese');
 				$hobby=$userForm->getValue('hobby');
 				$animal=$userForm->getValue('sx');
 				$star=$userForm->getValue('star');
 				$title=$userForm->getValue('title');
 				$me=$userForm->getValue('editor');
 				$love=$userForm->getValue('obj');
 	
 				$row=$obj->editUser($id,
 						$name,$lname,$birth,$sex,$tel,$city,$live,
 						$height,$weight,$ethics,$rel,$drink,$smoke,$marrige,
 						$child,$job,$pay,$nation,$edu,$english,
 						$chinese,$hobby,$animal,$star,$title,$me,$love);
 	
 					$this->_redirect ( "/agent/list" );
 				 
 			}
 			$userForm->getElement('chkcode')->setValue('');
 		}
 		$this->view->form = $userForm;
 		
 		$this->view->form->populate ( $formArray );
 		$this->render('new');
 	}
 	

 	//View Page
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
 	
 	//Delete Member
 	public function delAction() {


 		$id=$this->_getParam ( 'id' );

        if (Model_Member::getUserById($id)->agent_id==0 && Model_Member::getUserById($id)->role_id!=Caclass_Acl::ROLE_USER) {
 		die ('Only admin can delete your record! ');	
 		}
 		
 		$uid=Zend_Auth::getInstance()->getIdentity ()->id;
 		$role=Zend_Auth::getInstance()->getIdentity ()->role_id;
 		$arr=array(
 				Caclass_Acl::ROLE_BILLING,
 				Caclass_Acl::ROLE_MANAGER,
 				Caclass_Acl::ROLE_ADMIN,
 		);
 		if (in_array($role, $arr)){
 			$chk=true;
 		}
 		if ($role==Caclass_Acl::ROLE_AGENT) {
 			if (Model_Member::getUserById($id)->agent_id==$uid) {
 				$agent=true;
 			} else {die('非法操作！'); }
 		}
 		
 		if ($chk || $agent) {
 		
 		$url=ROOT . "/public/upload_img/img/$id";
 		if (is_dir ($url)) {
 			Caclass_Files::rrmdir($url);
 		}
 		if (file_exists("upload_img/ids/$id.jpg")) {
 			unlink("upload_img/ids/$id.jpg");
 		}
 		Model_Member::delUser($id);
 		$this->_redirect ( "/agent/list" );
 		} else {die('非法操作！');}

 	}
 	
 	//Ads detail Page for a member
 	public function adsAction() {
 		$id=$this->_getParam ( 'id' );
 		$this->view->user=Model_Member::getUserById($id);
 		$data = Zend_Paginator::factory (Model_Invoice::getMemberAds($id));
 		$data->setCurrentPageNumber($this->_getParam('page', 1 ));
 		$data->setItemCountPerPage (20);
 		$this->view->rows = $data;
 	}
 	
 	//Ads extension Page
 	public function extendAction() {
 		$agentId=Zend_Auth::getInstance()->getIdentity ()->id;
 		$role=Zend_Auth::getInstance()->getIdentity ()->role_id;
 		if ($role!=Caclass_Acl::ROLE_AGENT) {
 			$this->_redirect ( "/" );
 		}
 		
 		$id=$this->_getParam ( 'id' );
 		$this->view->user=Model_Member::getUserById($id);
 		
 		$this->view->rows = Model_Invoice::getMemberAds($id);
 		
 		$fm = new Form_Extend();
 		
 		$this->view->form=$fm;
 		
 		if ($this->getRequest()->isPost()) {
 			 
 			if ($fm->isValid($_POST)) {
 				$ads=$fm->getValue('ads');
 				$obj=Model_Invoice::getUnpaidAds($id);
 				
 				try {
 					 
 					$adapter = Zend_Db_Table::getDefaultAdapter ();
 					$adapter->beginTransaction ();
 					
 					if (count($obj)==0) {
 						
 						$inv = new Model_Invoice();
 						$inv->createAds($id,$agentId,$ads);
 						
 					} else {
 						
 						$data = $obj->toArray();
 						unset($data['id']);
 						$unpaid=new Model_UnpaidInvoice();
 						$row=$unpaid->createRow($data);
 						$row->save();
 						$obj->delete();
 						$inv = new Model_Invoice();
 						$inv->createAds($id,$agentId,$ads);
 					}
 				
 					$adapter->commit ();
 				
 				} catch ( Exception $ex ) {
 					 
 					$adapter->rollBack ();
 					throw $ex;
 				}
 				 
 			}
 			
 			$this->_redirect ( "/agent/list" );
 			
 		}
 		
 	}
 	
	//Thanks Page
	public function thankAction() {
	}
	
}
