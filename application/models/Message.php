<?php
class Model_Message extends Zend_Db_Table_Abstract {
	/**
	 * The default table name
	 */
	protected $_name = 'message';
	
	public function addRd($from,$to,$content,$title)
	{
		// create a new row
		$row = $this->createRow ();
		if ($row) {
			// update the row values
			$row->sid =$from;
			$row->rid =$to;
			$row->created_date =date("Y-m-d", time());
			$row->content = $content;
			$row->title = $title;
			
			$row->save ();
			return $row;
		} else {
			throw new Zend_Exception ( "Could not create the customer! " );
		}
	}
	//return rows by uid
	public static function getRows($uid) {
		$dataModel = new self ( );
		$select = $dataModel->select ();
		$select->where ('rid = ?',$uid);
	//	var_dump($select->__toString());
	//	exit;
		return $dataModel->fetchAll($select);
	}
	
	//return obj by id
	public static function getObj($id) {
		$dataModel = new self ( );
		$select = $dataModel->select ();
		$select->where ('id = ?',$id);
		return $dataModel->fetchRow($select);
	}
	
	//return all 
	public static function getAll() {
		$dataModel = new self ( );
		$select = $dataModel->select ();
		return $dataModel->fetchAll ( $select );
	}
	
}
