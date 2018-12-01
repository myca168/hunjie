<?php

// PHP script to allow periodic cPanel backups automatically, optionally to a remote FTP server.
// This script contains passwords.  KEEP ACCESS TO THIS FILE SECURE! (place it in your home dir, not /www/)

// ********* THE FOLLOWING ITEMS NEED TO BE CONFIGURED *********

// Info required for cPanel access
$cpuser = "myca165"; // Username used to login to CPanel
$cppass = "Me610404"; // Password used to login to CPanel
$domain = "myca168.com"; // Domain name where CPanel is run
$skin = "x3"; // Set to cPanel skin you use (script won't work if it doesn't match). Most people run the default x theme


// Notification information
$notifyemail = "manager@myca168.com"; // Email address to send results

// Secure or non-secure mode
$secure = 1; // Set to 1 for SSL (requires SSL support), otherwise will use standard HTTP

// Set to 1 to have web page result appear in your cron log
$debug = 0;

// *********** NO CONFIGURATION ITEMS BELOW THIS LINE *********

if ($secure) {
   $url = "ssl://".$domain;
      $port = 2083;
      } else {
         $url = $domain;
	    $port = 2082;
	    }

	    $socket = fsockopen($url,$port);
	    if (!$socket) { echo "Failed to open socket connection… Bailing out!\n"; exit; }

	    // Encode authentication string
	    $authstr = $cpuser.":".$cppass;
	    $pass = base64_encode($authstr);

	    $params = "dest=homedir&email=$notifyemail&server=&user=&pass=&port=&rdir=";

	    // Make POST to cPanel
	    fputs($socket,"POST /frontend/".$skin."/backup/dofullbackup.html?".$params." HTTP/1.0\r\n");
	    fputs($socket,"Host: $domain\r\n");
	    fputs($socket,"Authorization: Basic $pass\r\n");
	    fputs($socket,"Connection: Close\r\n");
	    fputs($socket,"\r\n");

	    // Grab response even if we don't do anything with it.
	    while (!feof($socket)) {
	      $response = fgets($socket,4096);
	        if ($debug) echo $response;
		}

		fclose($socket);
		
?>

