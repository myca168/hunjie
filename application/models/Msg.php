<?php
class Model_Msg extends Zend_Db_Table_Abstract {
	/**
	 * The default table name
	 */
	protected $_name = 'msg_stats';
	
	public function addRd($uid,$msgin=0,$msgout=0)
	{
		// create a new row
		$row = $this->createRow ();
		if ($row) {
			// update the row values
			$row->uid =$uid;
			$row->msgin = $msgin;
			$row->msgout = $msgout;
			
			$row->save ();
			return $row;
		} else {
			throw new Zend_Exception ( "Could not create the customer! " );
		}
	}
	
	public function updateRd($id,$uid,$msgin=0,$msgout=0)
	{
		$row = $this->find ( $id )->current ();
		
		if ($row) {
			$row->uid =$uid;
			$row->msgin = $msgin;
			$row->msgout = $msgout;
			$row->save ();
			//return the new user
			return $row;
		} else {
			throw new Zend_Exception ( "Could not create the customer! " );
		}
	}
	//return obj if exists
	public static function getObj($uid) {
	
		$Model = new self ( );
		$select = $Model->select ();
		$select->where('uid = ? ',$uid);
		$select->limit(1);
		return $Model->fetchRow($select);
	}
	
}
