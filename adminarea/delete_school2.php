<?php
include_once("include/db_connect.php");
session_start();

$id = $_GET['del_id'];

$sql = "Update school_list SET is_deleted = '1' where id='$id'"; 
$users_arr = array();

if(mysqli_query($conn, $sql)){ 
    echo "<script>alert('Record deleted successfully.');</script>"; 
	$sql2 = "Update contact_person_list SET is_deleted = '1' where school_id='$id'"; 
	if(mysqli_query($conn, $sql2)){ 
		$sql3 = "Update visits SET is_deleted = '1' where school_id='$id'"; 
		if(mysqli_query($conn, $sql3)){
			$name = 'done';
			 $users_arr[] = array("message" => $name);
		}
	}
}
echo json_encode($users_arr);

?> 
