<?php
$hostname = 'http://localhost/Projects/NewsPortal';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "NewsPortal"; 


$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
