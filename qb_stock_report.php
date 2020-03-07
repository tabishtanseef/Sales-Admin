<!DOCTYPE html>
<?php 
session_start();
include_once("include/db_connect.php");
if (!isset($_SESSION['user_id'])) {
header ("location:login.php");
}
if(isset($_GET['user_id']))
{
	$_SESSION['user_id'] =$_GET['user_id'];
	
}
$user_id = $_SESSION['user_id'];
if(isset($user_id)){
	$gat ="select * from users where uid ='$user_id'";
	$rat = mysqli_query($conn,$gat);
	$raw = mysqli_fetch_array($rat);
	$user = $raw['user'];
}
$get_attendance="select * from qb_stock where user_id='$user_id'";
	$run_attendance= mysqli_query($conn, $get_attendance);
	$row_attendance=mysqli_fetch_array($run_attendance);
	$user = $row_attendance['user_name'];
	   $id = $row_attendance['id'];
	$cbse1 = $row_attendance['cbse1'];
	$cbse2 = $row_attendance['cbse2'];
	$cbse3 = $row_attendance['cbse3'];
	$cbse4 = $row_attendance['cbse4'];
	$cbse5 = $row_attendance['cbse5'];
	$cbse6 = $row_attendance['cbse6'];
	$cbse7 = $row_attendance['cbse7'];
	$icse1 = $row_attendance['icse1'];
	$icse2 = $row_attendance['icse2'];
	$icse3 = $row_attendance['icse3'];
	$icse4 = $row_attendance['icse4'];
	$icse5 = $row_attendance['icse5'];
	$icse6 = $row_attendance['icse6'];
	$icse7 = $row_attendance['icse7'];
	$icse8 = $row_attendance['icse8'];
	$icse9 = $row_attendance['icse9'];
   $icse10 = $row_attendance['icse10'];
	$cbse1_a = $row_attendance['cbse1_a'];
	$cbse2_a = $row_attendance['cbse2_a'];
	$cbse3_a = $row_attendance['cbse3_a'];
	$cbse4_a = $row_attendance['cbse4_a'];
	$cbse5_a = $row_attendance['cbse5_a'];
	$cbse6_a = $row_attendance['cbse6_a'];
	$cbse7_a = $row_attendance['cbse7_a'];
	$icse1_a = $row_attendance['icse1_a'];
	$icse2_a = $row_attendance['icse2_a'];
	$icse3_a = $row_attendance['icse3_a'];
	$icse4_a = $row_attendance['icse4_a'];
	$icse5_a = $row_attendance['icse5_a'];
	$icse6_a = $row_attendance['icse6_a'];
	$icse7_a = $row_attendance['icse7_a'];
	$icse8_a = $row_attendance['icse8_a'];
	$icse9_a = $row_attendance['icse9_a'];
   $icse10_a = $row_attendance['icse10_a'];
	
	$given_cbse1 = $cbse1_a - $cbse1;
	$given_cbse2 = $cbse2_a - $cbse2;
	$given_cbse3 = $cbse3_a - $cbse3;
	$given_cbse4 = $cbse4_a - $cbse4;
	$given_cbse5 = $cbse5_a - $cbse5;
	$given_cbse6 = $cbse6_a - $cbse6;
	$given_cbse7 = $cbse7_a - $cbse7;
	$given_icse1 = $icse1_a - $icse1;
	$given_icse2 = $icse2_a - $icse2;
	$given_icse3 = $icse3_a - $icse3;
	$given_icse4 = $icse4_a - $icse4;
	$given_icse5 = $icse5_a - $icse5;
	$given_icse6 = $icse6_a - $icse6;
	$given_icse7 = $icse7_a - $icse7;
	$given_icse8 = $icse8_a - $icse8;
	$given_icse9 = $icse9_a - $icse9;
   $given_icse10 = $icse10_a - $icse10;
   
   
	$get="select * from qb_school_list where user_id='$user_id' and school_board='CBSE'";
	$run= mysqli_query($conn, $get);
	$row=mysqli_num_rows($run);
	
	$get1="select * from qb_school_list where user_id='$user_id' and school_board='ICSE'";
	$run1= mysqli_query($conn, $get1);
	$row2=mysqli_num_rows($run1);
	
	$sql1 = "select * from qb_visit WHERE user_id='$user_id'" ;
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
?>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="shortcut icon" href="img/favicon.png">
	<title>Good Luck Sales - Digigoodluck.com</title>
	<meta name="Description" content="Good Luck Sales is a software tool for the salesman working for a publication all over the country, to maintain all the records within the Good Luck Sales app with proper formatting and can deliver daily report precisely and on time.">
	<meta name="Keywords" content="digital, sales, marketing, software, marketing software, e-learning, digital learning, sales software, e-book software, e-books, electronic books, electronic learning, digigoodluck, goodluck, digigoodluck.com, goodluck.com, gl, g, good, luck, bad luck, 2019, 2018, saharanpur, delhi road, publication, good luck publishers, goodluck publication">
    

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/style.css">
	<script src="js/date_time.js"></script>  
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
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
		<button type="button" id="sidebarCollapse" class="btn btn-info">
			<i class="fas fa-align-left"></i>
			<span>Good Luck Sales</span>
		</button>
		
	</div>
