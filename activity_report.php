<?php 
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require_once("conf/constants.php");
session_start();

$activity_id = $_GET["activity_id"];

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
	$sql = "SELECT * FROM po_log WHERE activity_id='".$activity_id."'";

    $retval = mysql_query( $sql, $conn );

    if(! $retval )
    {
      die('Could not get data: ' . mysql_error());
    }

    $sql_activity = "select name from activity_log where activity_id='".$activity_id."'";

    $retval_activity = mysql_query( $sql_activity, $conn );

    if(! $retval_activity )
    {
      die('Could not get data: ' . mysql_error());
    }

    $row_activity = mysql_fetch_array($retval_activity, MYSQL_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Srushti | Project Manaagement System</title>

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
                    <h2 class="section-heading">Report For : <?php echo $activity_id.", ".$row_activity["name"]; ?></h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>PO No.</th>
                        <th>Vendor ID</th>
                        <th>Vendor</th>
                        <th>PO Amount</th>
                        <th>PO Balance</th>                        
                      </tr>
                    </thead>
                    <tbody>
                        <?php  
                            while ($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {

                                $sql_vendor = "select name from vendor_log where vendor_id='".$row["vendor_id"]."'";

                                $retval_vendor = mysql_query( $sql_vendor, $conn );

                                if(! $retval_vendor )
                                {
                                  die('Could not get data: ' . mysql_error());
                                }

                                $row_vendor = mysql_fetch_array($retval_vendor, MYSQL_ASSOC);

                                echo '<tr><td>'.$row["po_id"].'</td><td>'.$row["vendor_id"].'</td><td>'.$row_vendor["name"].'</td><td>'.$row["po_amount"].'</td><td>'.$row["po_balance"].'</td></tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <?php  
                    $sql = "SELECT sum( po_amount ) , sum( po_balance )FROM po_log WHERE activity_id = '".$activity_id."'";

                    $retval = mysql_query( $sql, $conn );

                    if(! $retval )
                    {
                      die('Could not get data: ' . mysql_error());
                    }

                    $row = mysql_fetch_array($retval, MYSQL_ASSOC);

                ?>
                <div class="col-md-6">
                    <center>Total Amount : <?php echo $row["sum( po_amount )"]; ?> INR</center>
                </div>
                <div class="col-md-6">
                    <center>Total Balance : <?php echo $row["sum( po_balance )"]; ?> INR</center>
                </div>
            </div>
            <br />
            <div class="row"> 
                <div class="col-md-6" style="margin-bottom:10px;">
                    <center><a href="pdf/pdf_report.php?activity_id=<?php echo $activity_id; ?>" target="_blank"><button class="btn btn-primary">Export To PDF</button></a></center>
                </div>
                <div class="col-md-6">
                    <center><a href="#" target="_blank"><button class="btn btn-primary">Export To CSV</button></a></center>
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

</body>

</html>

<?php } ?>