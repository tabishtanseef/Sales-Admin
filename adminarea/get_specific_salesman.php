<?php
include_once("include/db_connect.php");
session_start();

$state = $_GET['shahrukh'];    
$bookseller = $_GET['bookseller'];   

$sql = "select * from bookseller where state='$state' AND name='$bookseller' order by user_name";

$result = mysqli_query($conn,$sql);

$users_arr = array();

while($row = mysqli_fetch_array($result) ){
    $name = $row['user_name'];
    $users_arr[] = array("name" => $name);
}

// encoding array to json format
echo json_encode($users_arr);
?> 
