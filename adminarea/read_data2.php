<style>
td{
	text-align:center;
}
</style>
<table width="100%" style="border:2px solid;">
<tr>
<th>City</th>
<th>School Name</th>
<th>Board</th>
<th>Strength</th>
<th>Address</th>
<th>Subject</th>
<th>Teacher </th>
<th>Contact No.</th>
<th>Email</th>
<th>Date</th>
<th>Day</th>
<th>Time</th>
</tr>
<?php
session_start();
include_once("include/db_connect.php");
if (!isset($_SESSION['admin_id'])) {
header ("location:login.php");
}
$salesman_id='52';
$sql="select * from qb_school_list where user_id ='$salesman_id'";

$result = mysqli_query($conn,$sql);

$users_arr = array();

while($row = mysqli_fetch_array($result) ){
	$name = $row['school_city'];
	$new = array_push($users_arr, $name);
	$users_arr = array_values(array_unique($users_arr,SORT_REGULAR));
}

//print_r($users_arr);

$new = count($users_arr);
$i = 0;

while($i < $new){
	$sql1 = "select * from qb_visit WHERE city ='$users_arr[$i]' and user_id='$salesman_id'" ;
	$result1 = mysqli_query($conn,$sql1);
	
	$cbse_schools = array();
	$icse_schools = array();
	
	while($row1 = mysqli_fetch_array($result1) ){
		$school_id = $row1['school_id'];
		$board = $row1['board'];
		if($board=='ICSE'){
			array_push($icse_schools, $school_id);
			$icse_schools = array_values(array_unique($icse_schools,SORT_REGULAR));
		}
		else{
			array_push($cbse_schools, $school_id);
			$cbse_schools = array_values(array_unique($cbse_schools,SORT_REGULAR));
		}	
	}
	
	$cbse = count($cbse_schools);
	$icse = count($icse_schools);
	echo "<br><br>";
	//print_r($cbse_schools);
	//print_r($icse_schools);
	$tabish2 = 0;
$tabish = 0;
	while ($tabish<$cbse){
		$sql2 = "select * from qb_visit WHERE school_id='$cbse_schools[$tabish]'" ;
		$result2 = mysqli_query($conn,$sql2);
		while($row2 = mysqli_fetch_array($result2) ){
		$city = $row2['city'];
		$school_name = $row2['school_name'];
		$board = $row2['board'];
		$strength = $row2['strength'];
		$address = $row2['address'];
		$subject = $row2['subject'];
		$t_name = $row2['t_name'];
		$t_num = $row2['t_num'];
		$t_email = $row2['t_email'];
		$date = $row2['date'];
		$day = $row2['day'];
		$time = $row2['time'];
		  echo "<tr >
				<td>$city</td>
				<td>$school_name</td>
				<td>$board</td>
				<td>$strength</td>
				<td>$address</td>
				<td>$subject</td>
				<td>$t_name</td>
				<td>$t_num</td>
				<td>$t_email</td>
				<td>$date</td>
				<td>$day</td>
				<td>$time</td>
				</tr>";
		}
		$tabish++;
	}
	
	while ($tabish2<$icse){
		$sql2 = "select * from qb_visit WHERE school_id='$icse_schools[$tabish2]'" ;
		$result2 = mysqli_query($conn,$sql2);
		while($row2 = mysqli_fetch_array($result2) ){
		$city = $row2['city'];
		$school_name = $row2['school_name'];
		$board = $row2['board'];
		$strength = $row2['strength'];
		$address = $row2['address'];
		$subject = $row2['subject'];
		$t_name = $row2['t_name'];
		$t_num = $row2['t_num'];
		$t_email = $row2['t_email'];
		$date = $row2['date'];
		$day = $row2['day'];
		$time = $row2['time'];
		  echo "<tr >
				<td>$city</td>
				<td>$school_name</td>
				<td>$board</td>
				<td>$strength</td>
				<td>$address</td>
				<td>$subject</td>
				<td>$t_name</td>
				<td>$t_num</td>
				<td>$t_email</td>
				<td>$date</td>
				<td>$day</td>
				<td>$time</td>
				</tr>";
		}
		$tabish2++;
	}
	
	
	
	
	
	
	
	
	$i++;
}


?>
</table>