<?php  
    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
    require_once("conf/constants.php");
    session_start();
    if(strcmp($_SESSION["pms_user"],"NA") == 0 || strlen($_SESSION["pms_user"]) == 0 ){
        ob_start(); // ensures anything dumped out will be caught

        // do stuff here
        $url = DOMAIN.'invalid_login.php'; // this can be set based on whatever

        // clear out the output buffer
        while (ob_get_status()) 
        {
            ob_end_clean();
        }

        // no redirect
        header( "Location: $url" );
    }

    $po_id = $_GET["cid"];

    $conn = mysql_connect(HOST, USER, PASSWORD);
    if(! $conn )
    {
      die('Could not connect: ' . mysql_error());
    }
    $sql = "SELECT * FROM po_log where po_id='".$po_id."'";

    mysql_select_db(DB);
    
    $retval = mysql_query( $sql, $conn );

    if(! $retval )
    {
      die('Could not get data: ' . mysql_error());
    }

    $row = mysql_fetch_array($retval, MYSQL_ASSOC);

    $sql_activity = "select name,venue from activity_log where activity_id='".$row["activity_id"]."'";

    $retval_activity = mysql_query( $sql_activity, $conn );

    if(! $retval_activity )
    {
      die('Could not get data: ' . mysql_error());
    }

    $row_activity = mysql_fetch_array($retval_activity, MYSQL_ASSOC);

    $sql_vendor = "select name from vendor_log where vendor_id='".$row["vendor_id"]."'";

    $retval_vendor = mysql_query( $sql_vendor, $conn );

    if(! $retval_vendor )
    {
      die('Could not get data: ' . mysql_error());
    }

    $row_vendor = mysql_fetch_array($retval_vendor, MYSQL_ASSOC);

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

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

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
                    <h2 class="section-heading">PO Log Sheet</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                <label>PO ID : </label><?php echo $po_id; ?><br />
                <label>Activity ID : </label><?php echo $row["activity_id"]; ?><br />
                <label>Activity : </label><?php echo $row_activity["name"]; ?><br />
                <label>Vendor ID : </label><?php echo $row["vendor_id"]; ?><br />
                <label>Vendor : </label><?php echo $row_vendor["name"]; ?><br />
                <label>Vendor Group : </label><?php echo $row["vendor_grp"]; ?><br />
                <label>Venue : </label><?php echo $row_activity["venue"]; ?><br />
                <label>Remarks : </label><?php echo $row["po_remarks"]; ?><br />
                <form action="update_po.php" method="get">
                    <input type="hidden" name="po_id" value='<?php echo $po_id; ?>'>
                    
                    
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>PO Amount <span style="color:red;">*</span> :</label>
                            <input type="text" class="form-control" name="po_amount" required data-validation-required-message="Please enter the value ." value='<?php echo $row["po_amount"]; ?>' >
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>PO Balance :</label>
                            <input type="text" class="form-control" name="po_balance" value='<?php echo $row["po_balance"]; ?>' >
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                </div>

                <div class="col-md-3"></div>
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