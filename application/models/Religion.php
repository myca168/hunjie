<?php
class Model_Religion extends Zend_Db_Table_Abstract {
	/**
	 * The default table name
	 */
	protected $_name = 'religion';
	public function creattObj($desc)    //do not need it to create a row
	{
		// create a new row
		$rowNew = $this->createRow ();
		if ($rowNew) {
			// update the row values
			$rowNew->name = $desc;
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
			$arr[$page->id]=$page->name;
			}	
		}
		return $arr;
	}
	
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
