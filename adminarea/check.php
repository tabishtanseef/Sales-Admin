<?php
include_once("include/db_connect.php");

$get_attendance="select * from school_list order by school_name";

$run_attendance= mysqli_query($conn, $get_attendance);
$n=1;
?>
<style>
td{
	padding:20px;
}
</style>

<table>
<?php
while($row_attendance=mysqli_fetch_array($run_attendance))
	{
		$salesman_id = $row_attendance['user_id'];
		$salesman = $row_attendance['user_name'];
		$school_id = $row_attendance['id'];
		$school_name = $row_attendance['school_name'];
		$total_visits = $row_attendance['total_visits'];
		$is_deleted = $row_attendance['is_deleted'];
		
		$sql21 = "select * from visits WHERE school_id = '$school_id' and is_deleted='0'" ;
		$result21 = mysqli_query($conn,$sql21);
		$j1 = mysqli_num_rows ( $result21 );
		if($total_visits==$j1){
			$black = "True";
		}
		else{
			$black = "False";
		}
		
		if($is_deleted==0){
		echo "<tr>
		<td>$n</td>
		<td>$salesman</td>		
		<td>$school_name</td>
		<td>$total_visits</td>
		<td>$j1</td>
		<td>$black</td>
		</tr>";
	  $n++;
		}
	}	

?>
</table>