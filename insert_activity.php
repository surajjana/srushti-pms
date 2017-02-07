<?php  
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require_once("conf/constants.php");

session_start();

$conn = mysql_connect(HOST, USER, PASSWORD);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db(DB);

$client_id = $_POST["client_id"];
$fromDate = $_POST["fromDate"];
$toDate = $_POST["toDate"];
$activity_grp = $_POST["activity_grp"];
$name = $_POST["activity_name"];
$venue = $_POST["venue"];
$remarks = $_POST["remarks"];


$sql = "SELECT activity_id FROM activity_log ORDER BY activity_id DESC LIMIT 1";

$retval = mysql_query( $sql, $conn );

if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$row = mysql_fetch_array($retval, MYSQL_ASSOC);
$activity_code = $row["activity_id"];
$arr = explode("/",$activity_code);
$val = (int)$arr[2];
$val += 1;
//$res = (string)date("y").'/CBS/';
$res = '16/CBS/';
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

$sql_insert = "insert into activity_log values('".$activity_id."','".$client_id."','".$fromDate."','".$toDate.
			  "','".$activity_grp."','".$name."','".$venue."','".$remarks."','".$_SESSION["pms_user"].
			  "','".(string)time()."','','',0)";

$retval = mysql_query( $sql_insert, $conn );

mysql_close();

if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}else{

/*echo "Client Added!!";*/


echo '<center><h2>Activity Log Sheet Inserted!!</h2><br /><a href="activity.php">Click Here</a></center>';
}
?>