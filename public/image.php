<?php 
	
	session_start();

	$rand='';
	for($i=0; $i<4; $i++){
	    $rand.= dechex(rand(1,15));
	}
	$_SESSION['check_pic']=$rand;
	$im = imagecreatetruecolor(50,18);
	$te=imagecolorallocate($im,255,255,255);
	imagestring($im,rand(5,5),rand(10,10),3,$rand,$te);
	header("Content-type:image/jpeg");
	imagejpeg($im);
?>