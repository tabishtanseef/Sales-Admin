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
	th{
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
    <li class="active"><a data-toggle="tab" href="#home">School</a></li>
    <li><a data-toggle="tab" href="#menu1">Contact Person</a></li>
    <li><a data-toggle="tab" href="#menu2">Bookseller</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
		<div class="row sub" style="margin-top:2%;">
		<div class="col-sm-12 horizontal-scroll">
			<table class="table table-responsive w-100 d-block d-md-table" style="width:100%;">
				<thead>
				<th>Sr. No.</th>
				<th>School Name</th>
				<th>School Id</th>
				<th>School Board</th>
				<th>School Strength</th>
				<th>School Email</th>
				<th>Contact No.</th>
				<th>School Address</th>
				<th>School City</th>
				<th>School State</th>
				</thead>
				<tbody>
				 <?php
				 $n=1;
				 $user_id=$_SESSION['user_id'];
				$user_name=$_SESSION['user_name'];
				$get_attendance="select * from school_list where user_id='$user_id' order by school_name";
				$run_attendance= mysqli_query($conn, $get_attendance);
				 
				while($row_attendance=mysqli_fetch_array($run_attendance))
				{
					$s_name = $row_attendance['school_name'];
					$s_code = $row_attendance['id'];
					$s_board = $row_attendance['school_board'];
					$s_strength = $row_attendance['school_strength'];
					$s_email = $row_attendance['school_email'];
					$s_contact = $row_attendance['school_contact'];
					$s_address = $row_attendance['school_address'];
					$s_state = $row_attendance['school_state'];
					$s_city = $row_attendance['school_city'];
					
					echo "<tr>
					<td>$n</td>
					<td>$s_name</td>
					<td>$s_code</td>
					<td>$s_board</td>
					<td>$s_strength</td>
					<td>$s_email</td>
					<td>$s_contact</td>
					<td>$s_address</td>
					<td>$s_city</td>
					<td>$s_state</td>
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
					<th>School Name</th>
					<th>Person Name</th>
					<th>Person Email</th>
					<th>Contact No.</th>
					<th>Designation</th>
					<th>School City</th>
					<th>School State</th>
				</thead>
				<tbody>
					<?php
					$n=1;
					$user_id=$_SESSION['user_id'];
					$user_name=$_SESSION['user_name'];
					$get_attendance="select * from contact_person_list where user_id='$user_id'";
					$run_attendance= mysqli_query($conn, $get_attendance);
					 
					while($row_attendance=mysqli_fetch_array($run_attendance))
					{
						$p_name = $row_attendance['p_name'];
						$p_email = $row_attendance['p_email'];
						$p_num = $row_attendance['p_num'];
						$designation = $row_attendance['designation'];
						$school_state = $row_attendance['school_state'];
						$school_city = $row_attendance['school_city'];
						$school_name = $row_attendance['school_name'];
						
						echo "<tr>
						<td>$n</td>
						<td>$school_name</td>
						<td>$p_name</td>
						<td>$p_email</td>
						<td>$p_num</td>
						<td>$designation</td>
						<td>$school_city</td>
						<td>$school_state</td>
						</tr>";
					  $n++; 
					}
					?>
				</tbody>
			</table>


		</div>
		</div>
    </div>
    <div id="menu2" class="tab-pane fade">
		<div class="row sub" style="margin-top:2%;">
		<div class="col-sm-12 horizontal-scroll">
			<table class="table table-responsive w-100 d-block d-md-table" style="width:100%;">
				<thead>
				<th>Sr. No.</th>
				<th>Name</th>
				<th>Contact No.</th>
				<th>Email</th>
				<th>Address</th>
				<th>School City</th>
				</thead>
				<tbody>
				<?php
				$n=1;
				$user_id=$_SESSION['user_id'];
				$user_name=$_SESSION['user_name'];
				$get_attendance="select * from bookseller where user_id='$user_id' order by name";
				$run_attendance= mysqli_query($conn, $get_attendance);
				 
				while($row_attendance=mysqli_fetch_array($run_attendance))
				{
					$name = $row_attendance['name'];
					$num = $row_attendance['num'];
					$email = $row_attendance['email'];
					$address = $row_attendance['address'];
					$city = $row_attendance['city'];
					
					echo "<tr>
					<td>$n</td>
					<td>$name</td>
					<td>$num</td>
					<td>$email</td>
					<td>$address</td>
					<td>$city</td>
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
