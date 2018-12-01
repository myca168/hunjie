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


                // Loop through messages
		$ads_loc = Model_Ads::getAllAds ();
		
		if ($ads_loc ) {
			foreach ( $ads_loc as $loc ) {
				
				$days = (strtotime ( $loc->end_date ) - strtotime ( 'now' )) / 86400; //each day=86400 seconds
				if ($days < 20 && $days > - 3) {
					
				$customer=Model_Customer::getCustomerById($loc->customer_id);
					
					$mail = new Zend_Mail ( 'UTF-8' );
					$mail->addTo ( $sales);
					$mail->setSubject ( "重要广告到期提示 =>客户电话：{$customer->tel}" );
	 
	 	$msg="客户 {$customer->name} 的广告快到期了，以下是客户的信息：".
	 	"\n\n 客户电邮：".$customer->email.
	 	"\n\n 客户名称：".$customer->name.
	 	"\n\n 广告位：".Model_Location::getLocationById($loc->location_id)->desc.
	 	"\n\n Web Master";
					
					$mail->setBodyText ( $msg );

                                       try {
                                         $mail->send($transport);
                                        } catch(Exception $e) {
                                          echo 'Email Address is incorrect!';
                                        }
                                          

				//	$mail->send ( $transport );

				}
			}
                }



		
		// Loop through messages
		$ads = Model_YpCustomer::getAllAds ();
		
		if ($ads) {
			foreach ( $ads as $yp ) {
				
				$days = (strtotime ( $yp->end_date ) - strtotime ( 'now' )) / 86400; //each day=86400 seconds
				if ($days < 10 && $days > - 3) {
					$mail = new Zend_Mail ( 'UTF-8' );
					
					$user = Model_User::getUserById ( $yp->login );
					$email = $user->email;
					$mail->addTo ( $email);
					$mail->addTo ( $sales);
					
					$mail->setSubject ( "您在  {$site} 黄页中的广告快到期了!" );
	 
	 	$msg="您好 {$user->nickname}，您的广告快到期了，请使用管理中心编辑或延期您的广告，过期的信息将被删除。 谢
					谢！\n\n Webmaster";
					
					$mail->setBodyText ( $msg );
				//	$mail->send ( $transport );

                                       try {
                                         $mail->send($transport);
                                        } catch(Exception $e) {
                                          echo 'Email Address is incorrect!';
                                        }
                             

				}
			}
		
		}
		

		

$csAds=Model_ClassifiedsCustomer::getAllAds();

if ($csAds) {
	foreach ($csAds as $cs) {
		$days=(strtotime($cs->end_date)-strtotime('now'))/86400;   //each day=86400 seconds
		if ($days<10 && $days > - 3) {

		$mail = new Zend_Mail ( 'UTF-8' );
					
					$user = Model_User::getUserById ( $cs->login );
					$email = $user->email;
					$mail->addTo ( $email);
					$mail->addTo ( $sales);
					
					$mail->setSubject ( "您在  {$site} 二手栏目中的广告快到期了!" );
	 
	 	$msg="您好 {$user->nickname}，您的广告快到期了，您的广告快到期了，请使用管理中心编辑或延期您的广告，过期的信息将被删除。 谢谢！\n\n Webmaster";
					
					$mail->setBodyText ( $msg );
				//	$mail->send ( $transport );


                                       try {
                                         $mail->send($transport);
                                        } catch(Exception $e) {
                                          echo 'Email Address is incorrect!';
                                        }
                             

		}
	}
}

$carAds=Model_CarAds::getAllAds();

if ($carAds) {
	foreach ($carAds as $car) {
		$days=(strtotime($car->end_date)-strtotime('now'))/86400;   //each day=86400 seconds
		if ($days<10 && $days > - 3) {

					$mail = new Zend_Mail ( 'UTF-8' );
					
					$user = Model_User::getUserById ( $car->login );
					$email = $user->email;
					$mail->addTo ( $email);
					$mail->addTo ( $sales);
					
					$mail->setSubject ( "您在  {$site} 汽车栏目中的广告快到期了!" );
	 
	 	$msg="您好 {$user->nickname}，您的广告快到期了，请使用管理中心编辑或延期您的广告，过期的信息将被删除。 谢谢！\n\n Webmaster";
					
					$mail->setBodyText ( $msg );
				//	$mail->send ( $transport );

                                      try {
                                         $mail->send($transport);
                                        } catch(Exception $e) {
                                          echo 'Email Address is incorrect!';
                                        }
                             
		}
	}
}


