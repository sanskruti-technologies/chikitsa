<html>
    <head>
        <title>Chikitsa - Patient Management System</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8"> 


        <!-- BOOTSTRAP STYLES-->
		<link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
		<!-- FONTAWESOME STYLES-->
		<link href="./assets/css/font-awesome.min.css" rel="stylesheet" />
		<!-- CUSTOM STYLES-->
		<link href="./assets/css/custom.min.css" rel="stylesheet" />
		
		<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
		<!-- JQUERY SCRIPTS -->
		<script src="./assets/js/jquery-1.11.3.min.js"></script>
		  <!-- BOOTSTRAP SCRIPTS -->
		<script src="./assets/js/bootstrap.min.js"></script>
		<!-- METISMENU SCRIPTS -->
		<script src="./assets/js/jquery.metisMenu.min.js"></script>
		  <!-- CUSTOM SCRIPTS -->
		<script src="./assets/js/custom.min.js"></script>		
		
		<style>
			#myProgress {
				width: 100%;
				background-color: grey;
			}
			#myBar {
				width: 1%;
				height: 30px;
				background-color: green;
			}
		</style>
    </head>
	<?php 
	$lan_file_array = array('arabic','english','french','gujarati','italiano');
		error_reporting(E_ERROR);
		
		global $latest_version;
		global $display_message;
		global $flag;
		$flag="false";
		
		$latest_version = "0.8.2";
		$display_message = "";
		function currentUrl($server){
			//Figure out whether we are using http or https.
			$http = 'http';
			//If HTTPS is present in our $_SERVER array, the URL should
			//start with https:// instead of http://
			if(isset($server['HTTPS'])){
				$http = 'https';
			}
			//Get the HTTP_HOST.
			$host = $server['HTTP_HOST'];
			//Get the REQUEST_URI. i.e. The Uniform Resource Identifier.
			$requestUri = $server['REQUEST_URI'];
			//Finally, construct the full URL.
			//Use the function htmlentities to prevent XSS attacks.
			return $http . '://' . htmlentities($host) . htmlentities($requestUri);
		}
		function set_base_url(){
			$base_url = str_replace("/install.php","",currentUrl($_SERVER));
			$base_url = str_replace("///","/",$base_url);
			$config_file = "./application/config/config.php";
			
			$line_array = file($config_file);
			for ($i = 0; $i < count($line_array); $i++) {
				if (strstr($line_array[$i], "'base_url'")) {
					$line_array[$i] = '$config[\'base_url\'] = "'.$base_url.'/";'."\r\n";
				}
			}
			file_put_contents($config_file, $line_array);
		}
		function folder_move($source, $target ){
			full_copy( $source, $target );
			delete_directory($source);
		}
		function full_copy( $source, $target ) {
			if ( is_dir( $source ) ) {
				@mkdir( $target );
				$d = dir( $source );
				while ( FALSE !== ( $entry = $d->read() ) ) {
					if ( $entry == '.' || $entry == '..' ) {
						continue;
					}
					$Entry = $source . '/' . $entry; 
					if ( is_dir( $Entry ) ) {
						full_copy( $Entry, $target . '/' . $entry );
						continue;
					}
					copy( $Entry, $target . '/' . $entry );
				}

				$d->close();
			}else {
				copy( $source, $target );
			}
		} 
		function is_database_file_new(){
			$database_file = "application/config/database.php";
			$line_array = file($database_file);
			for ($i = 0; $i < count($line_array); $i++) {
				if (strpos($line_array[$i],"array(") !== false) {
					return TRUE;
				}
				
			}
			return FALSE;
		}
		function delete_file($file_name){
			if(file_exists($file_name)){
				unlink ($file_name);
			}
		}
		function delete_folder($dir_name){
			if(is_dir($dir_name)){
				rmdir ($dir_name);
			}
		}
		function delete_directory($dirname) {
			if (is_dir($dirname))
				   $dir_handle = opendir($dirname);
			 if (!$dir_handle)
				  return false;
			 while($file = readdir($dir_handle)) {
				   if ($file != "." && $file != "..") {
						if (!is_dir($dirname."/".$file))
							 unlink($dirname."/".$file);
						else
							 delete_directory($dirname.'/'.$file);
				   }
			 }
			 closedir($dir_handle);
			 rmdir($dirname);
			 return true;
		}
		function get_server_old() {
			// Edit config/database.php file 
			$database_file = "application/config/database.php";
			$line_array = file($database_file);

			for ($i = 0; $i < count($line_array); $i++) {
				if (strstr($line_array[$i], "['default']['hostname']")) {
					$server = str_replace('$db[\'default\'][\'hostname\'] = ', "", $line_array[$i]);
					$server = str_replace("'", "", $server);
					$server = str_replace(";", "", $server);
					$server = trim($server);
					return $server;
				}
			}
		}
		function get_username_old() {
			// Edit config/database.php file 
			$database_file = "application/config/database.php";
			$line_array = file($database_file);

			for ($i = 0; $i < count($line_array); $i++) {
				if (strstr($line_array[$i], "['default']['username']")) {
					$username = str_replace('$db[\'default\'][\'username\'] = ', "", $line_array[$i]);
					$username = str_replace("'", "", $username);
					$username = str_replace(";", "", $username);
					$username = trim($username);
					return $username;
				}
			}
		}
		function get_password_old() {
			// Edit config/database.php file 
			$database_file = "application/config/database.php";
			$line_array = file($database_file);

			for ($i = 0; $i < count($line_array); $i++) {
				if (strstr($line_array[$i], "['default']['password']")) {
					$password = str_replace('$db[\'default\'][\'password\'] = ', "", $line_array[$i]);
					$password = str_replace("'", "", $password);
					$password = str_replace(";", "", $password);
					$password = trim($password);
					return $password;
				}
			}
		}
		function get_database_old() {
			$database_file = "application/config/database.php";
			$line_array = file($database_file);

			for ($i = 0; $i < count($line_array); $i++) {
				if (strstr($line_array[$i], "['default']['database']")) {
					$database = str_replace('$db[\'default\'][\'database\'] = ', "", $line_array[$i]);
					$database = str_replace("'", "", $database);
					$database = str_replace(";", "", $database);
					$database = trim($database);
					return $database;
				}
			}
		}
		function get_dbprefix_old() {
			$database_file = "application/config/database.php";
			$line_array = file($database_file);

			for ($i = 0; $i < count($line_array); $i++) {
				if (strstr($line_array[$i], "['default']['dbprefix']")) {
					$dbprefix = str_replace('$db[\'default\'][\'dbprefix\'] = ', "", $line_array[$i]);
					$dbprefix = str_replace("'", "", $dbprefix);
					$dbprefix = str_replace(";", "", $dbprefix);
					$dbprefix = trim($dbprefix);
					return $dbprefix;
				}
			}
		}
		function correct_database_file(){
			//Need to change the format of database file
			
			$server = get_server_old();
			$dbname = get_database_old();
			$mysql_username = get_username_old();
			$mysql_password = get_password_old();
			$dbprefix = get_dbprefix_old();
			
			$sample_database_file = "application/config/sample-database.php";
			$line_array = file($sample_database_file);
			
			for ($i = 0; $i < count($line_array); $i++) {

				if (strstr($line_array[$i], "'hostname' => ")) {
					$line_array[$i] = '	   \'hostname\' => \'' . $server . '\',' . "\r\n";
				}
				if (strstr($line_array[$i], "'username' =>")) {
					$line_array[$i] = '    \'username\' => \'' . $mysql_username . '\',' . "\r\n";
				}
				if (strstr($line_array[$i], "'password' => ")) {
					$line_array[$i] = '    \'password\' => \'' . $mysql_password . '\',' . "\r\n";
				}
				if (strstr($line_array[$i], "'database' => ")) {
					$line_array[$i] = '    \'database\' => \'' . $dbname . '\',' . "\r\n";
				}
				if (strstr($line_array[$i], "'dbprefix' => ")) {
					$line_array[$i] = '    \'dbprefix\' => \'' . $dbprefix . '\',' . "\r\n";
				}
			}
			file_put_contents($sample_database_file, $line_array);
			
			$database_file = "application/config/database.php";
			rename($sample_database_file,$database_file);
		}
		function display_information($message) {
			global $display_message;
			global $flag;
			$display_message = $display_message . $message . "<br/>";   
			if($message=="You have latest version of application installed."){
				$flag=true;
			}
				
		}
		function application_url(){
            /* Get Page Url */
            $pageURL = 'http';
            if ( isset( $_SERVER["HTTPS"] ) && strtolower( $_SERVER["HTTPS"] ) == "on" ) {
                $pageURL .= "s";
            }
            $pageURL .= "://";
            if ($_SERVER["SERVER_PORT"] != "80") {
                $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
            } else {
                $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
            }        
            $pageURL = explode("/", $pageURL);        
            $base_path = '';
            for($i=0; $i < (sizeof($pageURL)-1); $i++){
                $base_path .= $pageURL[$i] . "/";
            }
            return $base_path;
		
		}
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
		function display_error($message) {
            echo "<div class=\"alert alert-danger\" >$message</div>";
        }
		function is_installed() {
			$database_file = "application/config/database.php";
			if(!file_exists($database_file)){
				return FALSE;
			}else{
				return TRUE;
			}
		}
		function does_database_exist($server, $username, $password,$dbname){
			$mysql = mysqli_connect($server, $username, $password,$dbname);
			if (!$mysql) {
				return 0;
			}else{
				return 1;
			}
		}
		function are_tables_created($dbprefix,$con){
			$sql = "SHOW TABLES LIKE '".$dbprefix."version';";
            $result = mysqli_query($con,$sql);
			if((mysqli_num_rows($result))==0){
				return FALSE;	
			}else{		
				return TRUE;
			}
		}
		
		function display_form($message){
			if($message != ""){
				display_error($message);
			}
			?>
			<h5>( Fill in the details to install Chikitsa )</h5>
				<br />
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<strong>Install Chikitsa : Setup Database</strong>  
							</div>
							<div class="panel-body">
							<form method='post' action='install.php' >
							<input type="hidden" name="step" value="2" />
							<div class="form-group input-group">
								<span class="input-group-addon">Host Name</span>
								<input type="text" class="form-control" name="server" placeholder="localhost" required/>
							</div>
							<span class="small">You should be able to get hostname from your web host, if <strong>localhost</strong> does not work.</span>
							<div class="form-group input-group">
								<span class="input-group-addon">Database Name</span>
								<input type="text" class="form-control" name="dbname" placeholder="chikitsa" required/>
							</div>
							<div class="form-group input-group">
								<input type='checkbox' name='createdb' value='createdb'>Create database
							</div>
							<div class="form-group input-group">
								<span class="input-group-addon">Table Prefix</span>
								<input type="text" class="form-control" name="tableprefix" placeholder="ck_" required />
							</div>
							<div class="form-group input-group">
								<span class="input-group-addon">MySQL Username</span>
								<input type="text" class="form-control" name="username" placeholder="MySQL Username" required />
							</div>
							<div class="form-group input-group">
								<span class="input-group-addon">MySQL Password</span>
								<input type="text" class="form-control" name="password" placeholder="MySQL Password" />
							</div>
							<button type="submit" name="submit" class="btn btn-success"/>Install</button>
						</form>
						</div>
						</div>
					</div>
				</div>
			<?php
		}	
		function display_system_admin_form($message,$server,$username,$password,$database,$dbprefix){
			if($message != ""){
				display_error($message);
			}
			?>
			<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">
										<strong>Install Chikitsa : Create System Administrator User</strong>  
									</div>
									<div class="panel-body">
									<form method='post' action='install.php' >
										<input type="hidden" name="step" value="4" />
										<input type="hidden" class="form-control" name="dbprefix" value='<?=$dbprefix;?>' />
										<input type="hidden" class="form-control" name="dbname" value='<?=$database;?>' />
										<input type="hidden" class="form-control" name="server" value='<?=$server;?>' />
										<input type="hidden" class="form-control" name="mysql_username" value='<?=$username;?>' />
										<input type="hidden" class="form-control" name="mysql_password" value='<?=$password;?>' />
										<div class="form-group input-group">
											<span class="input-group-addon">Username</span>
											<input type="text" class="form-control" name="username" placeholder="sysadmin" required />
										</div>
										<div class="form-group input-group">
											<span class="input-group-addon">Password</span>
											<input type="password" class="form-control" name="password" placeholder="Password" />
										</div>
										<div class="form-group input-group">
											<span class="input-group-addon">Confirm Password</span>
											<input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" />
										</div>
										<button type="submit" name="submit" class="btn btn-success"/>Create</button>
									</form>
								</div>
								</div>
							</div>
			</div>
			<?php
		}
	?>
    <body>
		<div class="container">
	        <div class="row">
				<div class="col-md-12">
					<div class="col-md-6" style="margin:0 auto;">
					<h2> Chikitsa : Install</h2>
					<?php 
					if (!isset($_REQUEST["step"])) {
						// Check if application is installled or not      
						if (is_installed()) {
							
							
							/************************************************************
							** Check the database file
							*************************************************************/
							if(!is_database_file_new()){
								correct_database_file();
							}
							/************************************************************
							** Step 1 - Check the version
							*************************************************************/
							$server = get_server();
							$username = get_username();
							$password = get_password();
							$dbname = get_database();
							$dbprefix = get_dbprefix();
							
							// Connect to Server 
							$conn = new Database;
							echo $conn->Connection($server, $username, $password);
							$con = $conn->get_Connection();
							$con->set_charset("UTF8");	
							// Select Database 
							mysqli_select_db($con , $dbname);
							if(mysqli_num_rows(mysqli_query($con , "SHOW TABLES LIKE '".$dbprefix."version'"))==1) {
								$sql = "Select current_version from " . $dbprefix . "version;";
								
								$result = mysqli_query($con,$sql);
								if (!$result) {
									$current_version = '0.0.1';
								} else {
									$row = mysqli_fetch_assoc($result);
									$current_version = $row['current_version'];
								}
								display_information("Current Version :" . $current_version);
								if ($current_version == $latest_version) {
									display_information("You have latest version of application installed.");
									
								} else {
									$current_version_int = (int)str_replace(".","",$current_version);
									
									$latest_version_int = (int)str_replace(".","",$latest_version);
									
									for($index = $current_version_int+1;$index <= $latest_version_int; $index++){
										$sql_file_name =  'sql/'.str_pad($index,3,"0",STR_PAD_LEFT).'.sql';
										
										$current_version = str_pad($index-1,3,"0",STR_PAD_LEFT);
										$current_version = implode('.',str_split($current_version)); 
										
										$new_version = str_pad($index,3,"0",STR_PAD_LEFT);
										$new_version = implode('.',str_split($new_version)); 
										
										if ($index == 12){ // 0.1.2
											//Delete not required files
											delete_file("application/language/english/ck_lang.php");
											delete_file("application/models/appointment_model.php");
											delete_file("application/models/contact_model.php");
											delete_file("application/models/patient_model.php");
											delete_file("application/models/patient_model2.txt");
											delete_file("application/models/settings_model.php");
											delete_file("application/models/stock_model.php");
											delete_file("application/modules_core/admin/views/admin_login.php");
											delete_file("application/modules_core/admin/views/admin_signin_fail.php");	
											delete_file("application/modules_core/admin/views/welcome.php");		
											delete_file("application/modules_core/appointment/views/addfromfollowup.php");		
											delete_file("application/modules_core/appointment/views/editAvailableApp.php");		
											delete_file("application/modules_core/appointment/views/edit.php");
											delete_file("application/modules_core/appointment/views/add.php");
											delete_file("application/modules_core/appointment/views/addApp.php");
											delete_file("application/modules_core/appointment/views/CancelAppointment.php");
											delete_file("application/modules_core/contact/controllers/contact.php");
											delete_folder("application/modules_core/contact/controllers");
											delete_file("application/modules_core/contact/views/add.php");
											delete_file("application/modules_core/contact/views/browse.php");
											delete_file("application/modules_core/contact/views/edit.php");
											delete_folder("application/modules_core/contact/views");
										}
										if ($index == 13){ //0.1.3
											//Delete not required files
											delete_file("application/modules_core/patient/views/add_patient.php");
											delete_file("application/modules_core/patient/views/add_patient_old.php");
											delete_file("application/modules_core/patient/views/edit.php");
											delete_file("application/modules_core/patient/views/visit_view.php");
											delete_file("application/modules_core/payment/views/advance_payment.php");
										}
										if ($index == 15){ //0.1.5
											delete_file("application/modules_core/appointment/views/inavailability.php");
										}
										if ($index == 64){ //0.6.4
											delete_folder("application/modules/main");
										}
										if ($index == 70){ //0.7.0
											folder_move("images", "uploads/images");
											folder_move("patient_images", "uploads/patient_images");
											folder_move("profile_picture", "uploads/profile_picture");
											folder_move("restore_backup", "uploads/restore_backup");
										}
										if($index == 73){
											delete_folder("application/modules/main");
										}
										
										display_information("Upgrading from ".$current_version." to ".$new_version);
										$sqls = file($sql_file_name);	
										$count = count($sqls);
										
										if($index >=  79){
											
											$language_sqls = array();
											//Language Files
											foreach($lan_file_array as $language){
												$language_sqls[$lf] = array();	
												$sql = "SELECT l_index,l_value FROM ".$dbprefix."language_data WHERE l_name='".$language."';";
												$language_sqls[$language][]= $sql;
												$database_array=array();
												if ($result = mysqli_query($con,$sql)){
													while($row = mysqli_fetch_assoc($result)) {
														 $database_array[$row['l_index']] = $row['l_value'];
													}
												}
												
												$lang = array();
												include_once("./application/language/$language/main_lang.php");
												foreach($lang as $key =>$l){
													if(!array_key_exists($key,$database_array)){
														$query="INSERT INTO ".$dbprefix."language_data (l_name,l_index,l_value) values('$language','$key',\"$l\");";
														if(mb_detect_encoding($query, "UTF-8", "UTF-8, ISO-8859-9") != "UTF-8"){
															$query = utf8_encode($query);
														}
														$language_sqls[$language][]=$query;
														//echo $query."<br/>";
													}
												}
											}
										}	
										
										?>
										<script type="text/javascript">
											$(document).ready(function () {
												$("#continue_form").hide();
												$("#step").html("Creating Tables");
												$("#progress").val(0);
												var install_sqls = <?php echo json_encode($sqls); ?>;
												var language_sqls = [];
												<?php foreach($lan_file_array as $language){?>
													language_sqls['<?=$language;?>'] =  <?php echo json_encode($language_sqls[$language]); ?>;
												<?php } ?>
												jQuery.each( install_sqls, function( i, sql) {
													$.ajax({url: "install_functions.php", data: { action: 'install_sql' , sql :sql,server: '<?=$server;?>', username: '<?=$username;?>', password: '<?=$password;?>',dbname:'<?=$dbname;?>',dbprefix:'<?=$dbprefix;?>'}, success: function(result){
														if(result != ''){
															result =  $("#install_logs").val() + result + '\n';
															$("#install_logs").val(result);
															var $textarea = $("#install_logs");
															$textarea.scrollTop($textarea[0].scrollHeight);
															
														}
														progress = parseInt($("#progress").val());
														progress = progress + 1;
														$("#progress").val(progress);
														var total_queries = <?=$count;?>;
														$("#myBar").width(parseInt(progress/total_queries*100)+ '%');
														if(progress == total_queries){
															$("#step").html("Loading Language File");
															var index = $("#index").val();
															var languages = <?php echo json_encode($lan_file_array); ?>;
															language = languages[index];
															
															read_language_files(language);
															
														}
													}});
												});
												
												function read_language_files(language){
													$("#step").html("Loading Language File : "+language);
													$("#progress").val(0);
													var install_sqls = language_sqls[language];
													
													jQuery.each( install_sqls, function( i, sql) {
														
														$.ajax({url: "install_functions.php", data: { action: 'install_sql' , sql :sql,server: '<?=$server;?>', username: '<?=$username;?>', password: '<?=$password;?>',dbname:'<?=$dbname;?>',dbprefix:'<?=$dbprefix;?>'}, success: function(result){
															if(result != ''){
																result =  $("#install_logs").val() + result + '\n';
																$("#install_logs").val(result);
																var $textarea = $("#install_logs");
																$textarea.scrollTop($textarea[0].scrollHeight);
																
															}
															progress = parseInt($("#progress").val());
															progress = progress + 1;
															$("#progress").val(progress);
															
															var total_queries = language_sqls[language].length;
															console.log(language);
															console.log(total_queries);
															$("#myBar").width(parseInt(progress/total_queries*100)+ '%');
															if(progress == total_queries){
																var index = parseInt($("#index").val());
																index++; 
																$("#index").val(index);
																var languages = <?php echo json_encode($lan_file_array); ?>;
																										
																if(index < languages.length){
																	language = languages[index];
																	read_language_files(language)
																}else{
																	$("#step").html("Updating Language Files");
																	update_language_file();
																}
																
															}
														}});
													});
													
													
												}
												
												
												function update_language_file(){
													$.ajax({url: "update_language_file.php", data: { server: '<?=$server;?>', username: '<?=$username;?>', password: '<?=$password;?>',dbname:'<?=$database;?>',dbprefix:'<?=$dbprefix;?>'},success: function(){
															console.log("done");
															$("#step").html("Installation Complete");
															$("#continue_form").show();													
														}
													});
												}
												
											});
										</script>
									
										
										<?php
									
									}
									?>
									<div id="myProgress">
										<input type="hidden" name="progress" id="progress" value="0"/>
										<div id="myBar"></div>
									</div>
									<span id="step">Installation Logs</span>
									<textarea id="install_logs" class="form-control" rows=10 style="background:#eee;" readonly>
									</textarea>
									<?php
								}
								?>
								<div class="alert alert-info" style="margin-top: 20px; padding: 0.7em;">
									<?php echo $display_message;?>
								</div>
								<?php 
								$base_url = str_replace("/install.php","",currentUrl($_SERVER));
			                    $base_url = str_replace("///","/",$base_url);
								
								
								?>
								<div class="form_style" id="continue_form" style="display:none">
									<input type="hidden" id="index" value="0" />
									<a class="btn btn-success square-btn-adjust" title="Goto Application" href="<?php echo $base_url."/index.php/login/cleardata";?>">Continue to Application</a>
								</div>
								<?php
							}else{
								$message="Chikitsa installation is not proper. Clean it first to continue";
								display_form($message);
							}
						}else{
							/************************************************************
							** Step 1 - Ask for MySQL Credentials
							*************************************************************/
							$message="";
							
							display_form($message);
						}
					}elseif ($_REQUEST["step"] == 2) {
						/************************************************************
						** Step 2 - With given Credentials
						**          Install the application for the first time
						*************************************************************/
						$server = $_POST["server"];
						$username = $_POST["username"];
						$password = $_POST["password"];
						$dbname = $_POST["dbname"];
						$dbprefix = $_POST["tableprefix"];
						
						if (isset($_POST["createdb"]))
							$createdb = 1;
						else
							$createdb = 0;
						
						$conn = new Database;
						$error_message = $conn->Connection($server, $username, $password);
						if($error_message != FALSE){
							display_form($error_message);
							exit;
						}
						
						$con = $conn->get_Connection();
						
						// Create Database
						if ($createdb == 1){
							//Does the database exists?
							if(does_database_exist($server, $username, $password,$dbname)){
								$error_message = "Database already exists. Cannot create Database";
								display_form($error_message);
								exit;
							}else{
								echo $conn->CreateDatabase($dbname);
							}
						}else{
							
							if(!does_database_exist($server, $username, $password,$dbname)){
								$error_message = "Database does not exists. Cannot Install";
								display_form($error_message);
								exit;
							}
						}
						
						$link = mysqli_select_db($con,$dbname);
						if (!$link) {
							$error_message = 'Not connected : ' . mysqli_error($con);
							display_form($error_message);
							exit;
						}
						if(are_tables_created($dbprefix,$con)){
							$error_message = 'Tables already installed.Try another Database or Table Prefix.';
							display_form($error_message);
							exit;
						}
						?>
						<div id="myProgress">
							<input type="hidden" name="progress" id="progress" value="1" />
						  <div id="myBar"></div>
						</div>
						<br/>
						
						<span id="step">Installation Logs</span>
						<textarea id="install_logs" class="form-control" rows=10 style="background:#eee;" readonly>
						</textarea>
						
						<form id='continue_form' method='post' action='install.php' >
							<input type="hidden" name="step" value="3" />
							<input type="hidden" id="index" value="0" />
							
							<div class="form_style">
								<input type="hidden" name="server" value="<?=$server;?>" />
								<input type="hidden" name="username" value="<?=$username;?>" />
								<input type="hidden" name="password" value="<?=$password;?>" />
								<input type="hidden" name="dbname" value="<?=$dbname;?>" />
								<input type="hidden" name="dbprefix" value="<?=$dbprefix;?>" />
								<input class="btn btn-success square-btn-adjust" type="submit" value="Continue" />
							</div>
						</form>	
						<?php
						//Move folders to uploads
						if ($latest_version == "0.7.0"){ //0.7.0
							folder_move("images", "uploads/images");
							folder_move("patient_images", "uploads/patient_images");
							folder_move("profile_picture", "uploads/profile_picture");
							folder_move("restore_backup", "uploads/restore_backup");
						}
						
						$sql_file_name = 'sql/install.sql';
						$sqls = file($sql_file_name);	
						$count = count($sqls);
						$language_sqls = array();
						//Language Files
						foreach($lan_file_array as $language){
							$language_sqls[$language] = array();
							$lang = array();
							include_once("./application/language/$language/main_lang.php");
							$sql = "SELECT l_index,l_value FROM ".$dbprefix."language_data WHERE l_name='".$language."';";
							$database_array=array();
							if (mysqli_query($con,$sql)){
								while($row = mysqli_fetch_assoc($result)) {
									 $database_array[$row['l_index']] = $row['l_value'];
								}
							}
							foreach($lang as $key =>$l){
								if(!array_key_exists($key,$database_array)){
									$query="INSERT INTO ".$dbprefix."language_data (l_name,l_index,l_value) values('$language','$key',\"$l\");";
									if(mb_detect_encoding($query, "UTF-8", "UTF-8, ISO-8859-9") != "UTF-8"){
										$query = utf8_encode($query);
									}
									$language_sqls[$language][]=$query;
								}
							}
						}
						
						
						
						
						?>
						<script type="text/javascript">
						$("#continue_form").hide();
						$("#step").html("Creating Tables");
						$("#progress").val(0);
						var install_sqls = <?php echo json_encode($sqls); ?>;
						var language_sqls = [];
						<?php foreach($lan_file_array as $language){?>
							language_sqls['<?=$language;?>'] =  <?php echo json_encode($language_sqls[$language]); ?>;
						<?php } ?>
						jQuery.each( install_sqls, function( i, sql) {
							$.ajax({url: "install_functions.php", data: { action: 'install_sql' , sql :sql,server: '<?=$server;?>', username: '<?=$username;?>', password: '<?=$password;?>',dbname:'<?=$dbname;?>',dbprefix:'<?=$dbprefix;?>'}, success: function(result){
								if(result != ''){
									result =  $("#install_logs").val() + result + '\n';
									$("#install_logs").val(result);
									var $textarea = $("#install_logs");
									$textarea.scrollTop($textarea[0].scrollHeight);
									
								}
								progress = parseInt($("#progress").val());
								progress = progress + 1;
								$("#progress").val(progress);
								var total_queries = <?=$count;?>;
								$("#myBar").width(parseInt(progress/total_queries*100)+ '%');
								if(progress == total_queries){
									$("#step").html("Loading Language File");
									var index = $("#index").val();
									var languages = <?php echo json_encode($lan_file_array); ?>;
									language = languages[index];
									read_language_files(language);
									
									//$("#continue_form").show();
								}
							}});
						});
						
						
						function read_language_files(language){
							$("#step").html("Loading Language File : "+language);
							$("#progress").val(0);
							var install_sqls = language_sqls[language];
							
							jQuery.each( install_sqls, function( i, sql) {
								
								$.ajax({url: "install_functions.php", data: { action: 'install_sql' , sql :sql,server: '<?=$server;?>', username: '<?=$username;?>', password: '<?=$password;?>',dbname:'<?=$dbname;?>',dbprefix:'<?=$dbprefix;?>'}, success: function(result){
									if(result != ''){
										result =  $("#install_logs").val() + result + '\n';
										$("#install_logs").val(result);
										var $textarea = $("#install_logs");
										$textarea.scrollTop($textarea[0].scrollHeight);
										
									}
									progress = parseInt($("#progress").val());
									progress = progress + 1;
									$("#progress").val(progress);
									
									var total_queries = language_sqls[language].length;
									$("#myBar").width(parseInt(progress/total_queries*100)+ '%');
									if(progress == total_queries){
										var index = parseInt($("#index").val());
										index++; 
										$("#index").val(index);
										var languages = <?php echo json_encode($lan_file_array); ?>;
										console.log(index);
										console.log(languages.length);
										
										if(index < languages.length){
											language = languages[index];
											read_language_files(language)
										}else{
											$("#step").html("Installation Complete");
											$("#continue_form").show();
										}
										
									}
								}});
							});
							
						}
						</script>
						<?php 
					}elseif ($_REQUEST["step"] == 3) {
						/************************************************************
						** Step 3 - Ask for System administrator Username and Password
						*************************************************************/
						$server = $_POST["server"];
						$username = $_POST["username"];
						$password = $_POST["password"];
						$dbname = $_POST["dbname"];
						$dbprefix = $_POST["dbprefix"];
						display_system_admin_form("",$server,$username,$password,$dbname,$dbprefix);
					}elseif ($_REQUEST["step"] == 4) {
						/************************************************************
						** Step 3 - Create System Administrator
						*************************************************************/
						$dbprefix = $_POST["dbprefix"];
						$username = $_POST["username"];
						$password = base64_encode($_POST["password"]);
						$dbname = $_POST["dbname"];
						$server = $_POST["server"];
						$mysql_username = $_POST["mysql_username"];
						$mysql_password = $_POST["mysql_password"];
						
						
						if($_POST["password"] != $_POST["confirm_password"]){
							$message = "Confirm Password Mismatch";
							display_system_admin_form($message,$server,$mysql_username,$mysql_password,$dbname,$dbprefix);
							exit;
						}
						
						// Edit config/database.php file 
						$sample_database_file = "application/config/sample-database.php";
						$database_file = "application/config/database.php";
						rename($sample_database_file,$database_file);
						
						$line_array = file($database_file);

						for ($i = 0; $i < count($line_array); $i++) {

							if (strstr($line_array[$i], "'hostname' => ")) {
								$line_array[$i] = '	   \'hostname\' => \'' . $server . '\',' . "\r\n";
							}
							if (strstr($line_array[$i], "'username' =>")) {
								$line_array[$i] = '    \'username\' => \'' . $mysql_username . '\',' . "\r\n";
							}
							if (strstr($line_array[$i], "'password' => ")) {
								$line_array[$i] = '    \'password\' => \'' . $mysql_password . '\',' . "\r\n";
							}
							if (strstr($line_array[$i], "'database' => ")) {
								$line_array[$i] = '    \'database\' => \'' . $dbname . '\',' . "\r\n";
							}
							if (strstr($line_array[$i], "'dbprefix' => ")) {
								$line_array[$i] = '    \'dbprefix\' => \'' . $dbprefix . '\',' . "\r\n";
							}
						}
						file_put_contents($database_file, $line_array);
						
						// Edit config/config.php file 
						$sample_config_file = "application/config/sample-config.php";
						$config_file = "application/config/config.php";
						rename($sample_config_file,$config_file);
						set_base_url();
						// Connect to Server 
						$conn = new Database;
						$error_message = $conn->Connection($server, $mysql_username, $mysql_password);
						if($error_message != FALSE){
							display_error($error_message);
						}
						$con = $conn->get_Connection();
											
						$link = mysqli_select_db($con, $dbname );
						if (!$link) {
							$error_message = 'Not connected : ' . mysql_error($con);
							display_form($error_message);
							exit;
						}
						$sql = "INSERT INTO ".$dbprefix."users(name,username,password,level,is_active) VALUES('System Administrator','".$username."','".$password."','System Administrator',1)";
						if (!mysqli_query($con, $sql )) {
							$message = "Error : " . mysqli_error($con);
							display_system_admin_form($message,$server,$mysql_username,$mysql_password,$dbname,$dbprefix);
						}else{
									
							$sql = "UPDATE ".$dbprefix."version SET current_version='$latest_version';";
							//echo $sql;
							if (!mysqli_query($con,$sql)) {
								$message = "Error : " . mysqli_error($con);
							}else{
								?>
								<div class="form_style">
									<a class="btn btn-success square-btn-adjust" title="Goto Application" href="<?php echo application_url()."/index.php/login/cleardata";?>">Continue to Application</a>
								</div>
								<?php
							}
						}
					}
					?>
					</div>
				</div>
			</div>
		</div>
		
    </body>
</html>