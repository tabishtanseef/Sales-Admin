<!DOCTYPE html>
<?php 
session_start();
include_once("include/db_connect.php");
if (!isset($_SESSION['user_id'])) {
header ("location:login.php");
}
$user_id = $_SESSION['user_id'];
$date=date("Y-m-d");
date_default_timezone_set("Asia/Calcutta");

$g = "SELECT id FROM attendance WHERE user_id ='$user_id' AND date='$date'";
$r = mysqli_query($conn,$g);
$ch = mysqli_fetch_array($r);
if (strlen($ch['id']) != 0)
{
	
}
else{
	header ("location:attendance.php");
}



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
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
	<link href="dist/attention.css" rel="stylesheet">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
	<script src="js/date_time.js"></script>   
<style>	

body{
	
	width:100%;
	height:100vh;
}
.overlay1 {
	display: none;
	position: fixed;
	width: 100vw;
	height: 100vh;
	background: rgba(0, 0, 0, 0.7);
	z-index: 998;
	opacity: 0;
	transition: all 0.5s ease-in-out;
}
.overlay1.active {
	display: block;
	opacity: 1;
}
h3{
	color:#FAB016;
}


</style>	
</head>
<body onload="myLoading()">
<script src="dist/attention.js"></script>   
	<div class="overlay"></div>
	<div class="overlay1"></div>
	<div id="loading"></div>
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php include('sidebar.php');?>

        <!-- Page Content  -->
        <div id="content">

            <nav id="upar" class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
                <div class="container-fluid">
					<button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Good Luck Sales</span>
                    </button>
					
                </div>
            </nav>

            <h2 style = "margin-top:60px"></h2>
			<div class="container">
				<div class="row">
					<div class="col-md-12" style="text-align:justify; margin-top:20px; font-size:12px;">
						<h3>Attendance</h3> 
						<b>Step 1 -</b> After a successful log in, the first step is to mark your attendance. Marking attendance is a two way process, first you will have to mark your attendance at the time when you start your day and go out in the field and second when you end your day. Both start and end timing will me recorded. <br>
						<b>Step 2 -</b> After marking your start day attendance you will automatically moves to your home page where you will see certain features of Good Luck Sales App.<br>
						<b>Step 3 -</b> Now we move to our second feature which is your Personal Attendance Register. This section will contain your attendance record with both start and end timing details of each day you have worked.<br>
					</div>
					<div class="col-md-12" style="text-align:justify; margin-top:20px; font-size:12px;">
						<h3>Add School</h3> 
						<b>Step 1 -</b> Next featute is about school, in this section you will have 2 options. First is Add School feature, whenever you visit a school you will have to add that school in your profile. In this you will add School Name, School e-mail, School contact no.(Reception), School address and School city.<br>
						<b>Step 2 -</b> Second option in this category is School List, this section will show you the list of all schools in which you are working. For your ease we have already added some of your school in your profile. If you visit a new school you can add it yourself.<br>
					</div>
					<div class="col-md-12" style="text-align:justify; margin-top:20px; font-size:12px;">	
						<h3>Add Person</h3> 
						<b>Step 1 -</b> Next featute is about contact person, whenever you visit a school and you meet someone then you will have to add them to your profile as well. You will be adding that Person's name, designation, conatct no., e-mail and also the School name. This way you add a person under a school. It is possible to add more than 1 person under 1 school as it is not necessary that you will meet the same person everytime you visit that school.<br>
						<b>Step 2 -</b> Second option in this category is Contact Person List, this section will show you the list of all contact person you have added. For your ease we have already added the contact person of some of your schools. If you meet a new person in a school you can add it yourself.<br>
					</div>
					<div class="col-md-12" style="text-align:justify; margin-top:20px; font-size:12px;">
						<h3>Add Visit</h3> 
						<b>Step 1 -</b> Now comes the most important part where you will be submitting your D.V.R. i.e. Daily Visit Report. You will use the feature of Add Visit in the Good Luck Sales app. You will have to select the city name first and corresponding to that all school in that city will appear and when you select the school all its details will be filled automatically. Next you will have to select the contact person you have met in your visit which you have already added. You will also enter your rest details like information about specimens, your remarks about school etc.<br>
						<b>Step 2 -</b> In this fetaure of add visit you also have an option to set a reminder for your next visit in that particular school. You can select a date for your next visit and also save a reminder message. The reminder will start appearing in your profile 1 week before the actual date. You can check all your reminders by clicking on the bell icon on your homepage.<br>
						<b>Step 3 -</b> My visits section in your profile gives you the access to monitor all your previous visits. They are arranged according to the date and time of your visits.
					</div>
					<div class="col-md-12" style="text-align:justify; margin-top:20px; font-size:12px;">
						<h3>Updating Profile</h3> 
						<b>Step 1 -</b> There is an option for you to change your password in this section which you can change anytime you wish.
					</div>
				</div>
			</div>
        </div>
    </div>

    <div class="overlay"></div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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


</script>
</body>

</html>