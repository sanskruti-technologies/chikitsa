<?php 
	
	$server = $_POST['server'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	if($server != "" &&  $username != "" && $password != ""){
		$db_connection = mysqli_connect($server, $username, $password);
		if (!$db_connection) {
			echo 'MySQL Connection Database Error: ' . mysqli_error($db_connection);
		}else{
			echo 'true';
		}
	}else{
		echo 'true';
	
	}
	
	
?>