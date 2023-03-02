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

	$sql_file_name = $_REQUEST['sql_file_name'];
	$server        = $_REQUEST['server'];
	$username      = $_REQUEST['username'];
	$password      = $_REQUEST['password'];
	$dbname        = $_REQUEST['dbname'];
	$dbprefix      = $_REQUEST['dbprefix'];

		$con = mysqli_connect($server,$username,$password,$dbname);

		//Prepare Queries
		$sqls = file($sql_file_name);
		$count = count($sqls);
		$query= "";
		foreach($sqls as $sql){
			$statement = str_replace("%dbprefix%",$dbprefix,$sql);
			$query .= $statement;
		}

		$response = array();
		//Run Queries
		if (mysqli_multi_query($con, $query)) {
			do {
			// Store first result set
			if ($result = mysqli_store_result($con)) {
				while ($row = mysqli_fetch_row($result)) {
					$response[] = $row[0];
				}
				mysqli_free_result($result);
			}
			//Prepare next result set
			} while (mysqli_next_result($con));
		}

		echo json_encode($response);


	
?>