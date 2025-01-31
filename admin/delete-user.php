<?php
include "config.php";
$eid = $_GET['id'];

$sql= "delete from `user` where user_id='$eid'";
$data= mysqli_query($conn,$sql);
if($data){
    header("Location: users.php"); // Redirect to users page

}


?>
