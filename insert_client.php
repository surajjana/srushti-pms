<?php  
require_once("conf/constants.php");

$conn = mysql_connect(HOST, USER, PASSWORD);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

$client_grp = $_POST["client"];
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
$ifsc = $_POST["ifsc"]


$sql = "SELECT pwd FROM user WHERE uname='".$_POST['uname']."'";

mysql_select_db(DB);
$retval = mysql_query( $sql, $conn );

if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
?>