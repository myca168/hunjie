<?php
class Model_PaidInvoice extends Zend_Db_Table_Abstract {
	/**
	 * The default table name
	 */
	protected $_name = 'paid_invoice';
	
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
			$rowAds->save ();
			//return the new user
			return $rowAds;
		} else {
			throw new Zend_Exception ( "Could not create the customer! " );
		}
	}
	
}
