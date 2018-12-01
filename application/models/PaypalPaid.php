<?php
class Model_PaypalPaid extends Zend_Db_Table_Abstract {
	/**
	 * The default table name
	 */
	protected $_name = 'paypal_paid';
	
	public static function createRecord($invoice,$status,$amount,$currency,$txn_id,$receiver,$payer) 
	{
		// create a new row
		$row = $this->createRow ();
		if ($row) {
			// update the row values
			$row->invoice = $invoice;
			$row->status = $status;
			$row->amount = $amount;
			$row->currency = $currency;
			$row->txn_id = $txn_id;
			$row->receiver = $receiver;
			$row->payer = $payer;
			
			$row->save ();

			//return the new user
			return $row;
		} else {
			throw new Zend_Exception ( "Could not create the customer! " );
		}
	}
	
}
