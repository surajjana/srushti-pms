<?php
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
	        </tr>
	    </table>

	    <br /><br /><br /><br /><br /><br />
	    <p style="margin-left:500px;">Authorised Signature</p>

	</page>';

    require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('P','A4','fr');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output(str_replace("/","_",$activity_id).'.pdf');
?>