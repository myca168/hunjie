<?php

class MemberController extends Zend_Controller_Action {
	
	public function init() {
		$this->view->addScriptPath ( APPLICATION_PATH . '/views/partials/' );
		$ajaxContext = $this->_helper->getHelper('AjaxContext');
		$ajaxContext->addActionContext('msg', 'json')
		->initContext();
	}
	
	public function indexAction() {
	}
	
	//Create a new profile
	public function newAction() {
		$user=Zend_Auth::getInstance()->getIdentity();
		$agent=0;
		if ($user) {
		if ($user->role_id==Caclass_Acl::ROLE_AGENT) {
			$this->_redirect ( "/agent" );
		}
		}
		$userForm = new Form_Member();
		
        if ($this->getRequest()->isPost()) {
        	
            if ($userForm->isValid($_POST)) {
            	
            	
            	try {
            			
            		$adapter = Zend_Db_Table::getDefaultAdapter ();
            		$adapter->beginTransaction ();
            		
            		// create a new member
            		$obj = new Model_Member();
            		$email=$userForm->getValue('email');
            		$pwd=$userForm->getValue('pwd');
            		//  $agent=0;
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
            		
          //  		$ads=$userForm->getValue('ads');
            		
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
              
              $domain=Model_Site::getRow(Model_Site::SITE_DOMAIN);
              $site=$domain->detail;
              
              $subject="佳丽婚介网 $site 账户激活链接!";
              $fmEmail='admin@hunjie.ca';
              $msg="请使用以下链接激活您的账户或将该链接复制到浏览器,再激活："."\n"."http://".$site.
              '/member/activate/id/'.$email."\n\n"."谢谢!";
               
              Caclass_Mail::smtp($fmEmail,$email,$subject,$msg);
              
              
              $flag=false;   //flag to decide whether is free for members or not
              
              if ($flag) {
              	$payArr=array();
              	$payArr['uid']=$row->id;
              	$payArr['inv_id']=$invoice->id;
              	$payArr['email']=$row->email;
              	$payArr['name']=$row->name;
              	$payArr['agent']=0;
              	$payArr['tax']=Zend_Registry::get('config')->sales->tax;
              	$payArr['price']=Model_Rate::getById($ads)->price;
              	$payArr['url']='/member/admin';   //after payment, will return to the admin section
              		
             	$_SESSION['adsInfo']=$payArr;

             //   setcookie('payer', serialize($payArr), time()+7200,'/');

              	$this->_redirect ( "/payment/paynow" );
              
              } else {
              	$this->_redirect ( "/member/thank" );
              }
                           
            }
            $userForm->getElement('chkcode')->setValue('');        
        }
        $this->view->form = $userForm;
        
 	}
 	
 	//Edit Member Profile
 	public function editAction() {
 		
 		$user=Zend_Auth::getInstance()->getIdentity();
 		if (!$user) {$this->_redirect ( "/" );}
 		/*
 		if ($user) {
 			if ($user->role_id==Caclass_Acl::ROLE_AGENT) {
 				$this->_redirect ( "/agent" );
 			}
 		}
 		*/
 		$id = $this->_getParam ( 'id' );  //for agent or admin to edit member data
        if (is_null($id)) {
        $id=$user->id;        	
        }
         
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
 	
 					$this->_redirect ( "/profile" );
 				 
 			}
 			$userForm->getElement('chkcode')->setValue('');
 		}
 		$this->view->form = $userForm;
 		
