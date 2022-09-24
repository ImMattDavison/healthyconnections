<?php 

$server = "localhost";
$user = "root";
$pass = "";
$database = "healthyconnections";

$conn = mysqli_connect($server, $user, $pass, $database);

if (!$conn) {
    die("<script>alert('Connection Failed.')</script>");
}

// require_once('class.user.php');
// require_once('class.password.php');

?>