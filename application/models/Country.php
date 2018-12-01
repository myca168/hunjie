<?php
class Model_Country extends Zend_Db_Table_Abstract {
	/**
	 * The default table name
	 */
	protected $_name = 'country';
	
 	public function createObj($name,$sqn=99) 
	{
		// create a new row
		$row = $this->createRow ();
		if ($row) {
			// update the row values
			$row->name = $name;
			$row->sqn = $sqn;
			$row->save ();
			return $row;
		} else {
			throw new Zend_Exception ( "Could not create the record! " );
		}
	}
	
	//Return all countries rows 
	public static function getAll() {
		$Model = new self ( );
		$select = $Model->select ();
		$select->order('sqn');
		return $Model->fetchAll ( $select );
	}
	
	//Return all countries in array
	public static function getRows() {
		$Model = new self ( );
		$select = $Model->select ();
		$select->order('sqn');
		$rows=$Model->fetchAll ( $select );
		$arr=array();
		foreach ($rows as $row) {
			$arr[$row->id]=$row->name;
		}
		return $arr;
	}
	
	//Returnname by ID
	public static function getName($id) {
		$Model = new self ( );
		$select = $Model->select ();
		$select->where ('id = ?', $id );
		$row=$Model->fetchRow ( $select );
		if ($row) {
		return $row->name;
		}
	}
		
}
