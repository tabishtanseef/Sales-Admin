<!DOCTYPE HTML>
<?php 
ob_start();
include_once("include/db_connect.php");
session_start();
if(!isset($_SESSION['user_id'])) {
	header("Location: login.php");
}
$error = false;
$user_id=$_SESSION['user_id'];
	$user_name=$_SESSION['user_name'];
	$date=date("Y-m-d");
	date_default_timezone_set("Asia/Calcutta");
	
	$currentTimeinSeconds = date("h:i:s");  
	$timestamp = strtotime($date);
	$day = date('l', $timestamp);

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
	<link href="dist/attention.css" rel="stylesheet">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
	<style>
	.hidden{display:none;}
	.new-alert {
		background-color: #143642;
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
	</style>
</head>
<body onload="myLoading()">
<script src="dist/attention.js"></script>

<div class="overlay"></div>
<div class="overlay1"></div>
<div class="container" style="min-height:500px;">
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

        </div>
    </div>
<br>
<br>
<br>

<div class="container out"  >
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well">
			<div class="demo">
			</div>
			
				<fieldset>
					<legend>Mark Your Attendance</legend>
					<div class="form-group">
						<input type="submit" id="start_day" name="start_day" value="Start Day" class="btn" style="background:#fab017; font-weight:bold;" />
					</div>
					<div class="form-group">
						<input type="submit" id="end_day" name="end_day" value="End Day" class="btn" style="background:#fab017; font-weight:bold;" />
					</div>
				</fieldset>
			
			
		</div>
	</div>	
</div>
</div>

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
			
			/*$("#start_day").click(function(){
				var user_id = "<?php echo $_SESSION['user_id']; ?>";
				var user_name = "<?php echo $_SESSION['user_name']; ?>";
				var date = "<?php echo $date; ?>";
				var start_time = "<?php echo $currentTimeinSeconds; ?>";
				var day = "<?php echo $day; ?>";
				var type= "start";
				$.ajax({
					url: 'mark_attendance.php',
					type: 'POST',
					data: {'user_id':user_id,'user_name':user_name,'date':date,'start_time':start_time,'day':day,'type':type},
					dataType: 'json',
					success:function(response){

						var len = response.length;

						var message = response[0]['message'];
						alert(message);
						
					}
				});
			});

			$("#end_day").click(function(){
				var user_id = "<?php echo $_SESSION['user_id']; ?>";
				var user_name = "<?php echo $_SESSION['user_name']; ?>";
				var date = "<?php echo $date; ?>";
				var end_time = "<?php echo $currentTimeinSeconds; ?>";
				var day = "<?php echo $day; ?>";
				var type= "end";
				$.ajax({
					url: 'mark_attendance.php',
					type: 'POST',
					data: {'user_id':user_id,'user_name':user_name,'date':date,'end_time':end_time,'day':day,'type':type},
					dataType: 'json',
					success:function(response){

						var len = response.length;

						var message = response[0]['message'];
						alert(message);
						
					}
				});
			});*/
			
        });

document.querySelector('#start_day').addEventListener('click', function() {
		var user_id = "<?php echo $_SESSION['user_id']; ?>";
		var user_name = "<?php echo $_SESSION['user_name']; ?>";
		var date = "<?php echo $date; ?>";
		var start_time = "<?php echo $currentTimeinSeconds; ?>";
		var day = "<?php echo $day; ?>";
		var type= "start";
		$.ajax({
			url: 'mark_attendance.php',
			type: 'POST',
			data: {'user_id':user_id,'user_name':user_name,'date':date,'start_time':start_time,'day':day,'type':type},
			dataType: 'json',
			success:function(response){
				console.log(response[0]['message']);
				$('.overlay1').addClass('active');
				new Attention.Alert({
					title: 'Start Day',
					content: response[0]['message'],
					afterClose: () => {
                        $('.overlay1').removeClass('active');
						window.location="index.php";
                    }
				});
			}
		});
	});
			
document.querySelector('#end_day').addEventListener('click', function() {
		var user_id = "<?php echo $_SESSION['user_id']; ?>";
		var user_name = "<?php echo $_SESSION['user_name']; ?>";
		var date = "<?php echo $date; ?>";
		var end_time = "<?php echo $currentTimeinSeconds; ?>";
		var day = "<?php echo $day; ?>";
		var type= "end";
		$.ajax({
			url: 'mark_attendance.php',
			type: 'POST',
			data: {'user_id':user_id,'user_name':user_name,'date':date,'end_time':end_time,'day':day,'type':type},
			dataType: 'json',
			success:function(response){
				console.log(response[0]['message']);
				$('.overlay1').addClass('active');
				new Attention.Alert({
					title: 'End Day',
					content: response[0]['message'],
					afterClose: () => {
                        $('.overlay1').removeClass('active');
						window.location="index.php";
                    }
				});
			}
		});
	});
function myLoading(){
	$('#loading').css('display','none');
}


    
</script>
</body>

</html>