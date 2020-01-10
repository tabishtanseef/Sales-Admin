<?php
include_once("include/db_connect.php");
session_start();

$id = $_GET['del_id'];
 
echo "<script>alert($id);<script>";

$sql = "DELETE FROM visits WHERE id='$id'"; 
if(mysqli_query($conn, $sql)){ 
    echo "<script>alert('Record deleted successfully.');</script>"; 
	header ("location:visit_report.php");
}  
else{ 
    echo "ERROR: Could not able to execute $sql. ". mysqli_error($conn); 
} 
mysqli_close($conn); 

?> 
