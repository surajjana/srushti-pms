<?php 
require_once("conf/constants.php");
session_start();

$client_id = $_GET["cid"];

$conn = mysql_connect(HOST, USER, PASSWORD);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db(DB);

$sql_rights = "SELECT rights FROM user WHERE uname='".$_SESSION["pms_user"]."'";

$retval = mysql_query( $sql_rights, $conn );

if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$row = mysql_fetch_array($retval, MYSQL_ASSOC);

if((int)$row["rights"] != 3){
	echo "Not Autorized!!";
}else{
	$sql = "SELECT * FROM client_log WHERE client_id='".$client_id."'";

	$retval = mysql_query( $sql, $conn );

	if(! $retval )
	{
	  die('Could not get data: ' . mysql_error());
	}

	$row = mysql_fetch_array($retval, MYSQL_ASSOC);

	mysql_close();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Srushti | Project Management System</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">

    <link rel="icon" type="image/ico" href=""/>


    <!-- Custom Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!--<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">-->

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="css/animate.min.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/creative.css" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php" style="padding:5px;"><img src="img/srushti_logo_new.png" alt=""/></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="home.php">Home</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#"><?php echo $_SESSION["pms_user"]; ?></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Client Log Sheet</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                	<label>Client ID : </label><?php echo $row["client_id"]; ?><br />
                	<label>Client Group : </label><?php echo $row["client_grp"]; ?><br />
                	<label>Name : </label><?php echo $row["name"]; ?><br />
                	<label>Address : </label><?php echo $row["address"]; ?><br />
                	<label>City : </label><?php echo $row["city"]; ?><br />
                	<label>State : </label><?php echo $row["state"]; ?><br />
                	<label>Office Phone : </label><?php echo $row["office_phn"]; ?><br />
                	<label>Mobile : </label><?php echo $row["mobile"]; ?><br />
                	<label>FAX : </label><?php echo $row["fax"]; ?><br />
                	<label>Email ID : </label><?php echo $row["email"]; ?><br />
                	<label>Contact Person : </label><?php echo $row["contact_person"]; ?><br />
                </div>

                <div class="col-md-6"> 
                	<label>Contact No. : </label><?php echo $row["contact_no"]; ?><br />
                	<label>Website : </label><?php echo $row["website"]; ?><br />                 
                	<label>PAN No. : </label><?php echo $row["pan"]; ?><br />
                	<label>TIN No. : </label><?php echo $row["tin"]; ?><br />
                	<label>CST No. : </label><?php echo $row["cst"]; ?><br />
                	<label>ECC No. : </label><?php echo $row["ecc"]; ?><br />
                	<label>Service Tax No. : </label><?php echo $row["service_tax_no"]; ?><br />
                	<label>Bank Name : </label><?php echo $row["bank_name"]; ?><br />
                	<label>Account No. : </label><?php echo $row["account_no"]; ?><br />
                	<label>Bank Brach : </label><?php echo $row["bank_branch"]; ?><br />
                	<label>IFSC Code : </label><?php echo $row["ifsc"]; ?><br />
                </div>
            </div>
            <br />
            <div class="row">
	            <div class="col-md-6">
	            	<center><?php echo '<a href="final_client_log_approve.php?cid='.$client_id.'"><h2>Approve</h2></a>'; ?></center>
	            </div>
	            <div class="col-md-6">
	            	<center><?php echo '<a href="client_edit.php?cid='.$client_id.'"><h2>Edit</h2></a>'; ?></center>
	            </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="stage"></div>
                </div>
            </div>
        </div>
    </section>

    <section id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Srushti 2016</p>
                </div>
            </div>
        </div>
    </section>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/jquery.fittext.js"></script>
    <script src="js/wow.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/creative.js"></script>

    <!-- Ajax -->
    <script type = "text/javascript" src = "http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

</body>

</html>

<?php } ?>