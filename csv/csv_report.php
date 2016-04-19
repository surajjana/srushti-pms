<?php  
	require_once("../conf/constants.php");
	$activity_id = $_GET["activity_id"];
	$header = 'Content-Disposition: attachment; filename='.str_replace("/","_",$activity_id).'.csv';
	// output headers so that the file is downloaded rather than displayed
	header('Content-Type: text/csv; charset=utf-8');
	/*header('Content-Disposition: attachment; filename=data.csv');*/
	header($header);

	// create a file pointer connected to the output stream
	$output = fopen('php://output', 'w');

	// output the column headings
	fputcsv($output, array('PO No.', 'Vendor ID', 'Vendor', 'PO Amount', 'PO Balance'));

	// fetch the data
	mysql_connect(HOST, USER, PASSWORD);
	mysql_select_db(DB);
	$rows = mysql_query("SELECT * FROM po_log WHERE activity_id='".$activity_id."'");

	// loop over the rows, outputting them
	while ($row = mysql_fetch_assoc($rows)){
		$sql_vendor = "select name from vendor_log where vendor_id='".$row["vendor_id"]."'";

        $retval_vendor = mysql_query( $sql_vendor);

        if(! $retval_vendor )
        {
          die('Could not get data: ' . mysql_error());
        }

        $row_vendor = mysql_fetch_array($retval_vendor, MYSQL_ASSOC);

        fputcsv($output, array($row["po_id"],$row["vendor_id"],$row_vendor["name"],$row["po_amount"],$row["po_balance"]));
	}

	$sql = "SELECT sum( po_amount ) , sum( po_balance )FROM po_log WHERE activity_id = '".$activity_id."'";

    $retval = mysql_query( $sql );

    if(! $retval )
    {
      die('Could not get data: ' . mysql_error());
    }

    $row = mysql_fetch_array($retval, MYSQL_ASSOC);
    fputcsv($output, array('','','Total', $row["sum( po_amount )"],$row["sum( po_balance )"]));
?>