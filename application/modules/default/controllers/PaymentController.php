<?php
/**
*/
class PaymentController extends Zend_Controller_Action
{
	public $url;

	public function init()
	{
		$this->url = Zend_Registry::get ('config')->url;
	}
	//adsinfo is an array set in each module in order to use paypal or credit cards. Do not change the session name!
	public function paynowAction() {
		
		$aMessages = $this->_helper->FlashMessenger->getMessages();
		if (empty($aMessages[0])) { $msg = ""; } else {$msg = $aMessages[0];}
		
		$this->view->msg = $msg;

                if (!isset($_SESSION['adsInfo'])) {$this->_redirect ( "/index" );}
		
		$adsInfo=$_SESSION['adsInfo'];
		
			$data=array();
			$data['return_url'] = "$this->url/payment/paypal-express";
			$data['cancel_url'] = "$this->url/payment/paynow";
			$data['uid'] = $adsInfo['uid'];			//member id
			$data['inv_id'] = Zend_Auth::getInstance ()->getIdentity ()->id;   //invoice id
			$data['email'] = $adsInfo['email'];				//user login id
			$data['name'] = $adsInfo['name'];			//Member Name
	//		$data['agent'] = $adsInfo['agent'];				//agent ID,0 if not agent!
			$data['price']=$adsInfo['price'];
			$taxRate=$adsInfo['tax'];						//sales tax rate	
			$data['tax_amt']=round($data['price']*$taxRate,2);
			$data['total']=$data['price']+$data['tax_amt'];		//total amount = item price + tax
			$data['url']=$adsInfo['url'];
		
		        $this->view->data=$data;


		$request= $this->getRequest();

        $card_btn='';
		$paypal_btn='';
		if ($request->isPost ()) {
			if ($request->getParam('submit')) {$card_btn='submit';} else {$paypal_btn ='paypal';}
		}		
		$this->view->data=$data;
		$this->view->flag=false;		//if true, will pay in both paypal and credit card, otherwise, only use paypal
	
		if ($paypal_btn == "paypal")
				{
					$model_pay = new Model_Payment_Paypal();

                                        

					$resArray = $model_pay->setexpress($data);
                                        
					
					$token = strtoupper ( isset($resArray ["TOKEN"])?$resArray ["TOKEN"]:""  );
					$ack = strtoupper ( $resArray ["ACK"] );
					
					if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING")
					{

						$payPalURL = "https://www.paypal.com/webscr&cmd=_express-checkout&token=$token";
						header("Location: $payPalURL");
						exit;
					}
					else
					{
						$msg = "<p> ".$ack.", ".$resArray["L_LONGMESSAGE0"]."</p>";
						$msg .= "<p> Please try again.</p> ";
						$this->view->msg = $msg;
						
						$err='Set Express Error';
						$err1=$msg;
						$err2=$resArray['L_LONGMESSAGE0'];
						$date=date('Y-m-d h:m:s',strtotime($resArray["TIMESTAMP"]));
						$logModel=new Model_Payment_Payer();

               			$logModel->logErrors($data['uid'],$err,$err1,$err2,$data['inv_id'],$date,
						$data['agent'],$data['total']);
					}
				}
	}
	
	public function paypalExpressAction()
	{
		$request= $this->getRequest();
		$token = $request->getParam('token');

		$model_pay = new Model_Payment_Paypal();
		$resArray = $model_pay->getexpress($token);
		
   
         $invId=$resArray ["L_PAYMENTREQUEST_0_NUMBER0"];
         $uid=$resArray ["L_PAYMENTREQUEST_0_DESC0"];
         $amt=$resArray ["PAYMENTREQUEST_0_AMT"];
         $curr=$resArray ["PAYMENTREQUEST_0_CURRENCYCODE"];
		
	
		$token = strtoupper ( $resArray ["TOKEN"] );
		$payerID = strtoupper ( $resArray ['PAYERID'] );
		$paymentAmount = strtoupper ( $resArray ['AMT'] );
		
		$ack = strtoupper ( $resArray ["ACK"] );
	 if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING")
		{
			unset($resArray);
			$resArray = $model_pay->doexpress ($token, $payerID, $paymentAmount);
			
			$ack = strtoupper ( $resArray ["ACK"] );
		if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") 
		 {
		//	$date=date('Y-m-d h:m:s',strtotime($resArray["TIMESTAMP"]));
			$trx_id=$resArray["TRANSACTIONID"];
		//	$trx_type=$resArray["TRANSACTIONTYPE"];
		//	$currency=$resArray["CURRENCYCODE"];
        /*   
 			$row=Model_Invoice::getRow($invId);
                        $row->paid_flag=1;
                        $row->paid_amt=$paymentAmount;
                        $row->trx_id=$trx_id;
                        $row->save();
                        exit;
         */
			            //Set user paid flag to true

				    $row=Model_Member::getUserById($invId);
			            $row->paid_flag=1;
			            $row->save();
			
                        $_SESSION['uid']=$uid;
                        $_SESSION['tid']=$trx_id;
                        $_SESSION['amt']=$paymentAmount;
 			
			$this->_redirect("/payment/thank");
			exit;
		 } else {
				$msg = $ack.", ".$resArray['L_LONGMESSAGE0']." Please try again !";
				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($msg);
				
				$err='Do Express Error';
				$err1=$resArray['L_SHORTMESSAGE0'];
				$err2=$resArray['L_LONGMESSAGE0'];
				$date=date('Y-m-d h:m:s',strtotime($resArray["TIMESTAMP"]));
				$logModel=new Model_Payment_Payer();
                                $logModel->logErrors($data['uid'],$err,$err1,$err2,$data['inv_id'],$date,
						$data['agent'],$data['total']);
				
				$this->_redirect("/payment/paynow");
				exit;
				}
		
		} else {
		$msg = $ack.", ".$resArray["L_LONGMESSAGE0"];
		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage($msg);
		$this->_redirect("/payment/paynow");
		exit;
		}
	}
	
	public function thankAction()
	{
        $this->view->uid = $_SESSION['uid'];			
		$this->view->tid=$_SESSION['tid'];
		$this->view->amt=$_SESSION['amt'];
   	}
}