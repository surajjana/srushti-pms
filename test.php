<?php  
	require_once("conf/constants.php");

	$activity_code = '16/SA/00001';
	$arr = explode("/",$activity_code);
	$val = (int)$arr[2];
	$val += 1;
	$mnth = date("m");
	if((int)$mnth == 4){
		$res = (string)((int)date("y") + 1).'/SA/';
	}else{
		$res = (string)date("y").'/SA/';
	}
	if($val<10){
		$res .= '0000'.(string)$val;
	}elseif($val>9 && $val<100){
		$res .= '000'.(string)$val;
	}elseif($val>99 && $val<1000){
		$res .= '00'.(string)$val;
	}elseif($val>999 && $val<10000){
		$res .= '0'.(string)$val;
	}else{
		$res .= (string)$val;
	}
	$activity_id = $res;

	echo $activity_id;

?>