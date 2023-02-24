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
			mysqli_close($con);
		}

	}
	
?>