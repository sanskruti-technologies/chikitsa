<?php

	//$lan_file_array=array('arabic','english','french','gujarati','italiano');
	$lan_file_array=array('english');
	//$action =  $_REQUEST['action'];
	//if($action == 'install_sql'){
		$server = $_REQUEST['server'];
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];
		$dbname = $_REQUEST['dbname'];
		$dbprefix = $_REQUEST['dbprefix'];
		
		$con=mysqli_connect($server,$username,$password,$dbname);
		
			foreach($lan_file_array as $lf){
				//Read Language Data from database and update language file
				$language_file = "./application/language/$lf/main_lang.php";
				
				//select l_index and l_value from table		
				$sql = "SELECT l_index,l_value FROM ". $dbprefix ".language_data WHERE l_name='".$lf."';";
				$sql = str_replace("%dbprefix%",$dbprefix,$sql);
				$result = mysqli_query($con, $sql);
				$i=1;
				$line_array=array();
				$line_array[0] = "<?php ". "\r\n";
				while($row = mysqli_fetch_assoc($result)) {
					$line_array[$i] = '$lang[\''.$row["l_index"].'\'] = "'.$row["l_value"].'";' . "\r\n";
					$i++;
				}
				$line_array[$i] = "?> ". "\r\n";
				
				file_put_contents($language_file, $line_array);
			}
			mysqli_close($con);
	//}
?>