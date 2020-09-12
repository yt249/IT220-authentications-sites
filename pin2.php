<?php
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set('display_errors' , 1);

// ------- check if logged in and pass captcha-----------
if(  !isset($_SESSION["captchaPass"]) )
	{
		echo "<br> Did NOT pass captcha test, taking you back!" ;
		header ( "refresh: 2 ; url=captcha-form.html " ); 
		exit();
	}

if(	 !isset($_SESSION["logged"])  )
	{
		echo "<br> Please login again." ;
		header ( "refresh: 2 ; url=auth-sticky.php " ); 
		exit();
	}

include (  "myfunctions.php"    ) ;

// -------- connects to database -------- 
include (  "account.php"    ) ;
$db = mysqli_connect($hostname, $username, $password, $project);
if (mysqli_connect_errno())
  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
  }
print "Successfully connected to MySQL.<br><br><br>";
mysqli_select_db( $db, $project ); 


// ---------- comparing the pins -----------
$pin = safe("pin");
	
if(	 $_SESSION["pin"] == $pin)
	{
		echo "<br> pin match." ;
		$_SESSION["pinpass"] = true;
		header ( "refresh: 2 ; url=service1.php " );
		exit();
		
	}else{
	
		echo "<br>pin UN-match! Enter pin again." ;
		header ( "refresh: 2 ; url=pin1.php " ); 
		exit();
	}
		


?>