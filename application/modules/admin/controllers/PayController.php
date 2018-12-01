<?php

class Admin_PayController extends Zend_Controller_Action {
	
	public function init() {
		$this->view->addScriptPath ( APPLICATION_PATH . '/views/partials/' );
	}
	
    public function indexAction() {
    }
    
    //set top ads
 	public function setadsAction() {
 		
 		$id = $this->_getParam ( 'id' );
		if (! $id) {
			throw new Exception ( "ID must be provided !" );
		}
		
		$type=$this->_getParam ( 'atype' );
		
 		if (! $type) {
			throw new Exception ( "Section ID must be provided !" );
		}
		
		$row=0;
		$flag=1;				//default flag value set in database 1=no, 2=yes on top - hard code
		$sqn=99;				//default sqn 99 set in database for no on top ads - hard code
		
		$fm=new Form_SetOnTop();
 		$this->view->form=$fm;
 		$this->view->type=$type;
 		
 			switch ($type) {
    		case "yp":					//from yellowpages section
        			$model=new Model_YpCustomer();
        			$row=$model->getAdsById($id);
        			$this->view->model="Yellowpages Section";
        			break;
    		case "cs":					//from classifieds section
        			$row=Model_ClassifiedsCustomer::getAds($id);
        			$this->view->model="Classifieds Section";
        			break;
    		case "car":					//from car section
        			$row=Model_CarAds::getAds($id);
        			$this->view->model="Cars Section";
        			break;
        	case "food":					//from restaurant section
        			$row=Model_FoodRes::getRowById($id);
        			$this->view->model="Restaurants Section";
        			break;
        	case "job":					//from job section
        			$row=Model_JobEmployer::getAds($id);
        			$this->view->model="Jobs Section";
        			break;
        	case "joba":					//from job agent section
        			$row=Model_JobAgent::getRowById($id);
        			$this->view->model="Jobs Agent Section";
        			break;
        	case "ha":					//from house agent section
        			$row=Model_Agents::getRowById($id);
        			$this->view->model="Houses Agent Section";
        			break;
        	case "hs":					//from house for sale section
        			$row=Model_HouseSell::getAds($id);
        			$this->view->model="Houses for Sale Section";
        			break;
        	case "hr":					//from house for rent section
        			$row=Model_HouseOwner::getAds($id);
        			$this->view->model="Houses for Rent Section";
        			break;
        	case "hc":					//from commercial properties section
        			$row=Model_HouseCommerceTrans::getAds($id);
        			$this->view->model="Commercial Properties Section";
        			break;
        	case "hp":					//from new project in house section
        			$row=Model_HouseProject::getAds($id);
        			$this->view->model="New Project Section (Real Estate)";
        			break;
			}
			
		if (!$row) {throw new Exception ( "The record was not found !" );}	
		
		$this->view->row=$row;
 		
 		if ($this->_request->isPost()) {
 		 if ($fm->isValid($_POST)){
 		 	
 		 	$start=	$fm->getValue ('start');
        	$month=$fm->getValue ('month');
        	$flag=$fm->getValue ('flag');
 		 	
 		 	switch ($type) {
    		case "cs":					//from classifieds section
    		case "car":					//from car section
        	case "job":					//from job section
         				if ($flag==2) {
        					$row->flag=2;
        					$row->sqn=80;		//default on top sqn =80 -- hard code
        					$row->start_date=$start;
        					$row->end_date=date('Y-m-d',strtotime("+$month week",strtotime($start)));
        					$row->week=$month;
        				} else {
        					$row->flag=1;
        					$row->sqn=99;		//default on top sqn =80 -- hard code
        					$row->start_date=$start;
        					$row->end_date=date('Y-m-d',strtotime("+$month week",strtotime($start)));
        					$row->week=$month;
        				}
        				$row->save();
        			break;
    		case "yp":					//from yellowpages section
        	case "food":				//from restaurant section
        	case "joba":				//from job agent section
        	case "ha":					//from house for sale section
        	case "hs":					//from house for sale section
        	case "hr":					//from house for rent section
        	case "hc":					//from commercial properties section
        	case "hp":					//from new project in house section
         				if ($flag==2) {
        					$row->flag=2;
        					$row->sqn=80;		//default on top sqn =80 -- hard code
        					$row->start_date=$start;
        					$row->end_date=date('Y-m-d',strtotime("+$month month",strtotime($start)));
        					$row->month=$month;
        				} else {
        					$row->flag=1;
        					$row->sqn=99;		//default on top sqn =80 -- hard code
        					$row->start_date=$start;
        					$row->end_date=date('Y-m-d',strtotime("+$month month",strtotime($start)));
        					$row->month=$month;
        				}
        				$row->save();
        			break;
			}
 		 	
 			$this->_redirect("/admin/pay/");
 		 }
 		 
        }
    }
}
?>
