<!DOCTYPE HTML>
<?php 
ob_start();
include_once("include/db_connect.php");
session_start();
if(!isset($_SESSION['user_id'])) {
	header("Location: login.php");
}
$error = false;

if (isset($_POST['start_day'])) {
	
	$user_id=$_SESSION['user_id'];
	$user_name=$_SESSION['user_name'];
	$date=date("Y-m-d");
	
	date_default_timezone_set("Asia/Calcutta");
	
	$currentTimeinSeconds = date("h:i:s");  
	$timestamp = strtotime($date);
	$day = date('l', $timestamp);
	
	$g = "SELECT id FROM attendance WHERE user_id ='$user_id' AND date='$date'";
	$r = mysqli_query($conn,$g);
	$ch = mysqli_fetch_array($r);
	$big = $ch['id'];
	if (strlen($ch['id']) != 0)
	{
	  $error_message = "Day already started!";
	   
	}	
	else{
	if (!$error) {
	
		if(mysqli_query($conn, "INSERT INTO attendance( user_id, user_name, date, start_time, day) VALUES('" . $user_id . "', '" . $user_name . "', '". $date ."', '". $currentTimeinSeconds ."', '". $day ."' )")) {
			$success_message = "Day Started";
		} else {
			$error_message = "Error in registering...Please try again later!";
		}
	}
	}
}
if (isset($_POST['end_day'])) {
	
	$user_id=$_SESSION['user_id'];
	$user_name=$_SESSION['user_name'];
	$date=date("Y-m-d");
	date_default_timezone_set("Asia/Calcutta");
	$currentTimeinSeconds = date("h:i:s"); 
	$g = "SELECT id FROM attendance WHERE user_id ='$user_id' AND date='$date'";
	$r = mysqli_query($conn,$g);
	$ch = mysqli_fetch_array($r);
	echo $ch['id'];
	if (strlen($ch['id']) == 0)
	{
		$error_message = "Your day has not started!";
	}	
	else{
		$g = "SELECT end_time FROM attendance WHERE user_id ='$user_id' AND date='$date'";
		$r = mysqli_query($conn,$g);
		$ch = mysqli_fetch_array($r);
		echo $ch['end_time'];
		if (strlen($ch['end_time']) != 0)
		{
			$error_message = "Your day has already ended!";
			
		}
		else{
		if (!$error) {
			if(mysqli_query($conn, "Update attendance SET end_time ='". $currentTimeinSeconds ."' where user_id = '$user_id' AND date= '$date'")) {
				$success_message = "Day Ended";
			} else {
				$error_message = "Error in registering...Please try again later!";
			}
		}
		}
	}
}

?>

<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title></title>

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
  
</head>
<body onload="myLoading()">


<div class="overlay"></div>
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
			<?php 
			if (isset($success_message)) {
			echo "<div class='alert alert-success'>
				<strong> $success_message </strong>
			</div>";
			} 
			else if (isset($error_message)) {
			 echo "<div class='alert alert-danger'>
				<strong>$error_message </strong>
			</div>";
			} ?>
			<form role="form" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
				<fieldset>
					<legend>Mark Your Attendance</legend>


					<div class="form-group">
						<input type="submit" name="start_day" value="Start Day" class="btn" style="background:#fab017; font-weight:bold;" />
					</div>
					<div class="form-group">
						<input type="submit" name="end_day" value="End Day" class="btn" style="background:#fab017; font-weight:bold;" />
					</div>
				</fieldset>
			</form>
			
			
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