<?php
include_once("include/db_connect.php");
session_start();

$id = $_GET['del_id'];

$sql = "Update qb_school_list SET is_deleted = '1' where id='$id'"; 
$users_arr = array();

if(mysqli_query($conn, $sql)){ 
    $sql2 = "Update qb_visit SET is_deleted = '1' where school_id='$id'"; 
	if(mysqli_query($conn, $sql2)){ 
		$name = 'done';
		$users_arr[] = array("message" => $name);	
	}
}
echo json_encode($users_arr);
?> 
