<?php  
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require_once("conf/constants.php");

session_start();

print_r($_POST);

/*$conn = mysql_connect(HOST, USER, PASSWORD);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db(DB);

$vendor_grp = $_POST["vendor_grp"];
$name = $_POST["name"];
$address = $_POST["address"];
$city = $_POST["city"];
$state = $_POST["state"];
$office_phn = $_POST["office_phn"];
$mobile = $_POST["mobile"];
$fax = $_POST["fax"];
$email = $_POST["email"];
$contact_person = $_POST["contact_person"];
$contact_no = $_POST["contact_no"];
$website = $_POST["website"];
$pan = $_POST["pan"];
$tin = $_POST["tin"];
$cst = $_POST["cst"];
$ecc = $_POST["ecc"];
$service_tax_no = $_POST["service_tax_no"];
$bank_name = $_POST["bank_name"];
$account_no = $_POST["account_no"];
$bank_branch = $_POST["bank_branch"];
$ifsc = $_POST["ifsc"];


$sql = "SELECT vendor_id FROM vendor_log ORDER BY vendor_id DESC LIMIT 1";

$retval = mysql_query( $sql, $conn );

if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$row = mysql_fetch_array($retval, MYSQL_ASSOC);
$vendor_code = $row["vendor_id"];
$arr = explode("VD11",$vendor_code);
$val = (int)$arr[1];
$val += 1;
$res = 'VD11';
if($val<10){
	$res .= '00'.(string)$val;
}elseif($val>9 && $val<100){
	$res .= '0'.(string)$val;
}else{
	$res .= (string)$val;
}
$vendor_id = $res;


$sql_insert = "insert into vendor_log values('".$vendor_id."','".$vendor_grp."','".$name."','".$address.
			  "','".$city."','".$state."','".$office_phn."','".$mobile."','".$fax."','".$email."','".$contact_person.
			  "','".$contact_no."','".$website."','".$pan."','".$tin."','".$cst."','".$ecc."','".$service_tax_no.
			  "','".$bank_name."','".$account_no."','".$bank_branch."','".$ifsc."','".$_SESSION["pms_user"].
			  "','".(string)time()."','','',0)";

$retval = mysql_query( $sql_insert, $conn );

mysql_close();

if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}else{




echo '<center><h2>Vendor Log Sheet Inserted!!</h2><br /><a href="vendor.php">Click Here</a></center>';
}*/
?>