<?php
class Model_Friend extends Zend_Db_Table_Abstract {
	/**
	 * The default table name
	 */
	protected $_name = 'friend';
	
	public function createRecord($name,$domain,$sqn,$notes) 
	{
		// create a new row
		$row = $this->createRow ();
		if ($row) {
			// update the row values
			$row->name = $name;
			$row->link = $domain;
			$row->sqn = $sqn;
			$row->notes=$notes;
			$row->save ();
			return $row;
		} else {
			throw new Zend_Exception ( "Could not create the customer! " );
		}
	}
	
	//update information
	public function updateRecord($id,$name,$domain,$sqn,$notes) 
	{
		// fetch the row
		$row = $this->find ( $id )->current ();
		
		if ($row) {
			$row->name = $name;
			$row->link = $domain;
			$row->sqn = $sqn;
			$row->notes=$notes;
			$row->save ();
			return $row;
		} else {
			throw new Zend_Exception ( "Record update failed ! " );
		}
	}
	
	//return row by id
	public function getRowById($id) {
		
		$select = $this->select();
		$select->where ('id = ?', $id );
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
	//Get All
	public static function getAll() {
		$Model = new self ( );
		$select = $Model->select ();
		$select->order('sqn');
		return $Model->fetchAll ( $select );
	}

}