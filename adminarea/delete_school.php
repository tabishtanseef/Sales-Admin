<?php
include_once("include/db_connect.php");
session_start();

$id = $_GET['del_id'];
$sal_id = $_GET['sal_id'];

echo "<script>alert($id);<script>";
$sql = "Update school_list SET is_deleted = '1' where id='$id'"; 
if(mysqli_query($conn, $sql)){ 
    echo "<script>alert('Record deleted successfully.');</script>"; 
	$sql2 = "Update contact_person_list SET is_deleted = '1' where school_id='$id'"; 
	if(mysqli_query($conn, $sql2)){ 
		$sql3 = "Update visits SET is_deleted = '1' where school_id='$id'"; 
		if(mysqli_query($conn, $sql3)){
			header ("location:s_list.php?salesman_id=$sal_id");
		}
	}
}
else{ 
    echo "ERROR: Could not able to execute $sql. ". mysqli_error($conn); 
} 
mysqli_close($conn); 

?> 
