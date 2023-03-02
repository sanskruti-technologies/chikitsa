<?php
/*
	This file is part of Chikitsa.

    Chikitsa is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Chikitsa is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Chikitsa.  If not, see <https://www.gnu.org/licenses/>.
*/

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
			if ($con -> connect_errno) {
				echo "Failed to connect to MySQL: " . $con -> connect_error;
				exit();
			}
			$con->set_charset("UTF8");
			$dbprefix = $_REQUEST['dbprefix'];
			$statement = str_replace("%dbprefix%",$dbprefix,$sql);
			//echo "$statement";
			if (!mysqli_query($con,$statement)){
				$error = mysqli_error($con);
				if (strpos($error, "Duplicate entry") === false) {
					echo "Error : ". $error . " occurred while executing ".$statement;
				}
			}
			// Execute multi query
			
			/*if ($mysqli -> multi_query($statement)) {
				$error = mysqli_error($con);
				if (strpos($error, "Duplicate entry") === false) {
					echo "Error : ". $error . " occurred while executing ".$statement;
				}
				do {
					// Store first result set
					if ($result = $mysqli -> store_result()) {
						while ($row = $result -> fetch_row()) {
							printf("%s\n", $row[0]);
						}
						$result -> free_result();
					}
					// if there are more result-sets, the print a divider
					if ($mysqli -> more_results()) {
						printf("-------------\n");
					}
					//Prepare next result set
				} while ($mysqli -> next_result());
			}*/
			mysqli_close($con);
		}

	}
	
?>