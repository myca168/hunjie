<?php
class Model_Payment_Paypal
{
	public function __construct()
	{
		
		 define ( 'API_USERNAME', 'myca.inc_api1.gmail.com');
		 define ( 'API_PASSWORD', 'xxxxxxxxxxxxxxxxx');
		 define ( 'API_SIGNATURE', 'AFcWxV21C7fd0v3bYYYRCxxxxxxxAKWhdReiS9TUp4F3Q3Sb-dNUZjnc');
		 define ( 'API_ENDPOINT', 'https://api-3t.paypal.com/nvp' );
		 define ( 'API_SUBJECT', 'www.hunjie.ca' );

		 define ( 'USE_PROXY', FALSE );
		 define ( 'PROXY_HOST', '127.0.0.1' );
		 define ( 'PROXY_PORT', '808' );
		 define ( 'PAYPAL_URL', 'https://www.paypal.com/webscr&cmd=_express-checkout&token=' );
		 define ( 'VERSION', '84.0' );                
		

	}

	private function deformatNVP($nvpstr) {

		$intial = 0;
		$nvpArray = array ();

		while ( strlen ( $nvpstr ) ) {
			//postion of Key
			$keypos = strpos ( $nvpstr, '=' );
			//position of value
			$valuepos = strpos ( $nvpstr, '&' ) ? strpos ( $nvpstr, '&' ) : strlen ( $nvpstr );
				
			/*getting the Key and Value values and storing in a Associative Array*/
			$keyval = substr ( $nvpstr, $intial, $keypos );
			$valval = substr ( $nvpstr, $keypos + 1, $valuepos - $keypos - 1 );
			//decoding the respose
			$nvpArray [urldecode ( $keyval )] = urldecode ( $valval );
			$nvpstr = substr ( $nvpstr, $valuepos + 1, strlen ( $nvpstr ) );
		}
		return $nvpArray;
	}

	private function hash_call($methodName, $nvpStr) {

		$API_UserName = API_USERNAME;
		$API_Password = API_PASSWORD;
		$API_Signature = API_SIGNATURE;
		$API_Endpoint = API_ENDPOINT;
		//$SUBJECT = API_SUBJECT;
		$version = VERSION;

		//setting the curl parameters.
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $API_Endpoint );
		curl_setopt ( $ch, CURLOPT_VERBOSE, 1 );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_POST, 1 );
		if (USE_PROXY)
		curl_setopt ( $ch, CURLOPT_PROXY, PROXY_HOST . ":" . PROXY_PORT );

		//"&SUBJECT= ".urlencode ($SUBJECT) .
		//NVPRequest for submitting to server
		$nvpreq = "METHOD=" . urlencode ( $methodName ) . "&VERSION=" . urlencode ( $version ) . "&PWD=" . urlencode ( $API_Password ) . "&USER=" . urlencode ( $API_UserName ) . "&SIGNATURE=" . urlencode ( $API_Signature ) . $nvpStr;
		//setting the nvpreq as POST FIELD to curl
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $nvpreq );
		//getting response from server
		$response = curl_exec ( $ch );

		//converting NVPResponse to an Associative Array
		$nvpResArray = $this->deformatNVP ( $response );
		$nvpReqArray = $this->deformatNVP ( $nvpreq );

		return $nvpResArray;
	}

        //set paypal express payment
	public function setexpress($info)
	{
       		/**
		 * Get required parameters from the web form for the request
		 */
		$paymentType = urlencode ( 'Sale' ); // according to paypal api
		 $currency=Zend_Registry::get('config')->default->currency;
		 $currencyCode = urlencode ( $currency );
		
		$returnURL = urlencode ( $info ['return_url'] );
		$cancelURL = urlencode ( $info ['cancel_url'] );
		$price = urlencode ( $info ['price'] );				//price 
		$itemAmount = urlencode ( $info ['price'] );
		$tax = urlencode ( $info ['tax_amt'] );
		$total=urlencode ( $info ['total'] );
         	$login=urlencode ( $info['inv_id'] );			
		$recordId=urlencode ( $info ['inv_id'] );		//user login record id
             
                $qty=urlencode ( '1' );
                $pg=urlencode ('Billing');         //&LANDINGPAGE=$pg
                $sole=urlencode ('Sole');          //&SOLUTIONTYPE=$sole
                $note=urlencode( '1' );
                $desc=urlencode( 'Member Ads Invoice' );
    

		/* Construct the request string that will be sent to PayPal.
		 The variable $nvpstr contains all the variables and is a
		 name value pair string with & as a delimiter */

		$nvpstr = "&ReturnUrl=$returnURL&CANCELURL=$cancelURL&PAYMENTACTION=$paymentType";
		$nvpstr.=					
			"&L_PAYMENTREQUEST_0_NAME0=$desc
			&L_PAYMENTREQUEST_0_NUMBER0= $recordId
		 	&L_PAYMENTREQUEST_0_DESC0= UID($login) 
		 	&L_PAYMENTREQUEST_0_AMT0=$price  
		 	&L_PAYMENTREQUEST_0_QTY0=$qty  
		 	&PAYMENTREQUEST_0_ITEMAMT=$itemAmount  
		 	&PAYMENTREQUEST_0_TAXAMT=$tax   
		 	&PAYMENTREQUEST_0_AMT=$total
                     	&PAYMENTREQUEST_0_CURRENCYCODE=$currencyCode&ALLOWNOTE=$note";
		
		/* Make the API call to PayPal, using API signature.
		 The API response is stored in an associative array called $resArray */
		$resArray = $this->hash_call ("SetExpressCheckout", $nvpstr);
		return $resArray;
	}         

	//get paypal express payment details
	public function getexpress ( $token )
	{
		$token = urlencode(htmlspecialchars($token));

		$nvpstr="&TOKEN=$token";

		$resArray = $this->hash_call ("GetExpressCheckoutDetails", $nvpstr );
		return $resArray;
	}
	//Final express payment
	public function doexpress ( $token, $payerID, $paymentAmount )
	{
		$currencyCode = urlencode ( Zend_Registry::get('config')->default->currency);
		$paymentType = "Sale";


		$nvpstr = "&TOKEN=$token&PAYERID=$payerID&PAYMENTACTION=$paymentType&AMT=$paymentAmount&CURRENCYCODE=$currencyCode";
		/* Make the API call to PayPal, using API signature.*/
		
		return $this->hash_call ("DoExpressCheckoutPayment", $nvpstr );
		
	}
}