<?php

function get_server() {
	// Edit config/database.php file 
	$database_file = "application/config/database.php";
	$line_array = file($database_file);

	for ($i = 0; $i < count($line_array); $i++) {
		if (strstr($line_array[$i], "'hostname' =>")) {
			$server = str_replace("'hostname' =>", "", $line_array[$i]);
			$server = str_replace("'", "", $server);
			$server = str_replace(",", "", $server);
			$server = trim($server);
			return $server;
		}
	}
}
function get_username() {
	// Edit config/database.php file 
	$database_file = "application/config/database.php";
	$line_array = file($database_file);

	for ($i = 0; $i < count($line_array); $i++) {
		if (strstr($line_array[$i], "'username' => ")) {
			$username = str_replace("'username' => ", "", $line_array[$i]);
			$username = str_replace("'", "", $username);
			$username = str_replace(",", "", $username);
			$username = trim($username);
			return $username;
		}
	}
}
function get_password() {
	// Edit config/database.php file 
	$database_file = "application/config/database.php";
	$line_array = file($database_file);

	for ($i = 0; $i < count($line_array); $i++) {
		if (strstr($line_array[$i], "'password' => ")) {
			$password = str_replace("'password' => ", "", $line_array[$i]);
			$password = str_replace("'", "", $password);
			$password = str_replace(",", "", $password);
			$password = trim($password);
			return $password;
		}
	}
}
function get_database() {
	$database_file = "application/config/database.php";
	$line_array = file($database_file);

	for ($i = 0; $i < count($line_array); $i++) {
		if (strstr($line_array[$i], "'database' => ")) {
			$database = str_replace("'database' => ", "", $line_array[$i]);
			$database = str_replace("'", "", $database);
			$database = str_replace(",", "", $database);
			$database = trim($database);
			return $database;
		}
	}
}
function get_dbprefix() {
	$database_file = "application/config/database.php";
	$line_array = file($database_file);

	for ($i = 0; $i < count($line_array); $i++) {
		if (strstr($line_array[$i], "'dbprefix' => ")) {
			$dbprefix = str_replace("'dbprefix' => ", "", $line_array[$i]);
			$dbprefix = str_replace("'", "", $dbprefix);
			$dbprefix = str_replace(",", "", $dbprefix);
			$dbprefix = trim($dbprefix);
			return $dbprefix;
		}
	}
}
class Database {

	var $db_connection = null;        // Database connection string
	var $db_server = null;            // Database server
	var $db_database = null;          // The database being connected to
	var $db_username = null;          // The database username
	var $db_password = null;          // The database password

	/** NewConnection Method
	 * This method establishes a new connection to the database. */

	public function Connection($server, $username, $password) {

		// Assign variables
		global $db_connection, $db_server, $db_username, $db_password;
		$db_server = $server;
		$db_username = $username;
		$db_password = $password;

		// Attempt connection
		$db_connection = mysqli_connect($server, $username, $password);
		if (!$db_connection) {
			return 'MySQL Connection Database Error: ' . mysqli_error($db_connection);
		}
	}

	/** Open Method
	 * This method opens the database connection (only call if closed!) */
	public function Open() {
		global $db_connection, $db_server, $db_database, $db_username, $db_password;
		if (!$CONNECTED) {
			try {
				$db_connection = mysqli_connect($db_server, $db_username, $db_password, $db_database);
				if (!$db_connection) {
					throw new Exception('MySQL Connection Database Error: ' . mysqli_error($db_connection));
				}
			} catch (Exception $e) {
				display_error($e->getMessage());
			}
		} else {
			$message = "No connection has been established to the database. Cannot open connection.";
			display_error($message());
		}
	}

	/** Close Method
	 * This method closes the connection to the MySQL Database */
	public function Close() {
		global $db_connection;
		if ($db_connection) {
			mysqli_close($db_connection);
		} else {
			$message = "No connection has been established to the database. Cannot close connection.";
			display_error($message());
		}
	}

	public function get_Connection() {
		global $db_connection;
		return $db_connection;
	}

	/** Create Database Method
	 * This method creates database */
	public function CreateDatabase($database) {
		global $db_connection;
		if ($db_connection) {
			if (!mysqli_query($db_connection,"CREATE DATABASE $database")) {
				$message = "Cannot create database." . mysqli_error($db_connection);
				display_error($message);
			}
		} else {
			$message = "No connection has been established to the database. Cannot create database.";
			display_error($message);
		}
	}

}

$server = get_server();
$username = get_username();
$password = get_password();
$database = get_database();
$dbprefix = get_dbprefix();

// Connect to Server 
$conn = new Database;
echo $conn->Connection($server, $username, $password);
$con = $conn->get_Connection();

// Select Database 
mysqli_select_db($con , $database);

//Reset Software Name
//Pro Demo
mysqli_query($con , "UPDATE ck_clinic SET clinic_name = 'Chikitsa', tag_line =  'Clinic Management System' WHERE clinic_id=1");

//Basic Demo
mysqli_query($con , "UPDATE core_clinic SET clinic_name = 'Chikitsa', tag_line =  'Clinic Management System' WHERE clinic_id=1");

//Reset Passwords
//Pro Demo
mysqli_query($con , "UPDATE ck_users SET password =  'YWRtaW4=' WHERE  username='admin'");
mysqli_query($con , "UPDATE ck_users SET password =  'ZG9jdG9y' WHERE  username='doctor'");
mysqli_query($con , "UPDATE ck_users SET password =  'cmVjZXB0aW9uaXN0' WHERE  username='receptionist'");

//Basic Demo
mysqli_query($con , "UPDATE core_users SET password =  'YWRtaW4=' WHERE  username='admin'");
mysqli_query($con , "UPDATE core_users SET password =  'ZG9jdG9y' WHERE  username='doctor'");
mysqli_query($con , "UPDATE core_users SET password =  'cmVjZXB0aW9uaXN0' WHERE  username='receptionist'");

?>