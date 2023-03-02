<?php 
	error_reporting(E_ERROR);

	$server = $_POST['server'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$dbname = $_POST['dbname'];
	$dbprefix = $_POST['dbprefix'];
	
	$con = mysqli_connect($server, $username, $password, $dbname);

	$sql = "SHOW TABLES LIKE '".$dbprefix."version';";
	$result = mysqli_query($con,$sql);
	if((mysqli_num_rows($result))==0){
		echo "notexists";
	}else{
		echo "exists";
	}
?>