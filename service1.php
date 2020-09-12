<?php
session_start();

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set('display_errors' , 1);

include (  "myfunctions.php"    ) ;

// ----------- gatekeepers ------------
if(  !isset($_SESSION["captchaPass"]) )
	{
		echo "<br> Did NOT pass captcha test, taking you back back!" ;
		header ( "refresh: 2 ; url=captcha-form.html " ); 
		exit();
	}

if(	 !isset($_SESSION["logged"])  )
	{
		echo "<br> Did NOT pass credentail test, taking you back!" ;
		header ( "refresh: 2 ; url=auth-sticky.php " ); 
		exit();
	}

if( ! $_SESSION["pinpass"])
	{
		echo "<br> Did NOT pass pin test, taking you back!" ;
		header ( "refresh: 2 ; url=pin1.php " ); 
		exit();
	}
	


?>
<form action="service2.php">
<input type=radio name="choice" id="Initial" 	value="Initial" checked=checked>  Chose <br>
<input type=radio name="choice" id="List" 		value="List">  List <br>
<input type=radio name="choice" id="Clear" 		value="Clear"> Clear <br>
<input type=radio name="choice" id="Perform" 	value="Perform"> Perform <br>


<br>
<div id="number">  <input	type=text 	name="number" 	autocomplete="off" >Enter number of transactions to see </div>
<div id="account"> <input	type=text 	name="account"	autocomplete="off" >Enter account for transaction </div>
<div id="amount">  <input	type=text 	name="amount" 	autocomplete="off" >Enter amount of transaction</div>
<br>
<input  type=submit value = "Comfirm">	
</form >

<script>
var ptrList = document.getElementById("List")
ptrList.addEventListener( "change" , F )

var ptrClear = document.getElementById("Clear")
ptrClear.addEventListener( "change" , F )

var ptrPerform = document.getElementById("Perform")
ptrPerform.addEventListener( "change" , F )

var ptrInitial = document.getElementById("Initial")
ptrInitial.addEventListener( "change" , F )

var ptrNumber  = document.getElementById("number")
var ptrAccount = document.getElementById("account")
var ptrAmount  = document.getElementById("amount")

function F() {

	ptrNumber.style.display  = "none"
	ptrAccount.style.display = "none"
	ptrAmount.style.display  = "none"

	if ( this.value == "List" ) {
		ptrNumber.style.display  = "block"
	}

	if ( this.value == "Perform" ) {
		ptrAccount.style.display = "block"
		ptrAmount.style.display  = "block"
	}
	if ( this.value == "Clear" ) {
		ptrAccount.style.display = "block"
	}
	if ( this.value == "Initial" ) {
		ptrNumber.style.display  = "none"
		ptrAccount.style.display = "none"
		ptrAmount.style.display  = "none"
	}

}

</script>

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





