<?php
session_set_cookie_params (0, "/~yt249/download/", "web.njit.edu"); 
session_start();

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set('display_errors' , 1);

$sidvalue = session_id(); 
echo "<br>Your session id was: " . $sidvalue . "<br>";

$_SESSION = array();//Make $_SESSION  empty
session_destroy();//Terminate session on server
setcookie("PHPSESSID", "", time()-3600, "/~yt249/download/" ,"",0,0 ); 

echo "Your session is terminated."; 

?>