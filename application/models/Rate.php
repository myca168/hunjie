<?php
class Model_Rate extends Zend_Db_Table_Abstract {
	/**
	 * The default table name
	 */
	protected $_name = 'rate';
	public function creattObj($desc,$month,$pkey)    //do not need it to create a row
	{
		// create a new row
		$rowNew = $this->createRow ();
		if ($rowNew) {
			// update the row values
			$rowNew->desc = $desc;
			$rowNew->month = $month;
			$rowNew->pkey = $pkey;
			$rowNew->save ();
			return $rowNew;
		} else {
			throw new Zend_Exception ( "Could not create the record! " );
		}
	}
	
	public static function getAll() {
	
		$dataModel = new self ( );
		
		$select = $dataModel->select ();
		$pages=$dataModel->fetchAll($select);
		
		if (count($pages)==0) {throw new Zend_Exception ( "No data ! " );} 
		else {
		$arr=array();
			foreach ($pages as $page) {
			$arr[$page->id]=$page->desc;
			}	
		}
		return $arr;
	}
	
	public static function getRows() {
	
		$dataModel = new self ( );
	
		$select = $dataModel->select ();
		return $dataModel->fetchAll($select);
	}
	
	public static function getName($id) {
	
		$Model = new self ( );
		
		$select = $Model->select ();
		$select->where ('id = ?', $id );
		$row=$Model->fetchRow ( $select );
		if ($row) {
		return $row->desc;
		}
	}
	
	public static function getByPkey($pkey) {
	
		$Model = new self ( );
		$select = $Model->select ();
		$select->where ('pkey = ?', $pkey );
		return $Model->fetchRow ( $select );
	}
	
	public static function getById($id) {
	
		$Model = new self ( );
		$select = $Model->select ();
		$select->where ('id = ?', $id );
		return $Model->fetchRow ( $select );
	}

}
