<?php
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set('display_errors' , 1);

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


$captcha = safe("captcha"); 
$actualcaptcha = $_SESSION["captcha"];
$delay = $_GET["delay"];

if ($captcha == $actualcaptcha) 
{ 
	echo "<br>Captcha is Correct!" ;
	$_SESSION["captchaPass"] = true;
	header ( "refresh: $delay ; url=auth-sticky.php " );
	exit();
} 
else
{ 
	echo "Captcha is Wrong! Try new captcha."   ;
	header ( "refresh: $delay ; url=captcha-form.html " );
	exit();
}


?>