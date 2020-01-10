<?php
include_once("include/db_connect.php");
session_start();

$state = $_POST['state'];   
$city = $_POST['city'];  
$school = $_POST['school'];  
$p_name = $_POST['p_name'];  
$u_id = $_SESSION['salesman_id'];


$sql = "select * from contact_person_list where school_state ='$state' AND school_city ='$city' AND school_name ='$school' AND user_id='$u_id' AND id='$p_name'";

$result = mysqli_query($conn,$sql);

$users_arr = array();

while($row = mysqli_fetch_array($result) ){
    $num = $row['p_num'];
    $users_arr[] = array("num" => $num);
}

// encoding array to json format
echo json_encode($users_arr);
?> 
