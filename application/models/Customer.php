<?php
class Model_Customer extends Zend_Db_Table_Abstract {
	/**
	 * The default table name
	 */
	protected $_name = 'ads_customers';
	
	const ACTIVE = 'Active';
	const INACTIVE = 'Inactive';
	const TYPE_MEMBER = 'Member';
	const TYPE_VIP = 'VIP';
	const TYPE_SUPERVIP = 'Super VIP';
	
	public function createCustomer($name,$tel,$email,$desc,$link,$address,$city_id) 
	{
		if ($this->checkEmail($email)) {
            		throw new Exception("Duplicated Email !");
            		exit;
        }	
		// create a new row
		$rowcustomer = $this->createRow ();
		if ($rowcustomer) {
			
	
			// update the row values
			$rowcustomer->status = self::ACTIVE;
			$rowcustomer->name = $name;
			$rowcustomer->tel = $tel;
			$rowcustomer->email = $email;
			$rowcustomer->desc = $desc;
			$rowcustomer->link = $link;
			$rowcustomer->address = $address;
			$rowcustomer->city_id = $city_id;
			
			$rowcustomer->save ();
			//return the new user
			return $rowcustomer;
		} else {
			throw new Zend_Exception ( "Could not create the customer! " );
		}
	}
	
	//update customer information
	public function updateCustomer($id,$name,$tel,$desc,$link,$address,$city_id) 
		{
		// fetch the row
		$rowcustomer = $this->find ( $id )->current ();
		
		if ($rowcustomer) {
			// update the row values
			$rowcustomer->name = $name;
			$rowcustomer->tel = $tel;
		//	$rowcustomer->email = $email;
			$rowcustomer->desc = $desc;
			$rowcustomer->link = $link;
			$rowcustomer->address = $address;
			$rowcustomer->city_id = $city_id;
			$rowcustomer->save ();
			//return the new user
			return $rowcustomer;
		} else {
			throw new Zend_Exception ( "Record update failed ! " );
		}
	}
	
	public static function getAllCustomers() {
		$customerModel = new self ( );
		$select = $customerModel->select ();
		return $customerModel->fetchAll ( $select );
	}
	
	public static function getCustomerById($id) {
		$customerModel = new self ( );
		$select = $customerModel->select ();
		$select->where ('id = ?', $id );
		$customer=$customerModel->fetchRow ( $select );
		return $customer;
	}
	
	public static function getCustomersByEmail($email) {
		//$select = $this->select();
		$dataModel = new self ( );
		$select = $dataModel->select ();
		$select->where('email LIKE ? ',$email."%");
		return $dataModel->fetchAll ( $select );
	}
	
	public static function getCustomersByName($name) {
		//$select = $this->select();
		$dataModel = new self ( );
		$select = $dataModel->select ();
		$select->where('name LIKE ?',"%".$name."%");
		return $dataModel->fetchAll ( $select );
	}
	
	public function getCustomer($id) {
		$select = $this->select();
		$select->where ('id = ?', $id );
		return $this->fetchRow ( $select );
	}
	
	public function checkEmail($email) {
		$select = $this->select();
		$select->where('email = ? ',$email);
		return $this->fetchRow ( $select );
	}
	
	//delete a row
	public static function remove($id) {
		
		$Model = new self ( );
		$select = $Model->select ();
		$select->where ('id = ?', $id );
		$row=$Model->fetchRow ( $select );
		
		if ($row) {
			$row->delete ();
		} else {
			throw new Zend_Exception ( "Failed to delete the row !" );
		}
	}
}
