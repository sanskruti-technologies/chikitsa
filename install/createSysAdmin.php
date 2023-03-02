<?php 

$server = $_POST['server'];
$username = $_POST['username'];
$password = $_POST['password'];
$dbname = $_POST['dbname'];
$dbprefix = $_POST['dbprefix'];


$admin_username = $_POST['admin_username'];
$admin_password = base64_encode($_POST['admin_password']);

$con = mysqli_connect($server, $username, $password);
mysqli_select_db($con,$dbname);

//Run SQLs
$sql = "INSERT INTO ".$dbprefix."users(name,username,password,level,is_active,prefered_language) VALUES('System Administrator','".$admin_username."','".$admin_password."','System Administrator',1,'english')";
if (!mysqli_query($con, $sql )) {
    $message = "Error : " . mysqli_error($con);
}				

?>