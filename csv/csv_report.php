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
	fputcsv($output, array('Column 1', 'Column 2', 'Column 3'));

	// fetch the data
	mysql_connect(HOST, USER, PASSWORD);
	mysql_select_db(DB);
	$rows = mysql_query('SELECT uname,email,rights FROM user');

	// loop over the rows, outputting them
	while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);
?>