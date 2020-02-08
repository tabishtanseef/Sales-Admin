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
	header ("location:attendance_and_register.php");
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
td{
	text-align:center;
	padding:10px;
}
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
.attention-component .inner-container p{
    white-space: pre-line;
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
					
                    <button type="button" id="reminder" class="btn btn-info">
                       <img src="img/bel1.png" style="height:25px;">(<span id="noti"></span>)
                    </button>
                </div>
            </nav>

            <h2 style = "margin-top:60px"></h2>
			<div class="container">
			<div class="row">
			<div class="col-md-12">
			<table width="100%">
			<tr>
			<td><a href="attendance_and_register.php"><img src="img/attendance.png" style="width:80%;">
			<br>
			<span>Attendance</span>
			</a></td>
			<td><a href="all_lists.php"><img src="img/register.png" style="width:80%;">
			<!--<td><a href="p_attendance_register.php"><img src="img/schedule.png" style="width:80%;">-->
			<br>
			<span>All Lists</span>
			<!--<span>My Schedule</span>-->
			</a></td>
			</tr>
			<tr>
			<td><a href="add_visit.php"><img src="img/addvisit.png" style="width:80%;">
			<br>
			<span>Add School Visit</span>
			</a></td>
			<td><a href="add_bookseller_visit.php"><img src="img/add_b_visit.png" style="width:80%;">
			<br>
			<span>Add Book Seller Visit</span>
			</a></td>
			</tr>
			<tr>
			<td><a href="add_school.php"><img src="img/add school.png" style="width:80%;">
			<!--<td><a href="add_school.php"><img src="img/neworder.png" style="width:80%;">-->
			<br>
			<span>Add School</span>
			<!--<span>New Orders</span>-->
			</a></td>
			<td><a href="add_bookseller.php"><img src="img/add bookseller.png" style="width:80%;">
			<!--<td><a href="school_list.php"><img src="img/orders.png" style="width:80%;">-->
			<br>
			<span>Add Book Seller</span>
			<!--<span>My Orders</span>-->
			</a></td>
			</tr>
			<tr>
			<td><a href="add_person.php"><img src="img/add person.png" style="width:80%;">
			<!--<td><a href="add_person.php"><img src="img/stock.png" style="width:80%;">-->
			<br>
			<span>Add Contact Person</span>
			</a></td>
			<td><a href="all_visits.php"><img src="img/myvisits.png" style="width:80%;">
			<!--<td><a href="contact_list.php"><img src="img/expense.png" style="width:80%;">-->
			<br>
			<span>My Visits</span>
			</a></td>
			</tr>
			</table>
			</div>
        </div>
    </div>
<audio id="music" autoplay>
  <source src="audio/alert.ogg" type="audio/ogg">
  <source src="audio/alert.m4r" type="audio/m4r">
  <source src="audio/alert.mp3" type="audio/mp3">
</audio>
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
			
			document.getElementById('reminder').click();
			
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

var currentTime =0;

var date = "<?php echo $date; ?>";

function updateCurrentTime(){
currentTime++;
//console.log(currentTime);

$.ajax({
		url: 'find_notification.php',
		type: 'get',
		data: {'date':date },
		dataType: 'json',
		success:function(response){
			
			var id = response[0]['total'];
			$('#noti').text(id);
			
		}
	});
}
	
window.onload = function(e){ 
	updateCurrentTime();
	setInterval(function(){
		updateCurrentTime();
	},60000);
	
}

document.querySelector('#reminder').addEventListener('click', function() {
	
	$.ajax({
		url: 'get_notification.php',
		type: 'get',
		dataType: 'json',
		success:function(response){
			
			var len = response.length;
			var j=1;
			for( var i = 0; i<len; i++, j++){
				var v_date = response[i]['v_date'];
				var school_name = response[i]['school_name'];
				var school_address = response[i]['school_address'];
				var school_city = response[i]['school_city'];
				var contact_person = response[i]['contact_person'];
				var message = response[i]['reminder_message'];
				var ultimate_message = "Date - "+v_date+"\nSchool - "+school_name+" in "+school_city+" "+school_address+"\nMessage - "+message;
				var audio = document.getElementById('music');
				audio.play();
				$('.overlay1').addClass('active');
				new Attention.Alert({
					title: 'Next Visit Reminder - '+j,
					content: ultimate_message,
					afterClose: () => {
						$('.overlay1').removeClass('active');
					}
				});

			}
			
		}
	});
});
</script>
</body>

</html>