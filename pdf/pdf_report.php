<?php
    
    require_once("../conf/constants.php");

    $activity_id = $_GET['activity_id'];

    $conn = mysql_connect(HOST, USER, PASSWORD);
    if(! $conn )
    {
      die('Could not connect: ' . mysql_error());
    }

    mysql_select_db(DB);

    $sql = "SELECT * FROM po_log WHERE activity_id='".$activity_id."'";

    $retval = mysql_query( $sql, $conn );

    if(! $retval )
    {
      die('Could not get data: ' . mysql_error());
    }

    $val = '';

    while ($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {

        $sql_vendor = "select name from vendor_log where vendor_id='".$row["vendor_id"]."'";

        $retval_vendor = mysql_query( $sql_vendor, $conn );

        if(! $retval_vendor )
        {
          die('Could not get data: ' . mysql_error());
        }

        $row_vendor = mysql_fetch_array($retval_vendor, MYSQL_ASSOC);

        $val .= '<tr><td>'.$row["po_id"].'</td><td>'.$row["vendor_id"].'</td><td>'.$row_vendor["name"].'</td><td>'.$row["po_amount"].'</td><td>'.$row["po_balance"].'</td></tr>';
    }

    $sql = "SELECT sum( po_amount ) , sum( po_balance )FROM po_log WHERE activity_id = '".$activity_id."'";

    $retval = mysql_query( $sql, $conn );

    if(! $retval )
    {
      die('Could not get data: ' . mysql_error());
    }

    $row = mysql_fetch_array($retval, MYSQL_ASSOC);

    $total = '<tr><td colspan="3">Total</td><td>'.$row["sum( po_amount )"].'</td><td>'.$row["sum( po_balance )"].'</td></tr>';


    $content = '
<page>
    <img src="../img/srushti_logo_new.png" style="margin-left:25px;margin-top:15px;">

    <br />

    <style type="css/text">
        th, td {
            padding: 15px;
            text-align: left;
        }
    </style>

    <table border="0.5" cellpadding="0" cellspacing="0" align="center">
        <tr>
            <th>PO No.</th>
            <th>Vendor ID</th>
            <th>Vendor</th>
            <th>PO Amount</th>
            <th>PO Balance</th>
        </tr>'.$val.$total.'
    </table>

    <br /><br /><br /><br /><br /><br />
    <p style="margin-left:500px;">Authorised Signature</p>

</page>';

    require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('P','A4','fr');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output(str_replace("/","_",$activity_id).'.pdf');
?>