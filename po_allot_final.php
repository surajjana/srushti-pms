<?php 
	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	require_once("conf/constants.php");
	session_start();
	if(strcmp($_SESSION["pms_user"],"NA") == 0 || strlen($_SESSION["pms_user"]) == 0 ){
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
	$conn = mysql_connect(HOST, USER, PASSWORD);
	if(! $conn )
	{
	  die('Could not connect: ' . mysql_error());
	}

	mysql_select_db(DB);

	$activity_id = $_POST['activity_id'];
	$vendor_id = $_POST['vendor_id'];
	$vendor_grp = $_POST['vendor_grp'];
	$po_amount = $_POST['po_amount'];
	$po_remarks = $_POST['po_remarks'];
	$activity_status = 0;

	$sql = "select toDate from activity_log where activity_id='".$activity_id."'";

	$retval = mysql_query($sql, $conn);

	if(! $retval )
	{
	  die('Could not get data: ' . mysql_error());
	}

	$row = mysql_fetch_array($retval, MYSQL_ASSOC);

	$date1=date('d/m/Y');
	$tempArr=explode('/', '16/04/2016');
	$date2 = date("d-m-Y", mktime(0, 0, 0, $tempArr[1], $tempArr[0], $tempArr[2]));

	$date1 = str_replace('/', '-', $date1);

	if(strtotime($date1) > strtotime($date2)){
		$activity_status = 0;
	}else{
		$activity_status = 1;
	}

	$sql = "insert into po_log(po_id,activity_id,vendor_id,vendor_grp,po_amount,po_balance,po_remarks,added_by,time_added,approved_by,time_approved,modified_by,time_modified,approval_status,activity_status) values('','".
		    $activity_id."','".$vendor_id."','".$vendor_grp."','".$po_amount."','".$po_amount."','".$po_remarks."','".$_SESSION["pms_user"]."','".(string)time()."','','','','',0,".$activity_status.")";

	$retval = mysql_query($sql, $conn);

	if(! $retval )
	{
	  die('Could not get data: ' . mysql_error());
	}else{
		echo '<center><h2>New PO Alloted</h2><br /><a href="transactions.php">Click Here</a></center>';
	}

?>