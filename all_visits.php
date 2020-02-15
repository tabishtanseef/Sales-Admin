<!DOCTYPE html>
<?php 
session_start();
include_once("include/db_connect.php");
if (!isset($_SESSION['user_id'])) {
header ("location:login.php");
}

?>

<html lang="en">
<head>
	<link rel="shortcut icon" href="img/favicon.png">
	<title>Good Luck Sales - Digigoodluck.com</title>
	<meta name="Description" content="Good Luck Sales is a software tool for the salesman working for a publication all over the country, to maintain all the records within the Good Luck Sales app with proper formatting and can deliver daily report precisely and on time.">
	<meta name="Keywords" content="digital, sales, marketing, software, marketing software, e-learning, digital learning, sales software, e-book software, e-books, electronic books, electronic learning, digigoodluck, goodluck, digigoodluck.com, goodluck.com, gl, g, good, luck, bad luck, 2019, 2018, saharanpur, delhi road, publication, good luck publishers, goodluck publication">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="css/sidebar.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/date_time.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
	<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
  
	<style>	
	th, td{
	text-align:center;
	font-size:11px;
	}
	h2, th{
	color:#E85A4F;
	}
	.table-responsive {
		display:block;
		min-width: rem-calc(1500);
	}
	.sub{
	width:auto;
	background:white;
	margin:10px;
	box-shadow:3px 3px 3px #aaa;
	border:2px solid #AAA;
	padding-top:15px;
	}
	.horizontal-scroll {
	  overflow: hidden;
	  overflow-x: auto;
	  clear: both;
	  width: 100%;
	}

	</style>
</head>
<body>
<?php include('sidebar.php');?>
<div class="overlay"></div>
<nav id="upar" class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
	<div class="container-fluid">
		<button style="background:#30A2B8; font-size:15px;" type="button" id="sidebarCollapse" class="btn btn-info">
			<i class="fas fa-align-left"></i>
			<span >Good Luck Sales</span>
		</button>		
	</div>
</nav>
<div class="container">
  <h2>List of all</h2>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">School Visits</a></li>
    <li><a data-toggle="tab" href="#menu1">Bookseller Visits</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
		<div class="row sub" style="margin-top:2%;">
		<div class="col-sm-12 horizontal-scroll">
			<table class="table table-responsive w-100 d-block d-md-table" style="width:100%;">
				<thead>
				<th>Sr. No.</th>
				<th>Date</th>
				<th>Time</th>
				<th>Day</th>
				<th>School Name</th>
				<th>School City</th>
				<th>Board</th>
				<th>Strength</th>
				<th>Contact Person</th>
				<th>Contact No.</th>
				<th>Supply Through</th>
				<th>Specimen Given</th>
				<th>Specimen Required</th>
				<th>School Comment</th>
				<th>Your Comment</th>
				</thead>
				<tbody>
				<?php
				$n=1;
				$user_id=$_SESSION['user_id'];
				$user_name=$_SESSION['user_name'];
				$get_attendance="select * from visits where user_id='$user_id' and is_deleted='0' order by date DESC, id DESC";
				$run_attendance= mysqli_query($conn, $get_attendance);
				 
				while($row_attendance=mysqli_fetch_array($run_attendance))
				{
					$date = $row_attendance['date'];
					$time = $row_attendance['time'];
					$day = $row_attendance['day'];
					$s_name = $row_attendance['school_name'];
					$s_city = $row_attendance['school_city'];
					$board = $row_attendance['board'];
					$strength = $row_attendance['strength'];
					$c_person = $row_attendance['contact_person'];
					$c_person_no = $row_attendance['contact_person_no'];
					$supply = $row_attendance['supply_through'];
					$specimen_given = $row_attendance['specimen_given'];
					$specimen_required = $row_attendance['specimen_required'];
					$school_comment = $row_attendance['school_comment'];
					$your_comment = $row_attendance['your_comment'];
					$date = date("d-M-Y", strtotime($date));
					echo "<tr>
					<td>$n</td>
					<td>$date</td>
					<td>$time</td>
					<td>$day</td>
					<td>$s_name</td>
					<td>$s_city</td>
					<td>$board</td>
					<td>$strength</td>
					<td>$c_person</td>
					<td>$c_person_no</td>
					<td>$supply</td>
					<td>$specimen_given</td>
					<td>$specimen_required</td>
					<td>$school_comment</td>
					<td>$your_comment</td>
					</tr>
					
					";
				  $n++; 
				}
				?>
			</tbody>
			</table>
		</div>
		</div>
    </div>
    <div id="menu1" class="tab-pane fade">
		<div class="row sub" style="margin-top:2%;">
		<div class="col-sm-12 horizontal-scroll">
			<table class="table table-responsive w-100 d-block d-md-table" style="width:100%;">
				<thead>
				<th>Sr. No.</th>
				<th>Date</th>
				<th>Time</th>
				<th>Day</th>
				<th>Name</th>
				<th>Contact No.</th>
				<th>Email</th>
				<th>Address</th>
				<th>City</th>
				<th>Purpose</th>
				<th>Payment GL</th>
				<th>Payment VP</th>
				<th>Remarks</th>
				</thead>
				<tbody>
				<?php
				$n=1;
				$user_id=$_SESSION['user_id'];
				$user_name=$_SESSION['user_name'];
				$get_attendance="select * from bookseller_visit where user_id='$user_id' order by date DESC, id DESC";
				$run_attendance= mysqli_query($conn, $get_attendance);
				 
				while($row_attendance=mysqli_fetch_array($run_attendance))
				{
					$date = $row_attendance['date'];
					$time = $row_attendance['time'];
					$day = $row_attendance['day'];
					$name = $row_attendance['name'];
					$num = $row_attendance['num'];
					$email = $row_attendance['email'];
					$address = $row_attendance['address'];
					$city = $row_attendance['city'];
					$purpose = $row_attendance['purpose'];
					$payment_gl = $row_attendance['payment_gl'];
					$payment_vp = $row_attendance['payment_vp'];
					$remark = $row_attendance['remarks'];
					$date = date("d-M-Y", strtotime($date));
					echo "<tr>
					<td>$n</td>
					<td>$date</td>
					<td>$time</td>
					<td>$day</td>
					<td>$name</td>
					<td>$num</td>
					<td>$email</td>
					<td>$address</td>
					<td>$city</td>
					<td>$purpose</td>
					<td>$payment_gl</td>
					<td>$payment_vp</td>
					<td>$remark</td>
					</tr>";
				  $n++; 
				}
				?>
			</tbody>
			</table>
		</div>
		</div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<!-- jQuery Custom Scroller CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

<script type="text/javascript">
	$(document).ready(function () {
		$("#sidebar").mCustomScrollbar({
			theme: "minimal"
		});

		$('#dismiss, .overlay').on('click', function () {
			$('#sidebar').removeClass('active');
			$('.overlay').removeClass('active');
			 $('#upar').addClass('fixed-top');
		});

		$('#sidebarCollapse').on('click', function () {
			$('#sidebar').addClass('active');
			$('#upar').removeClass('fixed-top');
			$('.overlay').addClass('active');
			$('.collapse.in').toggleClass('in');
			$('a[aria-expanded=true]').attr('aria-expanded', 'false');
		});
	});


function myLoading(){
$('#loading').css('display','none');

}

</script>
</body>
</html>
