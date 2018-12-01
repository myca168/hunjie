<?php
class Model_Invoice extends Zend_Db_Table_Abstract {
	/**
	 * The default table name
	 */
	protected $_name = 'invoice';
	
	public function createAds($uid,$aid,$unit)
	{
		// create a new row
		$rowAds = $this->createRow ();
		if ($rowAds) {
			// update the row values
			$rowAds->uid =$uid;
			$rowAds->aid = $aid;
			$rowAds->inv_date = date("Y-m-d", time());
			$rowAds->start_date = date("Y-m-d", time());
			
			$rate=Model_Rate::getById($unit);
			$month=$rate->month;
			$rowAds->end_date =date("Y-m-d", strtotime(" +$month months"));
			$rowAds->unit = $unit;
			$rowAds->amt =$rate->price;
			if (Model_Member::FLAG && $aid!=0) {
				$rowAds->amt=0;
				$rowAds->paid_flag=1;
			}
			$rowAds->save ();
			//return the new user
			return $rowAds;
		} else {
			throw new Zend_Exception ( "Could not create the customer! " );
		}
	}
	
	public function extendAds($uid,$aid,$unit,$start_date)
	{
		// create a new row
		$rowAds = $this->createRow ();
		if ($rowAds) {
			// update the row values
			$rowAds->uid =$uid;
			$rowAds->aid = $aid;
			$rowAds->inv_date = date("Y-m-d", time());
			$rowAds->start_date =$start_date;
			$rate=Model_Rate::getById($unit);
			$month=$rate->month;
			$rowAds->end_date = date('Y-m-d',strtotime("+$month month",strtotime($start_date)));	
			$rowAds->unit = $unit;
			$rowAds->amt =$rate->price;
			$rowAds->save ();
			//return the new user
			return $rowAds;
		} else {
			throw new Zend_Exception ( "Could not create the customer! " );
		}
	}
	
	//return ads by id
	public function getAds($id) {
		$select=$this->select();
		$select->where ('id = ?', $id );
		return $this->fetchRow ( $select );
	}

        //return ads by id
	public static function getRow($id) {
                $dataModel = new self ( );
                $select = $dataModel->select ();
		$select->where ('id = ?', $id );
		return $dataModel->fetchRow ( $select );
	}

	//return all ads 
	public static function getAllAds() {
		$dataModel = new self ( );
		$select = $dataModel->select ();
		return $dataModel->fetchAll ( $select );
	}
	
	//return all current ads for a member
	public static function getMemberAds($uid) {
		$dataModel = new self ( );
		$select = $dataModel->select ();
		$select->where ('uid = ?', $uid );
		return $dataModel->fetchAll ( $select );
	}
	
	//get current unpaid ads for a member
	public static function getUnpaidAds($uid) {
		$dataModel = new self ( );
		$select = $dataModel->select ();
		$select->where ('uid = ?', $uid );
		$select->where('start_date <= ?',date('Y-m-d',time()));
		$select->where('paid_flag = ?',0);
		$select->limit(1);

	//	var_dump($select->__toString());
	//	 exit;
		return $dataModel->fetchRow ( $select );
	}
	
	//get last paid ads for a member
	public static function getLastPaidAds($uid) {
		$dataModel = new self ( );
		$select = $dataModel->select ();
		$select->where ('uid = ?', $uid );
		$select->where('start_date <= ?',date('Y-m-d',time()));
		$select->where('end_date >= ?',date('Y-m-d',time()));
		$select->where('paid_flag = ?',1);
		$select->order('end_date desc');
		$select->limit(1);
	
		return $dataModel->fetchRow ( $select );
	}
	
	//return all current ads 
	public static function getCurrentAds() {
		$dataModel = new self ( );
		$select = $dataModel->select ();
		$select->where('end_date > ?',date('Y-m-d H:i:s',time()))
			//	->where ('flag = ?', self::ACTIVE)
			//	->where('start_date < ?',date('Y-m-d H:i:s',time()))
				->order('end_date desc');
		return $dataModel->fetchAll ( $select );
	}
	
	public static function getInvoicesByAgent($agent=0) {
		$userModel = new self ( );
		$select = $userModel->select ();
		$select->where ('aid = ?', $agent );
		return $userModel->fetchAll ( $select );
	}
	
	
	//return all current ads 
	public static function getCurrentAdsByLocation($index) {
		$countryid=Model_City::getCountryId($_SESSION['cityid']);
		$countrycode=Model_Country::getCode($countryid);
		$dataModel = new self ( );	
		$city=$_SESSION['cityid'];	
		$sel=self::ALL;
		$d1=date('Y-m-d H:i:s',time());
		$select = $dataModel->select ();
		$select->where ('location_id = ?', $index)
				->where ('flag = ?', self::ACTIVE)
				->where("start_date<'$d1' and end_date>'$d1'")
			//	->where('start_date < ?',date('Y-m-d H:i:s',time()))
			//	->andWhere('end_date > ?',date('Y-m-d H:i:s',time()))
				->where("city_id='$city' or region = '$sel' or region = '$countrycode'")
			//	->where('city_id = ? ',$_SESSION['cityid'])
			//	->orWhere('region = ? ',self::ALL)
			//	->orWhere('region = ? ',$countrycode)
				->order('sqn')
				->order('end_date desc');
		// var_dump($select->__toString());
		// exit;
		return $dataModel->fetchAll ( $select );
	}
	
	public function getCurrentAdsInCity($cityId) {
		$select = $this->select();
		$select->where ('city_id = ?', $cityId )
				->where ('flag = ?', self::ACTIVE)
		//		->where('start_date < ?',date('Y-m-d H:i:s',time()))
				->where('end_date > ?',date('Y-m-d H:i:s',time()));
		return $this->fetchAll ( $select );
	}
	
	public static function getAdsByCutomerId($customer_id) {
		$dataModel = new self ( );
		$select = $dataModel->select ();
		$select->where('customer_id = ?',$customer_id);
		return $dataModel->fetchAll ( $select );
	}
	
	public static function getCustomerCurrentAds($customer_id) {
		$dataModel = new self ( );
		$select = $dataModel->select ();
		$select->where('customer_id = ?',$customer_id)
				->where('end_date > ?',date('Y-m-d H:i:s',time()))
				->order('end_date desc');
		return $dataModel->fetchAll ( $select );
	}
	
	//get customer last ads 
	public static function getLastAds($customer_id) {
		$dataModel = new self ( );
		$select = $dataModel->select ();
		$select->where('customer_id = ?',$customer_id)
				->where("end_date = (select max(end_date) from ads_records where customer_id=$customer_id group by customer_id)");
		return $dataModel->fetchRow ( $select );
	}
	
	//return summary current adss, based on main category - Demo Codes for join
	public static function getSummaryRecords($cat_id) {
	
		$db=Zend_Db_Table::getDefaultAdapter();
	
		$select=$db->select();
		$select->from('classifieds_customers', array('subcategoryid','count'=>'COUNT(*)'));
		$select->join('classifieds_types', 'classifieds_customers.subcategoryid = classifieds_types.id',array('name'));
		$select->where('classifieds_customers.categoryid = ? ',$cat_id);
		$select->where('classifieds_customers.approved = ? ',self::APPROVED);
		$select->where('classifieds_customers.start_date < ? ',date('Y-m-d H:i:s',time()));
		$select->where('classifieds_customers.end_date > ? ',date('Y-m-d H:i:s',time()));
		$select->group('classifieds_customers.subcategoryid');
		$select->order('classifieds_types.sqn');
	
		// var_dump($select->__toString());
		// exit;
	
		return $db->fetchAll($select);
	}
	
}
