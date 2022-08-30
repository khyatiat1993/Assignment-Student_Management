<?php
/*MySQL database connection for iCloudEMS Test*/

$server = "localhost";
$user = "root";
$password = "";
$database = "students";

// Create connection
$connect = new mysqli($server, $user, $password, $database);
// Check connection
if ($connect->connect_error) {
  die("Connection failed: " . $connect->connect_error);
}

?>
