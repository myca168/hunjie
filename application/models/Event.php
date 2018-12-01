<?php
class Model_Event extends Zend_Db_Table_Abstract {
	/**
	 * The default table name
	 */
	protected $_name = 'events';
	
	/**
	 * Create a new row 
	 */
	public function addRecord($login,$dir,$city,$title,$address,$contact,$phone,$email,
	$start_date,$end_date,$time1,$time2,$min1,$min2,$details,$ip) 
	{
		// create a new row
		$row = $this->createRow ();
		if ($row) {
			// update the row values
			$row->login = $login;
			$row->dir = $dir;
			$row->city = $city;
			$row->title = $title;
			$row->address = $address;
			$row->contact = $contact;
			$row->phone = $phone;
			$row->email = $email;
			$t1=date('Y-m-d H:i:s',strtotime("$start_date $time1:$min1:00"));
			$t2=date('Y-m-d H:i:s',strtotime("$end_date $time2:$min2:00"));
			$row->start_date = $t1;
			$row->end_date = $t2;
			$row->time1 = $time1;
			$row->time2 = $time2;
			$row->min1 = $min1;
			$row->min2 = $min2;
			$row->details = $details;
			$row->ip = $ip;
			
			$row->save ();

                        //Email Notifications

                        $domain=Model_Site::getRow(Model_Site::SITE_DOMAIN)->detail;
              
	 		$email=Model_Site::getRow(Model_Site::SITE_SALES)->detail;
                        $email_from=Model_Site::getRow(Model_Site::SITE_WEBMASTER)->detail;
         		$subject="New event created !";
         		$msg="http://$domain/event/view/id/{$row->id}"."\n"."\n".date('l jS \of F Y h:i:s A');
              	
              	        Caclass_Mail::smtp($email_from,$email,$subject,$msg);



			//return the new user
			return $row;
		} else {
			throw new Zend_Exception ( "Could not create the record! " );
		}
	}
	
	//update information 
	public function updateRecord($id,$city,$title,$address,$contact,$phone,$email,$start_date,$end_date,$time1,$time2,$min1,$min2,$details,$ip) 
	{
		// fetch the row
		$row = $this->find ( $id )->current ();
		
		if ($row) {
			// update the row values
			$row->city = $city;
			$row->title = $title;
			$row->address = $address;
			$row->contact = $contact;
			$row->phone = $phone;
			$row->email = $email;
			$t1=date('Y-m-d H:i:s',strtotime("$start_date $time1:$min1:00"));
			$t2=date('Y-m-d H:i:s',strtotime("$end_date $time2:$min2:00"));
			$row->start_date = $t1;
			$row->end_date = $t2;
			$row->time1 = $time1;
			$row->time2 = $time2;
			$row->min1 = $min1;
			$row->min2 = $min2;
			$row->details = $details;
			$row->ip = $ip;
			
			$row->save ();
			//return the new user
			return $row;
		} else {
			throw new Zend_Exception ( "Could not create the customer! " );
		}
	}
	
	public static function getDir($login) {
		$dataModel = new self ( );
		$select = $dataModel->select ();
		$select->where('login = ? ',$login);
		$select->order('dir desc');
		$select->limit(1);
		return $dataModel->fetchRow ( $select );
	}
	/**
	 */
	public static function getAll() {
    	$Model = new self ( );
		$select = $Model->select ();
     	$select->where('end_date > ? ',date('Y-m-d H:i:s',time()));	
     	$select->where('city = ? ',$_SESSION['cityid']);
     	$select->order('sqn');
     	$select->order('id desc');
     	
 		return $Model->fetchAll($select);
	}
	
	/**
	 * return 20 ads that will expire soon
	 */
	public static function getRecentAds() {
    	$Model = new self ( );
		$select = $Model->select ();
     	$select->where('end_date > ? ',date('Y-m-d H:i:s',time()));	
     	$select->order('end_date');
     	$select->limit(18);
     	
 		return $Model->fetchAll($select);
	}
	
	/**
	 * return ads for its id
	 */
	public function getModel($id) {
		
		$select = $this->select();
		$select->where ('id = ?', $id );
		return $this->fetchRow ( $select );
	}
	
	/**
	 * return ads for its id
	 */
	public static function getUserEvents($login) {
		$Model = new self ( );
		$select = $Model->select ();
		$select->where ('login = ?', $login );
		return $Model->fetchAll ( $select );
		
	}
	
	public static function getRowById($id) {
		$Model = new self ( );
		$select = $Model->select ();
		$select->where ('id = ?', $id);
		return $Model->fetchRow ( $select );
	}
}
