<?php 
require_once("conf/constants.php");
session_start();

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
	$sql = "SELECT vendor_id,name FROM vendor_log WHERE approval_status=1";

    $retval = mysql_query( $sql, $conn );

    if(! $retval )
    {
      die('Could not get data: ' . mysql_error());
    }
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
                    <h2 class="section-heading">Vendor Master</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Vendor ID</th>
                        <th>Vendor Name</th>
                        <th>Edit</th>
                        <th>Delete</th>                        
                      </tr>
                    </thead>
                    <tbody>
                        <?php  
                            while ($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
                                echo '<tr><td>'.$row["vendor_id"].'</td><td>'.$row["name"].'</td><td><a href="vendor_edit.php?cid='.$row["vendor_id"].'">Edit</a></td><td><a href="vendor_delete.php?cid='.$row["vendor_id"].'">Delete</a></td></tr>';
                            }
                        ?>
                    </tbody>
                </table>
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