<?php 
	$action =  $_REQUEST['action'];
	if($action == 'install_sql'){
		$server = $_REQUEST['server'];
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];
		$dbname = $_REQUEST['dbname'];
		if(isset($_REQUEST['sql'])){
			$sql = $_REQUEST['sql'];

			//echo $sql."<br/>";
			$con=mysqli_connect($server,$username,$password,$dbname);
			$con->set_charset("UTF8");	
			if($sql == 'done'){
				echo "Installation Complete.\n";
			}else{
				
				$dbprefix = $_REQUEST['dbprefix'];
				$statement = str_replace("%dbprefix%",$dbprefix,$sql);
				//echo "$statement";
				if (!mysqli_query($con,$statement)){
					$error = mysqli_error($con);
					if (strpos($error, "Duplicate entry") === false) {
						echo "Error : ". $error . " occurred while executing ".$statement;
					}
				}
			}
			mysqli_close($con);
		}
		
	}
	
?>