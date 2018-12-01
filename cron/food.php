<?php
require_once 'init168.php';

$domain = Model_Site::getRow ( Model_Site::SITE_DOMAIN );
		$site = $domain->detail;
		$sales = Model_Site::getRow ( Model_Site::SITE_SALES )->detail;
		$email_from = Model_Site::EMAIL_ADMIN;
		$config = array ('auth' => 'login', 'username' =>Model_Site::EMAIL_LOGIN, 'password' =>Model_Site::EMAIL_PASSWORD);
		
		$transport = new Zend_Mail_Transport_Smtp (Model_Site::EMAIL_SERVER, $config );
		
		// Set From & Reply-To address and name for all emails to send.
		Zend_Mail::setDefaultFrom ( $email_from );
		Zend_Mail::setDefaultReplyTo ( $sales );


        // Loop through messages, note: set cron job to :00:01
        $cps=Model_FoodCoupon::getAllCoupons();       
		
		if ($cps ) {
			foreach ( $cps as $cp ) {
				
				$diff = (strtotime ( $cp->end_date ) - strtotime ( 'now' )); 
				if ($diff < 0 ) {
				 	if (file_exists("upload_img/food/coupons/$cp->id".'.jpg')){
 						unlink("upload_img/food/coupons/$cp->id".'.jpg');
 					}

				}
			}
        }
        
         $firms=Model_FoodFlash::getAll(); 
         
         if ($firms ) {
			foreach ( $firms as $firm ) {
				
				$time = (strtotime ( $firm->end_date ) - strtotime ( 'now' )); 
				if ($time < 0 ) {
				   if (file_exists("upload_img/food/firms/$firm->id".'.jpg')){
 					   unlink("upload_img/food/firms/$firm->id".'.jpg');
 					}
				}
			}
        }
					// Final comfirmation
                    $mail = new Zend_Mail ( 'UTF-8' );
					
					$mail->addTo ('webfirm.ca@gmail.com');
                                      
                                  	
					$mail->setSubject ( "Cron Alert Jobs Done !" );

                                        $msg=date('Y-m-d H:i:s');
					
					$mail->setBodyText ( $msg );
				//	$mail->send ( $transport );

                                      try {
                                         $mail->send($transport);
                                        } catch(Exception $e) {
                                          echo 'Email Address is incorrect!';
                                        }
// Reset defaults
Zend_Mail::clearDefaultFrom ();
Zend_Mail::clearDefaultReplyTo ();

