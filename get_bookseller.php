<?php
include_once("include/db_connect.php");
session_start();

$state = $_POST['state'];   
$city = $_POST['city'];  
$u_id = $_SESSION['user_id'];

$sql = "select * from bookseller where state ='$state' AND city ='$city' AND user_id='$u_id' order by name";

$result = mysqli_query($conn,$sql);

$users_arr = array();

while($row = mysqli_fetch_array($result) ){
    $id = $row['id'];
    $name = $row['name'];
    $address = $row['address'];
    $email = $row['email'];
    $num = $row['num'];
    $users_arr[] = array("id" => $id, "name" => $name, "address" => $address, "num" => $num, "email" => $email);
}

// encoding array to json format
echo json_encode($users_arr);
?> 