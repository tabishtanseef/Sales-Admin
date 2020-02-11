<?php
include_once("include/db_connect.php");
session_start();

$id = $_GET['del_id'];
$sal_id = $_GET['sal_id'];
 
echo "<script>alert($id);<script>";

$sql = "Update bookseller_visit SET is_deleted = '1' WHERE id='$id'"; 
if(mysqli_query($conn, $sql)){ 
    echo "<script>alert('Record deleted successfully.');</script>"; 
	header ("location:b_visits_report.php?salesman_id=$sal_id");
}  
else{ 
    echo "ERROR: Could not able to execute $sql. ". mysqli_error($conn); 
} 
mysqli_close($conn); 

?> 
