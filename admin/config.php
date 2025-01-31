<?php
$hostname = 'http://localhost/Projects/TechTalk';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TechTalk"; 


$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
