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

$uname = $_POST["uname"];
$email = $_POST["email"];
$pwd = $_POST["pwd"];
$rights = $_POST["rights_1"];

$sql = "insert into user(uid,uname,pwd,email,rights) values('','".$uname."','".$pwd."','".$email."',".$rights.")";

$retval = mysql_query( $sql, $conn );

if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}else{
	echo '<center><h2>New User Added!!</h2><br /><a href="home.php">Click Here</a></center>';
}
mysql_close();
?>