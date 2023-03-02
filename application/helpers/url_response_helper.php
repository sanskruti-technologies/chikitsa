<?php
	function get_url_response() {
		$subdomain = str_replace('.chikitsa.net','',$_SERVER['HTTP_HOST']);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://chikitsa.net/wp-json/subscribers/v1/subscriber/subdomain=$subdomain");
		
		// receive server response ...
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec($ch);
		curl_close($ch);

		$subdomain_server_output = json_decode($server_output,true);
		$server_output=$subdomain_server_output['subscription_details'];
	
		return $server_output;
	}
 
?>
