<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require_once("conf/constants.php");

$conn = mysql_connect(HOST, USER, PASSWORD);
if(! $conn )
{
  die('1. Could not connect: ' . mysql_error());
}
$sql = "SELECT pwd FROM user WHERE uname='".$_POST['uname']."'";

mysql_select_db(DB);
$retval = mysql_query( $sql, $conn );

if(! $retval )
{
  die('2. Could not get data: ' . mysql_error());
}

$row = mysql_fetch_array($retval, MYSQL_ASSOC);
if($row['pwd']){
	if(strcmp($row['pwd'],$_POST['pwd']) == 0)
    {
    	session_start();
    	$_SESSION["pms_user"] = $_POST['uname'];
    	ob_start(); // ensures anything dumped out will be caught

		// do stuff here
		$url = DOMAIN.'home.php'; // this can be set based on whatever

		// clear out the output buffer
		while (ob_get_status()) 
		{
		    ob_end_clean();
		}

		// no redirect
		header( "Location: $url" );
    }else{
    	ob_start(); // ensures anything dumped out will be caught

		// do stuff here
		$url = DOMAIN.'invalid_login.php'; // this can be set based on whatever

		// clear out the output buffer
		while (ob_get_status()) 
		{
		    ob_end_clean();
		}

		// no redirect
		header( "Location: $url" );
    }
}else{
	ob_start(); // ensures anything dumped out will be caught

	// do stuff here
	$url = DOMAIN.'invalid_login.php'; // this can be set based on whatever

	// clear out the output buffer
	while (ob_get_status()) 
	{
	    ob_end_clean();
	}

	// no redirect
	header( "Location: $url" );
}
mysql_close($conn);

?>
