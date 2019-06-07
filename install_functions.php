<?php 
	$action =  $_REQUEST['action'];
	if($action == 'install_sql'){
		$server = $_REQUEST['server'];
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];
		$dbname = $_REQUEST['dbname'];
		$sql = $_REQUEST['sql'];

		
		$con=mysqli_connect($server,$username,$password,$dbname);
		
		if($sql == 'done'){
			echo "Installation Complete.\n";
		}else{
			
			$dbprefix = $_REQUEST['dbprefix'];
			$statement = str_replace("%dbprefix%",$dbprefix,$sql);
			if (!mysqli_query($con,$statement)){
				echo "Error : ". mysqli_error($con) . " occurred while executing ".$statement;
			}
		}
		
		mysqli_close($con);
	}
	
?>