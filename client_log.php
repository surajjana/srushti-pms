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

    $conn = mysql_connect(HOST, USER, PASSWORD);
    if(! $conn )
    {
      die('Could not connect: ' . mysql_error());
    }
    $sql_state = "SELECT id,name FROM state_grp";
    $sql_city = "SELECT id,name FROM city_grp";
    $sql_client = "SELECT id,name FROM client_grp";

    mysql_select_db(DB);
    $retval_city = mysql_query( $sql_city, $conn );
    $retval_state = mysql_query( $sql_state, $conn );
    $retval_client = mysql_query( $sql_client, $conn );

    if(! $retval_city )
    {
      die('Could not get data: ' . mysql_error());
    }

    if(! $retval_state )
    {
      die('Could not get data: ' . mysql_error());
    }

    if(! $retval_client )
    {
      die('Could not get data: ' . mysql_error());
    }
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
    
    <link rel="stylesheet" href="css/bootstrap-combobox.css" type="text/css">

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

    <script src="js/bootstrap-combobox.js"></script>
    <script src="js/jquery.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript">
      $(document).ready(function(){
        console.log('combobox testing... :-D')
        /*$('.combobox').combobox({bsVersion: '2'});*/
        /*$('#client_log_form').find('[name="client_grp"]').combobox()*/
        $('[name="client_grp"], [name="city"]').selectpicker();
      });
    </script>

    <style type="text/css">
    .form-control .btn{
        border: solid 0.5px rgb(204, 204, 204);
        border-radius: 5px;
    }
    </style>

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
                <form id="client_log_form" action="insert_client.php" method="post">
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Client Group <span style="color:red;">*</span> :</label>
                            <!-- <input type="text" class="form-control" id="" required data-validation-required-message="Please enter your name.">
                            <p class="help-block"></p> -->
                            <select name="client_grp" id="client_grp" class="selectpicker form-control" data-live-search="true" style="border: solid 2px black;">
                                <?php  
                                    while ($row = mysql_fetch_array($retval_client, MYSQL_ASSOC)) {
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
                            <input type="text" class="form-control" name="name" id="name" required data-validation-required-message="Please enter the name.">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Address <span style="color:red;">*</span> :</label>
                            <input type="text" class="form-control" name="address" id="address" required data-validation-required-message="Please enter the address.">
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
                            <input type="text" class="form-control" name="office_phn" id="" >
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Mobile No <!-- <span style="color:red;">*</span> --> :</label>
                            <input type="text" class="form-control" name="mobile" id="" >
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Fax No:</label>
                            <input type="text" class="form-control" name="fax" id="">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Email ID <!-- <span style="color:red;">*</span>  -->:</label>
                            <input type="text" class="form-control" name="email" id="">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Contact Person <!-- <span style="color:red;">*</span> --> :</label>
                            <input type="text" class="form-control" name="contact_person" id="" >
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Contact No <!-- <span style="color:red;">*</span> --> :</label>
                            <input type="text" class="form-control" name="contact_no" id="" >
                        </div>
                    </div>
                </div>

                <div class="col-md-6">                  
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Website:</label>
                            <input type="text" class="form-control" name="website" id="" >
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>PAN No:</label>
                            <input type="text" class="form-control" name="pan" id="">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>TIN No:</label>
                            <input type="text" class="form-control" name="tin" id="">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>CST No:</label>
                            <input type="text" class="form-control" name="cst" id="" >
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>ECC No:</label>
                            <input type="text" class="form-control" name="ecc" id="" >
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Service Tax No:</label>
                            <input type="text" class="form-control" name="service_tax_no" id="" >
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Bank Name:</label>
                            <input type="text" class="form-control" name="bank_name" id="" >
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Account No:</label>
                            <input type="text" class="form-control" name="account_no" id="" >
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Bank Branch:</label>
                            <input type="text" class="form-control" name="bank_branch" id="" >
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>IFSC Code:</label>
                            <input type="text" class="form-control" name="ifsc" id="" >
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
    

    <script type="text/javascript">
        /*var res = '{"data":[{"name":"","address":"","city":"","state":""}]}';

    $(document).ready(function(){
        $("#name").bind('input propertychange', function(){
            var name = $('#name').val();
            var obj = jQuery.parseJSON(res);
            obj.data[0].name = name;
            res = JSON.stringify(obj);
            console.log(res);
        });
        $("#address").bind('input propertychange', function(){
            var address = $('#address').val();
            var obj = jQuery.parseJSON(res);
            obj.data[0].address = address;
            res = JSON.stringify(obj);
            console.log(res);
        });
        $("#city").bind('input propertychange', function(){
            var city = $('#city').val();
            var obj = jQuery.parseJSON(res);
            obj.data[0].city = city;
            res = JSON.stringify(obj);
            console.log(res);
        });
        $("#state").bind('input propertychange', function(){
            var state = $('#state').val();
            var obj = jQuery.parseJSON(res);
            obj.data[0].state = state;
            res = JSON.stringify(obj);
            console.log(res);
        });
        $("#click_me").click(function(event){
            var url = 'http://localhost:8080/test_api';
            var data = res;
            var data1 = encodeURIComponent(data);
            var form = $('<form action="' + url + '" method="post">' +
              '<input type="text" name="data" value='+ data1 +' />' +
              '</form>');
            $('body').append(form);
            form.submit();
        });*/
        /*$("#click_me").click(function(event){             
            $.post( 
              "conf/change_data.php",
              { data: res },
              function(data) {
                 $('#stage').html(data);
                 console.log(data);
                 window.location.replace("http://localhost/surajjana.github.io/pms/conf/data.php?data="+data);
              }
            );
        });*/
    /*})*/
</script>



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