$jaAds=Model_JobAgent::getAllAds();

if ($jaAds) {
	foreach ($jaAds as $ja) {
		$days=(strtotime($ja->end_date)-strtotime('now'))/86400;   //each day=86400 seconds
		if ($days<10 && $days > - 3) {

					$mail = new Zend_Mail ( 'UTF-8' );
					
					$user = Model_User::getUserById ( $ja->login );
					$email = $user->email;
					$mail->addTo ( $email);
					$mail->addTo ( $sales );
					
					$mail->setSubject ( "您在  {$site} 工作中介栏目的广告快到期了!" );
	 
	 	$msg="您好 {$user->nickname}，您的广告快到期了，请使用管理中心编辑或延期您的广告，过期的信息将被删除。 谢谢！\n\n Webmaster";
					
					$mail->setBodyText ( $msg );
				//	$mail->send ( $transport );

                                      try {
                                         $mail->send($transport);
                                        } catch(Exception $e) {
                                          echo 'Email Address is incorrect!';
                                        }
                             	}
}
}

$jobAds=Model_JobEmployer::getAllAds();

if ($jobAds) {
	foreach ($jobAds as $job) {
		$days=(strtotime($job->end_date)-strtotime('now'))/86400;   //each day=86400 seconds
		if ($days<10 && $days > - 3) {

			$mail = new Zend_Mail ( 'UTF-8' );
					
					$user = Model_User::getUserById ( $job->login );
					$email = $user->email;
					$mail->addTo ( $email);
					$mail->addTo ( $sales);
					
					$mail->setSubject ( "您在  {$site} 工作招聘的广告快到期了!" );
	 
	 	$msg="您好 {$user->nickname}，您的广告快到期了，请使用管理中心编辑或延期您的广告，过期的信息将被删除。 谢谢！\n\n Webmaster";
					
					$mail->setBodyText ( $msg );
				//	$mail->send ( $transport );

                                     try {
                                         $mail->send($transport);
                                        } catch(Exception $e) {
                                          echo 'Email Address is incorrect!';
                                        }
                             	}
	}
}

$foodAds=Model_FoodRes::getAllAds();

if ($foodAds) {
	foreach ($foodAds as $food) {
		
		$days=(strtotime($food->end_date)-strtotime('now'))/86400;   //each day=86400 seconds
		if ($days<10 && $days > - 3) {

					$mail = new Zend_Mail ( 'UTF-8' );
					
					$user = Model_User::getUserById ( $food->login );
					$email = $user->email;
					$mail->addTo ( $email);
					$mail->addTo ( $sales);
					
					$mail->setSubject ( "您在  {$site} 美食栏目的广告快到期了!" );
	 
	 	$msg="您好 {$user->nickname}，您的广告快到期了，请使用管理中心编辑或延期您的广告，过期的信息将被删除。 谢谢！\n\n Webmaster";
					
					$mail->setBodyText ( $msg );
				//	$mail->send ( $transport );

                                      try {
                                         $mail->send($transport);
                                        } catch(Exception $e) {
                                          echo 'Email Address is incorrect!';
                                        }
                             	}
	}
}

$owners=Model_HouseOwner::getAllAds();

if ($owners) {
	foreach ($owners as $owner) {
		$days=(strtotime($owner->end_date)-strtotime('now'))/86400;   //each day=86400 seconds
		if ($days<10 && $days > - 3) {

					$mail = new Zend_Mail ( 'UTF-8' );
					
					$user = Model_User::getUserById ( $owner->login );
					$email = $user->email;
					$mail->addTo ( $email);
					$mail->addTo ( $sales );
					
					$mail->setSubject ( "您在  {$site} 房屋出租的广告快到期了!" );
	 
	 	$msg="您好 {$user->nickname}，您的广告快到期了，请使用管理中心编辑或延期您的广告，过期的信息将被删除。 谢谢！\n\n Webmaster";
					
					$mail->setBodyText ( $msg );
				//	$mail->send ( $transport );

                                       try {
                                         $mail->send($transport);
                                        } catch(Exception $e) {
                                          echo 'Email Address is incorrect!';
                                        }
                             
		}
	}
	}




