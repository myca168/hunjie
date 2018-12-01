<?php
class Model_Payment_Payer
{
	public $db;

	public function __construct()
	{
		$this->db = Zend_Db_Table::getDefaultAdapter();
		$this->db->setFetchMode(Zend_Db::FETCH_ASSOC);
	}
	//to log paypal or credit card payment errors
	public function logErrors($uid,$error_location,$error1,$error2,$inv_id,
			$event_date,$agent_id,$amt)
	{
		$arr=array( 
		"uid"=>$uid,
		"error_location"=>$error_location,
		"error1"=>$error1,
		"error2"=>$error2,
		"inv_id"=>$inv_id,
		"event_date"=>$event_date,
		"agent_id"=>$agent_id,
		"amt"=>$amt,
		);
		$rs = $this->db->insert('paypal_errors',$arr);
		return $rs;

	}

	public function savePayer($fname,$lname,$phone,$email,$cardtype,$cardnumber,$month_exp,$year_exp,$cvd,$addr1,
				$addr2,$city,$state,$country,$zip,$paid_amt,$inv_id,$date_created,$ip,$agentId)
	{
		$data=array(
					'fname'=>$fname,
					'lname'=>$lname,
					'phone'=>$phone,
					'email'=>$email,
					'cardtype'=>$cardtype,
					'cardnumber'=>$cardnumber,
					'month_exp'=>$month_exp,
					'year_exp'=>$year_exp,
					'cvd'=>$cvd,
					'addr1'=>$addr1,
					'addr2'=>$addr2,
					'city'=>$city,
					'state'=>$state,
					'country'=>$country,
					'zip'=>$zip,
					'paid_amt'=>$paid_amt,
					'inv_id'=>$inv_id,
					'date_created'=>$date_created,
					'ip'=>$ip,
				    'agent_id'=>$agentId                  //0 if not paid by agent
					);
		
		$rs = $this->db->insert('payers',$data);

		return $rs;
	}
}