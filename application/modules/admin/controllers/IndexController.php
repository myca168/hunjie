<?php

class Admin_IndexController extends Zend_Controller_Action {
	
	public function init() {
		//	$this->_helper->layout->setLayout ( 'profile' );
			$this->view->addScriptPath ( APPLICATION_PATH . '/views/partials/' );
	}
	
    public function indexAction() {
		$data = Zend_Paginator::factory (Model_Member::getMembersOnly());
		$data->setCurrentPageNumber($this->_getParam('page', 1 ));
		$data->setItemCountPerPage ( 10 );
		$this->view->rows = $data;
    }
    
    //Invoices detail Page for a member
    public function adsAction() {
    	$id=$this->_getParam ( 'id' );
    	$this->view->user=Model_Member::getUserById($id);
    	$data = Zend_Paginator::factory (Model_Invoice::getMemberAds($id));
    	$data->setCurrentPageNumber($this->_getParam('page', 1 ));
    	$data->setItemCountPerPage (20);
    	$this->view->rows = $data;
    }
    //reset invoice amt to 0 and paid flag to true
    public function zeroAction() {
    	$id=$this->_getParam ( 'id' );
    	$uid=$this->_getParam ( 'uid' );
    	$obj=new Model_Invoice();
    	$row=$obj->getAds($id);
    	if (!$row) {die('Data no found !');}
    	$row->amt=0;
    	$row->paid_flag=1;
    	$row->save();
    	$this->_redirect ( "/admin/index/ads/id/$uid" );
    }
    
    //Set paid amt to invoice amt and paid flag to true
    public function paidAction() {
    	$id=$this->_getParam ( 'id' );
    	$uid=$this->_getParam ( 'uid' );
    	$obj=new Model_Invoice();
    	$row=$obj->getAds($id);
    	if (!$row) {die('Data no found !');}
    	$row->paid_amt=$row->amt;
    	$row->paid_flag=1;
    	$row->save();
    	$this->_redirect ( "/admin/index/ads/id/$uid" );
    }

    public function searchAction() {
    $uid=$_POST['uid'];
    $obj=Model_Member::getByEmailId($uid);
    $this->view->row=$obj;
    }  
    
    //Delete an invoice
    public function rminvAction() {
    	$id=$this->_getParam ( 'id' );
    	$uid=$this->_getParam ( 'uid' );
    	$obj=new Model_Invoice();
    	$row=$obj->getAds($id);
    	if (!$row) {die('Data no found !');}
    	$row->delete();
    	$this->_redirect ( "/admin/index/ads/id/$uid" );
    }
    
    //Ads extension Page
    public function extendAction() {

    	$id=$this->_getParam ( 'id' );
    	
    	$this->view->user=Model_Member::getUserById($id);
    	
    	$agentId=Model_Member::getUserById($id)->agent_id;
    		
    	$this->view->rows = Model_Invoice::getMemberAds($id);
    		
    	$fm = new Form_Extend();
    		
    	$this->view->form=$fm;
    		
    	if ($this->getRequest()->isPost()) {
    			
    		if ($fm->isValid($_POST)) {
    			$ads=$fm->getValue('ads');
    			$lastPaid=Model_Invoice::getLastPaidAds($id);
    				
    			try {
    					
    				$adapter = Zend_Db_Table::getDefaultAdapter ();
    				$adapter->beginTransaction ();
    				
    				$where = array();
    				$where[] = $adapter->quoteInto('uid = ?', $id);
    				$where[] = $adapter->quoteInto('paid_flag = ?', 0);
    				
    				$adapter->delete('invoice', $where);
    
    				if (!$lastPaid) {
    						
    					$inv = new Model_Invoice();
    					$inv->createAds($id,$agentId,$ads);
    						
    				} else {
    					$start_date=$lastPaid->end_date;
    					$inv = new Model_Invoice();
    					$inv->extendAds($id,$agentId,$ads,$start_date);
    				}
    					
    				$adapter->commit ();
    					
    			} catch ( Exception $ex ) {
    					
    				$adapter->rollBack ();
    				throw $ex;
    			}
    
    		}
    
    		$this->_redirect ( "/admin" );
    
    	}
    		
    }
    
    
}
?>
