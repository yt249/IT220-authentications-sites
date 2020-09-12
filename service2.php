<?php
session_start();

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set('display_errors' , 1);

include (  "myfunctions.php"    ) ;

// ----------- gatekeepers ------------
if(	 !isset($_SESSION["logged"])  )
	{
		echo "<br> Please login from the beginning." ;
		header ( "refresh: 2 ; url=auth.html " ); 
		exit();
	}

if( ! $_SESSION["pinpass"])
	{
		echo "<br> Did NOT pass pin test, going back to pin page!" ;
		header ( "refresh: 2 ; url=pin1.php " ); 
		exit();
	}
	
// ---------- connect database -----------
include (  "account.php"    ) ;
$db = mysqli_connect($hostname, $username, $password, $project);
if (mysqli_connect_errno())
  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
  }
print "Successfully connected to MySQL.<br><br><br>";
mysqli_select_db( $db, $project ); 

// variables 
$choice	 =  safe("choice");
$ucid 	 = 	$_SESSION["ucid"];

// List -> Retrieval function
if ($choice == "List")
	{
		$number	 = safe("number");
		echo"<strong>This is $number transaction(s) in both $ucid's account: <br><br></strong>";
		retrieval($ucid, $number);
	}

// Clear -> clear function
if ($choice == "Clear")
	{
		$account = safe("account");
		echo "<strong>Clear function is executed: deleted all transactions for $ucid in account $account</strong>";
		clear($ucid, $account);
	}
	
// Perform -> transact function
if ($choice == "Perform")
	{	
		$flag = true;
		$account = 	safe("account");
		$amount	 = 	safe("amount");
		
		if($flag == false){
			echo "<br>Redirecting to the previous form.";
			header ( "refresh: 3 ; url=service1.php " );
			exit();
		}
		
		transact($ucid, $account, $amount);
	}

?>

<!-- back to service1.php -->
<a href="service1.php"> <br><br> Back to main menu(radio buttons) </a>


<!-- logging out -->
<a href="logout.php"> <br><br>logout </a>






