 		$this->view->form->populate ( $formArray );
 		$this->render('new');
 	}
 	
 	public function msgAction() {
 		if (Zend_Auth::getInstance()->hasIdentity ()) {
 			$loginid = Zend_Auth::getInstance ()->getIdentity ()->id;
 		} else {$this->_redirect ( "/" );}
 		
 		
 		$this->_helper->viewRenderer->setNoRender ();
 		$this->_helper->getHelper ( 'layout' )->disableLayout ();
 			
 		$id = $this->_getParam ( 'id' );		
 		if (! $id) {
 			throw new Exception ( "ID must be provided !" );
 		}
 			
 		$fm = new Form_Reply( );
 			
 		if ($this->getRequest ()->isPost ()) {
 			$formData = $this->_request->getPost();
 				
 			if ($fm->isValid ($formData)) {
 				$title=$fm->getValue ('mtitle');
 				$content=$fm->getValue ('comment');
 	
 				try {
 					$adapter = Zend_Db_Table::getDefaultAdapter ();
 					$adapter->beginTransaction ();
 					$to=Model_Msg::getObj($id);
 					
 					if ($to) {
 						$to->msgin=$to->msgin+1;
 						$to->save();
 					} else {
 						$uid=$id;
 						$msgin=1;
 						$msgout=0;
 						$newObj=new Model_Msg();
 						$newObj->addRd($uid,$msgin,$msgout);
 					}
 	
 					$from=Model_Msg::getObj($loginid);
 					if ($from) {
 						$uid=$loginid;
 						$from->msgout=$from->msgout+1;
 						$new=new Model_Msg();
 						$new->updateRd($from->id,$uid,$from->msgin,$from->msgout);
 					} else {
 						$uid=$loginid;
 						$msgin=0;
 						$msgout=1;
 						$new=new Model_Msg();
 						$new->addRd($uid,$msgin,$msgout);
 					}
                                        $message=new Model_Message();
 					$message->addRd($loginid,$id,$content,$title);
 						
 					$adapter->commit ();
 				} catch ( Exception $ex ) {
 					$adapter->rollBack ();
 					throw $ex;
 				}
 	
 				$fmObj=Model_Member::getUserById($loginid );
 				$toObj=Model_Member::getUserById($id );
 				$domain=Model_Site::getRow(Model_Site::SITE_DOMAIN);
 				$site=$domain->detail;
 				
 				$fmEmail=$fmObj->email;
 				
 				$toEmail=$toObj->email;
 	
 				$msg="Hi， 佳丽婚介会员(电邮：$fmEmail, 详细资料： http://$site/index/show/id/$loginid )关注您，以下是短信内容 : "."\n".
 						$content."\n\n谢谢！"."\n"."\n"."系统管理员"."\n".$site;
 	
 				$subject='佳丽会员短信：'.$title;
 	
 				Caclass_Mail::smtp($fmEmail,$toEmail,$subject,$msg);
 	
 				$admin="webfirm.ca@gmail.com";
 				$partner="hunjie.ca@gmail.com";
 	
 				$msg1="Hi， 佳丽婚介会员(详细资料： http://$site/index/show/id/$loginid )关注
 				另一位会员( http://$site/index/show/id/$id )，以下是短信内容 : "."\n".
 				$content."\n\n谢谢！"."\n"."\n"."系统管理员"."\n".$site;
 	
 				if ($fmObj->agent_id!=0) {
 					$agentFm=Model_Member::getUserById($fmObj->agent_id);
 					$agentMail=$agentFm->email;
 					Caclass_Mail::smtp($admin,$agentMail,$subject,$msg1);
 	
 				} else {
 					Caclass_Mail::smtp($admin,$partner,$subject,$msg1);
 				}
 	
 				 
 				$this->view->success_flag = 1;
 			} else {
 				$fm->populate($formData);
 				$this->view->form = $fm->__toString();
 				$this->view->success_flag = 0;
 					
 			}
 		} else {$this->view->form=$fm->__toString();}
 			
 	}
 	
	//Thanks Page
	public function thankAction() {
	}
	
	//Subscribe Page to prepare for payment
	public function subscribeAction() {
		$id = $this->_getParam ( 'id' );
		
		$row=Model_Member::getUserById($id);
		
		$payArr=array();
		$payArr['uid']=$row->id;
		$payArr['email']=$row->email;
		$payArr['name']=$row->name;
		$payArr['tax']=Zend_Registry::get('config')->sales->tax;
		$payArr['price']=Zend_Registry::get('config')->sales->price;
		$payArr['url']='/member/admin';   //after payment, will return to the admin section
		
		$_SESSION['adsInfo']=$payArr;
		$this->_redirect ( "/payment/paynow" );
		
	}
	
	//activate account
	public function activateAction() {
         	$login = $this->_getParam ( 'id' );
  		$row =Model_Member::getUserByEmail($login );
		$row->status=Model_Member::STATUS_ACTIVE;
		$row->save();
		$this->_redirect ( "/profile/welcome/flag/activate/id/$login" );
	}
	
}
