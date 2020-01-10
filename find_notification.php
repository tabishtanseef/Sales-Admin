<?php
include_once("include/db_connect.php");
session_start();

$date = $_GET['date'];   
$user_id = $_SESSION['user_id'];  
$sql = "select * from notification WHERE now() BETWEEN notification.r_date AND notification.v_date and user_id ='$user_id'" ;

$result = mysqli_query($conn,$sql);

$users_arr = array();

$i = mysqli_num_rows ( $result );

$users_arr[] = array("total" => $i);

echo json_encode($users_arr);

?>