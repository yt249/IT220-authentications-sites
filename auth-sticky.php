<?php
session_set_cookie_params (0, "/~yt249/download/"); 
session_start(); 

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set('display_errors' , 1);

include (  "myfunctions.php"    ) ;

//----------  gatekeeper -------------
if(  !isset($_SESSION["captchaPass"]) )
	{
		echo "<br> Did NOT pass captcha test, taking you back!" ;
		header ( "refresh: 2 ; url=captcha-form.html " ); 
		exit();
	}
	
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


if(    isset( $_GET["ucid"] )    )
{
	$flag = true;

	$ucid	 = safe("ucid");
	$pass 	 = safe("pass");
	$amount  = safe("amount");
	$delay   = safe("delay");
	
	if(!$flag)
	{
		echo"<br> Bad input, enter the value again"; 
		header ( "refresh: $delay ; url=auth-sticky.php " );
		exit();
	}
	
	echo "<br>Good input. Continue on.<br>";
	
	// -------- authenticate with redirect --------
	if ( ! authenticate ( $ucid, $pass ) ) 
		{ 
			echo "<br><br>not auth. Being redirected back to the form." ; 
			header ( "refresh: $delay ; url=auth-sticky.php " );
			exit();
		}
	else 
		{
			echo "<br><br>It was authenticated. Going to the next step(pin)!" ; 
			header ( "refresh: $delay ; url=pin1.php " ); 
			exit();
		}
}

?>

<form  action="auth-sticky.php" >

<input  type=text   name="ucid"  autocomplete=off   > ucid 	<br><br>
<input  type=text   name="pass"  autocomplete=off   > pass 	<br><br>
<input  type=text   name="amount"  autocomplete=off > amount <br><br>
<input  type=text   name="delay"  autocomplete=off   > seconds of delay	<br><br>

<input  type=submit value="submit"  >

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