<?php

class IndexController extends Zend_Controller_Action {
	
	public function init() {
		$this->view->addScriptPath ( APPLICATION_PATH . '/views/partials/' );
	}
	
	public function indexAction() {
          	$this->_helper->layout->setLayout ( 'front' );
		$obj=new Model_Member();
		$this->view->rows=$obj->getRecent(18);
		$this->view->images=$obj->getMembersWithPhoto(12);               
	}
	
	public function showAction() {
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
	//default search
	public function searchAction() {
		$gender=$_POST['gender'];
		$age1=$_POST['age'];
		$age2=$_POST['maxage'];
		$country=$_POST['country'];
		if (isset($_POST['pic'])) {
		$pic=1;
		} else {$pic=0;}
		$data = Zend_Paginator::factory (Model_Member::searchUsers($gender,$age1,$age2,$country,$pic));
		$data->setCurrentPageNumber($this->_getParam('page', 1 ));
		$data->setItemCountPerPage (20);
		$this->view->rows = $data;
	
	}
	
	//advanced search
	public function asearchAction() {
	}
	
	//advanced search results
	public function resultAction() {
		$gender=$_POST['gender'];
		$age1=$_POST['age'];
		$age2=$_POST['maxage'];
		$country=$_POST['country'];
		$nation=$_POST['nation'];
		if (isset($_POST['pic'])) {
			$pic=1;
		} else {$pic=0;}
		$edu=$_POST['edu'];
		$ethic=$_POST['ethic'];
		$marr=$_POST['marr'];
		$child=$_POST['child'];
		$drink=$_POST['drink'];
		$smoke=$_POST['smoke'];
		$animal=$_POST['animal'];
		$star=$_POST['star'];
		$data = Zend_Paginator::factory (Model_Member::advSearch
		($gender,$age1,$age2,$country,$nation,$edu,$ethic,$marr,$child,$drink,$smoke,$animal,$star,$pic));
		$data->setCurrentPageNumber($this->_getParam('page', 1 ));
		$data->setItemCountPerPage (20);
		$this->view->rows = $data;
		$this->render('search');
	}

        	//display a member info by search in id or email
	public function displayAction() {
		$uid=$_POST['uid'];
		if (strlen($uid)>31) {
			die('非法输入！');
		}
	//	var_dump($uid);
	//	die('here');
		$obj=Model_Member::getByEmailId($uid);
		if ($obj) {
		$images=array();
		$id=$obj->id;
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
		$this->view->row=$obj;
	}

	
	public function aboutAction() {
	
	}
	
	public function helpAction() {
	
	}
	
	public function contactusAction() {
	
	}
	
	
	public function conditionAction() {
		
	}
	public function privacyAction() {
	
	}
	
	
}