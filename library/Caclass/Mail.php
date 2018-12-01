<?php 

class Caclass_Mail extends Zend_Mail {
	
    protected $_settings = array('returnPath'=>'admin@caclass.com','fromEmail'=>'ads@caclass.com','replyEmail'=>'ads@caclass.com');
   
 	public function __construct() {
        parent::__construct();
    }
   
 	public function addSubject($subject = 'Notification') {
        $this->setSubject($subject);
    }
    
	public function setSender($email) {
        $this->setFrom($email);
    }
    
    // $this->addTo($toEmail, $toName);
    public function sendTo($context, $addresses = null) {
       if ( is_string($addresses) ) {
           $this->addTo($addresses);
        } else if (is_array($addresses) ) {
                 foreach ( $addresses as $k=>$address ) {$this->addTo($address);}
               }
       
        $this->setBodyText($context);
       
        $this->send();
    }
    
	public static function smtp($email_from,$email_to,$subject,$body) {

          $config = array ('auth' => 'login', 'username' => Model_Site::EMAIL_LOGIN, 'password' =>Model_Site::EMAIL_PASSWORD);

          $server=Model_Site::EMAIL_SERVER;

 	  $transport = new Zend_Mail_Transport_Smtp ($server, $config );

        	// Set From & Reply-To address and name for all emails to send.

               // $email_from="william@myca168.com";


		Zend_Mail::setDefaultFrom ($email_from);
		Zend_Mail::setDefaultReplyTo ($email_from);
		
		$mail = new Zend_Mail ( 'UTF-8' );
					
					$mail->addTo ( $email_to);
					
					$mail->setSubject ( $subject );
					
					$mail->setBodyText ( $body );

         
                                     try {
                                         $mail->send($transport);
                                        } catch(Exception $e) {
                                           echo 'Email Address is incorrect!';
                                         //   die ($e);
                                        }

				//	$mail->send ( $transport );

    }
    
}