<?php 
	error_reporting(E_ERROR);

	$server = $_POST['server'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$dbname = $_POST['dbname'];
	
	//Does the database exists?
	$mysql = mysqli_connect($server, $username, $password,$dbname);
	if (!$mysql) {
		echo "notexists";
	}else{
		echo "exists";
	}

	

?>