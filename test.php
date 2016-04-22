<?php  
	require_once("conf/constants.php");

	$conn = mysql_connect(HOST,USER,PASSWORD);

	if(! $conn )
	{
	  die('Could not connect: ' . mysql_error());
	}

	mysql_select_db(DB);

	$sql = "select email from user where rights=3";

	$retval = mysql_query( $sql, $conn );

	if(! $retval )
	{
	  die('Could not get data: ' . mysql_error());
	}

?>