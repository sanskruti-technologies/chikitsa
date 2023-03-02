<?php 

$server = $_POST['server'];
$username = $_POST['username'];
$password = $_POST['password'];
$dbname = $_POST['dbname'];
$dbprefix = $_POST['dbprefix'];

$createdb = $_POST['createdb'];

$con = mysqli_connect($server, $username, $password);

if ($createdb == 1){
    mysqli_query($con,"CREATE DATABASE $dbname");
}
mysqli_select_db($con,$dbname);

//Run SQLs

$sqls = file('../sql/install/createtables.sql');
$query= "";
foreach($sqls as $sql){
    $statement = str_replace("%dbprefix%",$dbprefix,$sql);
    $query .= $statement;
}
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


$sqls = file('../sql/install/createviews.sql');
$query= "";
foreach($sqls as $sql){
    $statement = str_replace("%dbprefix%",$dbprefix,$sql);
    $query .= $statement;
}
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


$sqls = file('../sql/install/insertdata.sql');
$query= "";
foreach($sqls as $sql){
    $statement = str_replace("%dbprefix%",$dbprefix,$sql);
    $query .= $statement;
}
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

$sqls = file('../sql/install/english.sql');
$query= "";
foreach($sqls as $sql){
    $statement = str_replace("%dbprefix%",$dbprefix,$sql);
    $query .= $statement;
}
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
?>