<?php  
	require_once("conf/constants.php");
	$conn = mysql_connect(HOST, USER, PASSWORD);
    if(! $conn )
    {
      die('Could not connect: ' . mysql_error());
    }

    mysql_select_db(DB);

    $sql = "SELECT sum( po_amount ) , sum( po_balance )FROM po_log WHERE activity_id = '".$activity_id."'";

    $retval = mysql_query( $sql, $conn );

    if(! $retval )
    {
      die('Could not get data: ' . mysql_error());
    }

    $row = mysql_fetch_array($retval, MYSQL_ASSOC);
	var_dump($row);

?>