</nav>
			<br>
			<br>
			<br>
			<br>
<div class="container-fluid old">

	<div class="row sub" style="margin-top:2%;">
		<div class="col-sm-12 horizontal-scroll">
			<table class="table table-responsive w-100 d-block d-md-table" style="width:100%;">
				<thead>
				<th>CBSE Subjects</th>
				<th>QB Provided</th>
				<th>Given</th>
				<th>Balance</th>
				</thead>
				<tbody>
				<tr>
				<td>English</td>
				<td><?php echo $cbse1_a;?></td>
				<td><?php echo $given_cbse1;?></td>
				<td><?php echo $cbse1;?></td>
				</tr>
				<tr>
				<td>Hindi A</td>
				<td><?php echo $cbse2_a;?></td>
				<td><?php echo $given_cbse2;?></td>
				<td><?php echo $cbse2;?></td>
				</tr>
				<tr>
				<td>Hindi B</td>
				<td><?php echo $cbse3_a;?></td>
				<td><?php echo $given_cbse3;?></td>
				<td><?php echo $cbse3;?></td>
				</tr>
				<tr>
				<td>Math Basic</td>
				<td><?php echo $cbse4_a;?></td>
				<td><?php echo $given_cbse4;?></td>
				<td><?php echo $cbse4;?></td>
				</tr>
				<tr>
				<td>Math Standard</td>
				<td><?php echo $cbse5_a;?></td>
				<td><?php echo $given_cbse5;?></td>
				<td><?php echo $cbse5;?></td>
				</tr>
				<tr>
				<td>Science</td>
				<td><?php echo $cbse6_a;?></td>
				<td><?php echo $given_cbse6;?></td>
				<td><?php echo $cbse6;?></td>
				</tr>
				<tr>
				<td>Social Studies</td>
				<td><?php echo $cbse7_a;?></td>
				<td><?php echo $given_cbse7;?></td>
				<td><?php echo $cbse7;?></td>
				</tr>
				</tbody>
			</table>
			</div>
		</div>
		<div class="row sub" style="margin-top:2%;">
		<div class="col-sm-12 horizontal-scroll">
			<table class="table table-responsive w-100 d-block d-md-table" style="width:100%;">
				<thead>
				<th>ICSE Subjects</th>
				<th>QB Provided</th>
				<th>Given</th>
				<th>Balance</th>
				</thead>
				<tbody>
				<tr>
				<td>Biology</td>
				<td><?php echo $icse1_a;?></td>
				<td><?php echo $given_icse1;?></td>
				<td><?php echo $icse1;?></td>
				</tr>
				<tr>
				<td>Chemistry</td>
				<td><?php echo $icse2_a;?></td>
				<td><?php echo $given_icse2;?></td>
				<td><?php echo $icse2;?></td>
				</tr>
				<tr>
				<td>Computer</td>
				<td><?php echo $icse3_a;?></td>
				<td><?php echo $given_icse3;?></td>
				<td><?php echo $icse3;?></td>
				</tr>
				<tr>
				<td>Geography</td>
				<td><?php echo $icse4_a;?></td>
				<td><?php echo $given_icse4;?></td>
				<td><?php echo $icse4;?></td>
				</tr>
				<tr>
				<td>History & Civics</td>
				<td><?php echo $icse5_a;?></td>
				<td><?php echo $given_icse5;?></td>
				<td><?php echo $icse5;?></td>
				</tr>
				<tr>
				<td>English Literature</td>
				<td><?php echo $icse6_a;?></td>
				<td><?php echo $given_icse6;?></td>
				<td><?php echo $icse6;?></td>
				</tr>
				<tr>
				<td>English Language</td>
				<td><?php echo $icse7_a;?></td>
				<td><?php echo $given_icse7;?></td>
				<td><?php echo $icse7;?></td>
				</tr>
				<tr>
				<td>Math</td>
				<td><?php echo $icse8_a;?></td>
				<td><?php echo $given_icse8;?></td>
				<td><?php echo $icse8;?></td>
				</tr>
				<tr>
				<td>Physics</td>
				<td><?php echo $icse9_a;?></td>
				<td><?php echo $given_icse9;?></td>
				<td><?php echo $icse9;?></td>
				</tr>
				<tr>
				<td>Hindi</td>
				<td><?php echo $icse10_a;?></td>
				<td><?php echo $given_icse10;?></td>
				<td><?php echo $icse10;?></td>
				</tr>
				</tbody>
			</table>
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