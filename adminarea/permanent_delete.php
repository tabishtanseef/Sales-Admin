<?php
include_once("include/db_connect.php");
session_start();

$id = $_GET['del_id'];
$sal_id = $_GET['sal_id'];

echo "<script>alert($id);<script>";
$sql = "DELETE from school_list where id='$id'"; 
if(mysqli_query($conn, $sql)){ 
    echo "<script>alert('Record deleted successfully.');</script>"; 
	$sql2 = "DELETE from contact_person_list where school_id='$id'"; 
	if(mysqli_query($conn, $sql2)){ 
		$sql3 = "DELETE from visits where school_id='$id'"; 
		if(mysqli_query($conn, $sql3)){
			header ("location:drop_list.php?salesman_id=$sal_id");
		}
	}
}
else{ 
    echo "ERROR: Could not able to execute $sql. ". mysqli_error($conn); 
} 
mysqli_close($conn); 

?> 
