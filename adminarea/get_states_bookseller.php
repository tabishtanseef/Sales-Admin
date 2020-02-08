<?php
include_once("include/db_connect.php");
session_start();

$state = $_GET['shahrukh'];    

$sql = "select * from bookseller where state='$state' order by name";

$result = mysqli_query($conn,$sql);

$users_arr = array();

while($row = mysqli_fetch_array($result) ){
    $name = $row['name'];
    $users_arr[] = array("name" => $name);
}

// encoding array to json format
echo json_encode($users_arr);
?> 
