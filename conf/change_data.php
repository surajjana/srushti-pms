<?php  

require_once('post.php');

$data = $_REQUEST['data'];
$arr_data = array('data' => $data);

$url = 'http://localhost:8080/test_api';

$obj = new PostData;

$obj->setData($url,$arr_data);

$res = $obj->setPost();

echo $res;

/*$res = json_decode($res);
$res = json_decode($res);

echo nl2br("Name : ".$res->{'data'}[0]->{'name'}."\nAddress : ".$res->{'data'}[0]->{'address'}."\nCity : ".$res->{'data'}[0]->{'city'}."\nState : ".$res->{'data'}[0]->{'state'});
*/

?>