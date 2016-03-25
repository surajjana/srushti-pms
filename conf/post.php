<?php  

class PostData{
	var $post_url;
	var $post_data;

	function setData($url,$data){
		$this->post_url = $url;
		$this->post_data = $data;
	}

	function setPost(){

		// use key 'http' even if you send the request to https://...
		$options = array(
		    'http' => array(
		        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		        'method'  => 'POST',
		        'content' => http_build_query($this->post_data),
		    ),
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($this->post_url, false, $context);

		//echo json_decode($result);

		return $result;
	}

}

?>