$coms=Model_HouseCommerceTrans::getAllAds();

if ($coms) {
	foreach ($coms as $com) {
		$days=(strtotime($com->end_date)-strtotime('now'))/86400;   //each day=86400 seconds
		if ($days<10 && $days > - 3) {

					$mail = new Zend_Mail ( 'UTF-8' );
					
					$user = Model_User::getUserById ( $com->login );
					$email = $user->email;
					$mail->addTo ( $email);
					$mail->addTo ( $sales);
					
					$mail->setSubject ( "您在  {$site} 商业地产栏目中的广告快到期了!" );
	 
	 	$msg="您好 {$user->nickname}，您的广告快到期了，请使用管理中心编辑或延期您的广告，过期的信息将被删除。 谢谢！\n\n Webmaster";
					
					$mail->setBodyText ( $msg );
				//	$mail->send ( $transport );

                                      try {
                                         $mail->send($transport);
                                        } catch(Exception $e) {
                                          echo 'Email Address is incorrect!';
                                        }
                             	}
	}
}

$ha=Model_Agents::getAllAds();

if ($ha) {
	foreach ($ha as $hagent) {
		$days=(strtotime($hagent->end_date)-strtotime('now'))/86400;   //each day=86400 seconds
		if ($days<10 && $days > - 3) {

				    $mail = new Zend_Mail ( 'UTF-8' );
					
					$user = Model_User::getUserById ( $hagent->login );
					$email = $user->email;
					$mail->addTo ( $email);
					$mail->addTo ( $sales);
					
					$mail->setSubject ( "您在  {$site} 地产中介栏目的广告快到期了!" );
	 
	 	$msg="您好 {$user->nickname}，您的广告快到期了，请使用管理中心编辑或延期您的广告，过期的信息将被删除。 谢谢！\n\n Webmaster";
					
					$mail->setBodyText ( $msg );
				//	$mail->send ( $transport );

                                      try {
                                         $mail->send($transport);
                                        } catch(Exception $e) {
                                          echo 'Email Address is incorrect!';
                                        }
                             
		}
	}
}

$sellh=Model_HouseSell::getAllAds();

if ($sellh) {
	foreach ($sellh as $sale) {
		$days=(strtotime($sale->end_date)-strtotime('now'))/86400;   //each day=86400 seconds
		if ($days<10 && $days > - 3) {

					$mail = new Zend_Mail ( 'UTF-8' );
					
					$user = Model_User::getUserById ( $sale->login );
					$email = $user->email;
					$mail->addTo ( $email);
					$mail->addTo ( $sales);
					
					$mail->setSubject ( "您在  {$site} 售房栏目中的广告快到期了!" );
	 
	 	$msg="您好 {$user->nickname}，您的广告快到期了，请使用管理中心编辑或延期您的广告，过期的信息将被删除。 谢谢！\n\n Webmaster";
					
					$mail->setBodyText ( $msg );
				//	$mail->send ( $transport );

                                      try {
                                         $mail->send($transport);
                                        } catch(Exception $e) {
                                          echo 'Email Address is incorrect!';
                                        }
                             
		}
		
	}
}

$projects=Model_HouseProject::getAllAds();

if ($projects) {	
	foreach ($projects as $pro) {
		$days=(strtotime($pro->end_date)-strtotime('now'))/86400;   //each day=86400 seconds
		if ($days<10 && $days > - 3) {

					$mail = new Zend_Mail ( 'UTF-8' );
					
					$user = Model_User::getUserById ( $pro->login );
					$email = $user->email;
					$mail->addTo ( $email);
					$mail->addTo ( $sales);
					
					$mail->setSubject ( "您在  {$site} 地产新项目的广告快到期了!" );
	 
	 	$msg="您好 {$user->nickname}，您的广告快到期了，请使用管理中心编辑或延期您的广告，过期的信息将被删除。 谢谢！\n\n Webmaster";
					
					$mail->setBodyText ( $msg );
				//	$mail->send ( $transport );

                                      try {
                                         $mail->send($transport);
                                        } catch(Exception $e) {
                                          echo 'Email Address is incorrect!';
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

