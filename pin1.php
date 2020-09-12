<?php
session_start();

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set('display_errors' , 1);

include (  "myfunctions.php"    ) ;

// ---------- gatekeepers -------------
if(  !isset($_SESSION["captchaPass"]) )
	{
		echo "<br> Did NOT pass captcha test, taking you back back!" ;
		header ( "refresh: 2 ; url=captcha-html.html " ); 
		exit();
	}

if(	 !isset($_SESSION["logged"])  )
	{
		echo "<br> Did NOT pass credentail test, taking you back!" ;
		header ( "refresh: 2 ; url=auth-sticky.php " ); 
		exit();
	}
echo "<h3>You have been admitted to pin handler </h3>" ;


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



// ------- making a random pin --------
$pin = mt_rand(1000, 9999);
echo "<br>pin is $pin<br>";
$_SESSION["pin"] = $pin;

$to = "yt249@njit.edu";
$sub = "pin from php file";
$msg = $pin;

// ------- mailing the pin --------
mail ($to, $sub, $msg);

?>

<form action="pin2.php">
<input type = text name="pin" > Enter mailed pin<br><br><br>


<input type = submit value="submit" > 
</form>

<style>
#number, #account, #amount	{display: none;}
form {
	margin: auto  ; 
	border: 2px dashed blue ; 
	padding:20px; 
	width:500px; 
	background: #f9e6ff;
	}
</style>


