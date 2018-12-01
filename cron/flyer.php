<?php

require_once 'init168.php';

	$current=ROOT."/public/upload_img/coupon/flyers/current/";
	$next=ROOT."/public/upload_img/coupon/flyers/next/";
	Caclass_Files::rrmdir($current);
	Caclass_Files::copy($next,$current);
	Caclass_Files::rrmdir($next);
	 if (!is_dir(ROOT.'/public/upload_img/coupon/flyers/next')) {
 			@mkdir(ROOT.'/public/upload_img/coupon/flyers/next');
 	 }
		
	$params=new Model_FlyerParams();
	$row=$params->getRow();
	$params->reset($row->end_date_cf,7);

 $msg="Flyers dates were reset on :".date('Y-m-d H:i:s');

var_dump($msg);
