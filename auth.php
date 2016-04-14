<?php
require_once("conf/constants.php");

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'hack123';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
$sql = "SELECT pwd FROM user WHERE uname='".$_POST['uname']."'";

mysql_select_db('shrusti_pms');
$retval = mysql_query( $sql, $conn );

if(! $retval )
{
  die('Could not get data: ' . mysql_error());
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