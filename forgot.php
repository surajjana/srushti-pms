<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require_once("conf/constants.php");

$conn = mysql_connect(HOST, USER, PASSWORD);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
$sql = "SELECT email FROM user WHERE uname='".$_POST['uname']."'";

mysql_select_db(DB);
$retval = mysql_query( $sql, $conn );

if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$row = mysql_fetch_array($retval, MYSQL_ASSOC);
if($row['email']){
	if(strcmp($row['email'],$_POST['email']) == 0)
    {
    	$new_pwd = 'srushti'.(string)rand(1000,9999);
    	$sql = "update user set pwd='".$new_pwd."' where uname='".$_POST["uname"]."'";

		mysql_select_db(DB);
		$retval = mysql_query( $sql, $conn );

		if(! $retval )
		{
		  die('Could not get data: ' . mysql_error());
		}

		$to = $_POST['email'];
		$subject = 'Srushti PMS Password Change';
		$message = '<html><body>
						<p>Hi '.$_POST['uname'].'!!</p><br /><br />
						<p>New Password : '.$new_pwd.'<br /><br />
						<p>Thank you,</p>
						<p>Srushti Ads</p>
					</body></html>';

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Srushti Ads <noreply@srushti.net.in>' . "\r\n";

		mail($to,$subject,$message,$headers);

		echo "<center><h2>New password sent to ".$_POST['email']."</h2><br /><a href='index.php'>Click Here To Log In</center>";

    }else{
    	ob_start(); // ensures anything dumped out will be caught

		// do stuff here
		$url = DOMAIN.'forgot_password_invalid.php'; // this can be set based on whatever

		// clear out the output buffer
		while (ob_get_status()) 
		{
		    ob_end_clean();
		}

		// no redirect
		header( "Location: $url" );
    }
}else{
	ob_start(); // ensures anything dumped out will be caught

	// do stuff here
	$url = DOMAIN.'forgot_password_invalid.php'; // this can be set based on whatever

	// clear out the output buffer
	while (ob_get_status()) 
	{
	    ob_end_clean();
	}

	// no redirect
	header( "Location: $url" );
}
mysql_close($conn);

?>