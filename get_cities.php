<?php
include_once("include/db_connect.php");
session_start();

$state = $_POST['depart'];   // department id

$sql = "SELECT * FROM citylist WHERE state='$state'";

$result = mysqli_query($conn,$sql);

$users_arr = array();

while($row = mysqli_fetch_array($result) ){
    $name = $row['city_name'];

    $users_arr[] = array( "name" => $name);
}

// encoding array to json format
echo json_encode($users_arr);
?>