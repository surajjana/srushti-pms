<?php  
    require_once("conf/constants.php");
    session_start();
    if(strcmp($_SESSION["pms_user"],"NA") == 0){
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

    $conn = mysql_connect(HOST, USER, PASSWORD);
    if(! $conn )
    {
      die('Could not connect: ' . mysql_error());
    }
    $sql_state = "SELECT id,name FROM state_grp";
    $sql_city = "SELECT id,name FROM city_grp";
    $sql_vendor = "SELECT id,name FROM vendor_grp";
    $sql_value = "SELECT * FROM vendor_log WHERE vendor_id='".$_GET["cid"]."'";

    mysql_select_db(DB);
    $retval_city = mysql_query( $sql_city, $conn );
    $retval_state = mysql_query( $sql_state, $conn );
    $retval_vendor = mysql_query( $sql_vendor, $conn );
    $retval_value = mysql_query( $sql_value, $conn );

    if(! $retval_city )
    {
      die('Could not get data: ' . mysql_error());
    }

    if(! $retval_state )
    {
      die('Could not get data: ' . mysql_error());
    }

    if(! $retval_vendor )
    {
      die('Could not get data: ' . mysql_error());
    }

    if(! $retval_value )
    {
      die('Could not get data: ' . mysql_error());
    }

    $val = mysql_fetch_array($retval_value, MYSQL_ASSOC);
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
                    <h2 class="section-heading">Vendor Log Sheet</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                <form action="update_vendor.php" method="post">
                    <input type="hidden" name="vendor_id" value='<?php echo $_GET["cid"]; ?>'>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Vendor Group <span style="color:red;">*</span> :</label>
                            <!-- <input type="text" class="form-control" id="" required data-validation-required-message="Please enter your name.">
                            <p class="help-block"></p> -->
                            <select name="vendor_grp" class="form-control">
                                <?php  
                                    while ($row = mysql_fetch_array($retval_vendor, MYSQL_ASSOC)) {
                                        if(strlen($row["name"]) > 0){
                                            echo '<option value="'.ucfirst($row["name"]).'">'.ucfirst($row["name"]).'</option>';
                                        }
                                    }
                                    mysql_close();
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Name <span style="color:red;">*</span> :</label>
                            <input type="text" class="form-control" name="name" id="name" required data-validation-required-message="Please enter the name." value='<?php echo $val["name"]; ?>' >
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Address <span style="color:red;">*</span> :</label>
                            <input type="text" class="form-control" name="address" id="address" required data-validation-required-message="Please enter the address." value='<?php echo $val["address"]; ?>' >
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>City <span style="color:red;">*</span> :</label>
                            <!-- <input type="text" class="form-control" id="city" required data-validation-required-message="Please enter your phone number."> -->
                            <select name="city" class="form-control">
                                <?php  
                                    while ($row = mysql_fetch_array($retval_city, MYSQL_ASSOC)) {
                                        if(strlen($row["name"]) > 0){
                                            echo '<option value="'.ucfirst($row["name"]).'">'.ucfirst($row["name"]).'</option>';
                                        }
                                    }
                                    mysql_close();
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>State <span style="color:red;">*</span> :</label>
                            <!-- <input type="text" class="form-control" id="state" required data-validation-required-message="Please enter your phone number."> -->
                            <select name="state" class="form-control">
                                <?php  
                                    while ($row = mysql_fetch_array($retval_state, MYSQL_ASSOC)) {
                                        if(strlen($row["name"]) > 0){
                                            echo '<option value="'.ucfirst($row["name"]).'">'.ucfirst($row["name"]).'</option>';
                                        }
                                    }
                                    mysql_close();
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Office Phone:</label>
                            <input type="text" class="form-control" name="office_phn" id="" value='<?php echo $val["office_phn"]; ?>' >
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Mobile No <span style="color:red;">*</span> :</label>
                            <input type="text" class="form-control" name="mobile" id="" required data-validation-required-message="Please enter the mobile number." value='<?php echo $val["mobile"]; ?>' >
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Fax No:</label>
                            <input type="text" class="form-control" name="fax" id="" value='<?php echo $val["fax"]; ?>' >
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Email ID <span style="color:red;">*</span> :</label>
                            <input type="text" class="form-control" name="email" id="" required data-validation-required-message="Please enter email id." value='<?php echo $val["email"]; ?>' >
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Contact Person <span style="color:red;">*</span> :</label>
                            <input type="text" class="form-control" name="contact_person" id="" required data-validation-required-message="Please enter contact person name." value='<?php echo $val["contact_person"]; ?>' >
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Contact No <span style="color:red;">*</span> :</label>
                            <input type="text" class="form-control" name="contact_no" id="" required data-validation-required-message="Please enter your contact person phone number." value='<?php echo $val["contact_no"]; ?>' >
                        </div>
                    </div>
                </div>

                <div class="col-md-6">                  
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Website:</label>
                            <input type="text" class="form-control" name="website" id="" value='<?php echo $val["website"]; ?>' >
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>PAN No <span style="color:red;">*</span> :</label>
                            <input type="text" class="form-control" name="pan" id="" required data-validation-required-message="Please enter your PAN number." value='<?php echo $val["pan"]; ?>' >
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>TIN No <span style="color:red;">*</span> :</label>
                            <input type="text" class="form-control" name="tin" id="" required data-validation-required-message="Please enter your TIN number." value='<?php echo $val["tin"]; ?>' >
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>CST No:</label>
                            <input type="text" class="form-control" name="cst" id="" value='<?php echo $val["cst"]; ?>' >
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>ECC No:</label>
                            <input type="text" class="form-control" name="ecc" id="" value='<?php echo $val["ecc"]; ?>' >
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Service Tax No:</label>
                            <input type="text" class="form-control" name="service_tax_no" id="" value='<?php echo $val["service_tax_no"]; ?>' >
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Bank Name:</label>
                            <input type="text" class="form-control" name="bank_name" id="" value='<?php echo $val["bank_name"]; ?>' >
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Account No:</label>
                            <input type="text" class="form-control" name="account_no" id="" value='<?php echo $val["account_no"]; ?>' >
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Bank Branch:</label>
                            <input type="text" class="form-control" name="bank_branch" id="" value='<?php echo $val["bank_branch"]; ?>' >
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>IFSC Code:</label>
                            <input type="text" class="form-control" name="ifsc" id="" value='<?php echo $val["ifsc"]; ?>' >
                        </div>
                    </div>
                    <button type="submit" id="click_me" class="btn btn-primary">Submit</button>
                </form>
                
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