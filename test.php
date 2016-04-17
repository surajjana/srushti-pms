<?php  
	require_once("conf/constants.php");
	$conn = mysql_connect(HOST, USER, PASSWORD);
    if(! $conn )
    {
      die('Could not connect: ' . mysql_error());
    }

    mysql_select_db(DB);

    $sql = "SELECT vendor_id FROM vendor_log ORDER BY vendor_id DESC LIMIT 1";

	$retval = mysql_query( $sql, $conn );

	if(! $retval )
	{
	  die('Could not get data: ' . mysql_error());
	}

	$row = mysql_fetch_array($retval, MYSQL_ASSOC);
	$vendor_code = $row["vendor_id"];
	$arr = explode("VL11",$vendor_code);
	/*$val = (int)$arr[1];
	$val += 1;
	$res = 'VL11';
	if($val<10){
		$res .= '00'.(string)$val;
	}elseif($val>9 && $val<100){
		$res .= '0'.(string)$val;
	}else{
		$res .= (string)$val;
	}
	$vendor_id = $res;*/
	var_dump($arr);

?>
