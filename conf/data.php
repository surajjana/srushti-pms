<?php  

$data = $_REQUEST['data'];
$res = json_decode($data);
$res = json_decode($res);

echo nl2br("Name : ".$res->{'data'}[0]->{'name'}."\nAddress : ".$res->{'data'}[0]->{'address'}."\nCity : ".$res->{'data'}[0]->{'city'}."\nState : ".$res->{'data'}[0]->{'state'});

?>