<?php
include_once("include/db_connect.php");
session_start();

$id = $_GET['del_id'];
$s_id = $_GET['s_id'];
$salesman_id = $_GET['salesman_id'];
 
echo "<script>alert($id);<script>";

$sql = "DELETE from visits WHERE id='$id'"; 
if(mysqli_query($conn, $sql)){ 

	if(mysqli_query($conn, "UPDATE school_list SET total_visits = total_visits - 1 WHERE id = '".$s_id."' ")){
		echo "<script>alert('Record deleted successfully.');</script>"; 
		header ("location:visit_report.php?salesman_id=$salesman_id");
	}
}  
else{ 
    echo "ERROR: Could not able to execute $sql. ". mysqli_error($conn); 
} 
mysqli_close($conn); 

?> 
