<?php
include_once("include/db_connect.php");
session_start();

$state = $_GET['shahrukh'];   

$sql = "select * from users where school_state='$state'";

$result = mysqli_query($conn,$sql);

$users_arr = array();

while($row = mysqli_fetch_array($result) ){
    $id = $row['uid'];
    $name = $row['user'];
    $users_arr[] = array("id" => $id, "name" => $name);
}

// encoding array to json format
echo json_encode($users_arr);
?> 
