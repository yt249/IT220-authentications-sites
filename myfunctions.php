<?php

// 1. function replace $_GET("ucid") with safe("ucid") ---------
function safe( $name )
	{
		global $flag;
	
		$v    = $_GET[$name];	
		$v    = trim($v);  
		
		//ucid
		if( $name == "ucid" )
		{
			$count1 = preg_match('/^[a-z]{2,5}[0-9]{0,4}$/i', $v, $match);
			if($count1 == 0)
			{
				$flag = false;
				echo "<br>Illegal ucid format.<br>";
				return $v;
			}
		
		}
		
		//pass
		if( $name == "pass")
		{
			$count2 = preg_match('/^[a-zA-Z0-9\?\*]{3,5}$/i', $v, $match);
			if($count2 == 0)
			{
				$flag = false;
				echo "<br>Illegal password format.<br>";
				return $v;
			}
		}
		
		//amount 
		if( $name == "amount")
		{
			$count3 = preg_match('/^\+?\-?[1-9]{1}\d*$|^\+?\-?0$|^\+?\-?[1-9]*\.{1}\d+$|^\+?\-?[0]{1,2}\.{1}\d+$/i', $v, $match);
			if($count3 == 0)
			{
				$flag = false;
				echo "<br>Illegal amount format.<br>";
				return $v;
			}
		}
		
		return $v;
		
		
	}
	
// 2. authenticate function --------
function authenticate ( $ucid, $pass) {

	global $db;
	//  --- auth ucid & pass --- 
	$s = " select * from OneUser where ucid='$ucid' ";
	( $t = mysqli_query($db, $s) ) or die (mysql_error($db) ); 
	$num = mysqli_num_rows( $t ); //number of rows retreat(1 or 0 becasue ucid is a primary key
	if ( $num == 1 ) 
	{  
		$r = mysqli_fetch_array($t, MYSQL_ASSOC);
		$hash = $r["hash"];
		if(password_verify($pass, $hash))
		{
			$_SESSION["logged"] = true;
			$_SESSION["ucid"] = $ucid;
			echo "<br>Checked hashing: password is valid!";
			return true ;  
		}
		echo "<br>Checked hashing: password is UN-valid!";	
		return false;
	}
	echo "<br>wrong password or ucid!";
	return false;
}

// 3. retrieval function ----------
function retrieval($ucid, $number){

	global $db;
	
	$s1 = "select * from OneAccount where ucid = '$ucid' ";
	( $t1 = mysqli_query($db, $s1))  or die (mysql_error($db) );
	
	while($r = mysqli_fetch_array($t1, MYSQLI_ASSOC))
	{
		$account = $r["account"];
		$balance = $r["balance"];
		$recent = $r["recent"];
		echo "<hr> <strong>$ucid  account:$account   balance: $$balance   $recent</strong><br><br>";
		
		$s2 = "select * from OneTransaction where ucid = '$ucid' and account = '$account' limit $number";
		( $t2 = mysqli_query($db, $s2))  or die (mysql_error($db) );
		
		while($row = mysqli_fetch_array($t2, MYSQLI_ASSOC)){
			$amount = $row["amount"];
			$timestamp = $row["timestamp"];
			$mail = $row["mail"];
			echo "<i>$$amount $timestamp  mail copy: '$mail' </i><br>";
		}
	}
	echo "<hr>";
}

//4. clear function ----------
function clear($ucid, $account){
	
	global $db;
		
	$s1 = "delete from OneTransaction where ucid = '$ucid' and account = '$account' ";
	mysqli_query($db, $s1)  or die (mysqli_error($db)) ;
	
	$s2 = "update OneAccount set balance = 0.00 , recent = '0000-01-01 00:00:00' where ucid = '$ucid' and account = '$account' ";
	mysqli_query($db, $s2)  or die (mysqli_error($db)) ;
	
}


//5. transact function ---------
function transact($ucid, $account, $amount){

	global $db;
	
	$s3 = "update OneAccount set balance = balance+'$amount', recent = NOW() where ucid = '$ucid' and account = '$account' and balance + '$amount' >= 0.00 ";
	$t = (mysqli_query($db, $s3))  or die (mysqli_error($db)) ;
	
	if ( mysqli_affected_rows($db) == 0){
		echo "overdraft rejected" ;
	}
	else
	{
		$s4 = "insert into OneTransaction values('$ucid', '$account', '$amount', NOW(), 'N')" ;
		($t = mysqli_query($db, $s4) ) or die (mysqli_error($db)) ;
		echo "Inserted $$amount into account $account for $ucid";
	}
}

?>














