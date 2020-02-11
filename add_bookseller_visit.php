<!DOCTYPE HTML>
<?php 
ob_start();
include_once("include/db_connect.php");
session_start();
if(!isset($_SESSION['user_id'])) {
	header("Location: login.php");
}
	$error = false;
	$u_name = $_SESSION['user_name'];
	$u_id = $_SESSION['user_id'];
	$state = $_SESSION['school_state'];
	
if (isset($_POST['add_bookseller_visit'])) {

	$email = strtolower(mysqli_real_escape_string($conn, $_POST['email']));
	$num = mysqli_real_escape_string($conn, $_POST['num']);
	$address = strtoupper(mysqli_real_escape_string($conn, $_POST['address']));
	$purpose = strtoupper(mysqli_real_escape_string($conn, $_POST['purpose']));
	$payment_gl = strtoupper(mysqli_real_escape_string($conn, $_POST['payment_gl']));
	$payment_vp = strtoupper(mysqli_real_escape_string($conn, $_POST['payment_vp']));
	$remarks = strtoupper(mysqli_real_escape_string($conn, $_POST['remarks']));
	$reminder = mysqli_real_escape_string($conn, $_POST['reminder']);
	$date=date("Y-m-d");
	date_default_timezone_set("Asia/Calcutta");
	$currentTimeinSeconds = date("h:i:s");  
	$timestamp = strtotime($date);
	$day = date('l', $timestamp);
	$v_date = mysqli_real_escape_string($conn, $_POST['visit_date']);
	$r_date = date('Y-m-d', strtotime($v_date. ' - 7 days'))."<br>";
	//echo "<script>alert('$state');</script>";
	
	if(!isset($_POST['city'])){
		$error = true;
		$city_error = "Please select a city";
	}
	else{
		$city = mysqli_real_escape_string($conn, $_POST['city']);
	}
	if(!isset($_POST['name'])){
		$error = true;
		$school_error = "Please select a name";
	}
	else{
		$b_id = mysqli_real_escape_string($conn, $_POST['name']);
		$name = mysqli_real_escape_string($conn, $_POST['school']);
	}
	if(!$error){
		
		$g = "SELECT * FROM bookseller_visit WHERE name ='$name' and purpose='$purpose' and city='$city' and payment_gl='$payment_gl' and payment_vp='$payment_vp' and remarks='$remarks'";
		$r = mysqli_query($conn,$g);
		$ch = mysqli_fetch_array($r);
		if (strlen($ch['id']) != 0)
		{
		  $error_message = "This Book Seller Visit is already added!";
		}	
		else{
			if(mysqli_query($conn, "INSERT INTO bookseller_visit(user_id, user_name, b_id, name, email, num, address, state, city, purpose, payment_gl, payment_vp, remarks, date, time, day) VALUES ('". $u_id ."','" . $u_name . "','" . $b_id . "','" . $name . "', '" . $email . "', '" . $num . "', '" . $address . "', '". $state . "','". $city ."','". $purpose ."','". $payment_gl ."','". $payment_vp ."','". $remarks ."','" . $date . "', '". $currentTimeinSeconds ."', '". $day ."')")) {
				$success_message = "Visit Successfully Added!";
			} else {
				$error_message = "Error in Adding...Please try again later!";
			}
			if(isset($v_date)){
				if(mysqli_query($conn, "INSERT INTO notification(user_id, user_name, v_date, r_date, school_name, school_city, school_address, reminder_message) VALUES
				('". $u_id ."','" . $u_name . "','" . $v_date . "','" . $r_date . "','". $name ."', '". $city ."','". $address ."','". $reminder ."')")) {
					
				}
				else {
					
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
	<link rel="shortcut icon" href="img/favicon.png">
	<title>Good Luck Sales - Digigoodluck.com</title>
	<meta name="Description" content="Good Luck Sales is a software tool for the salesman working for a publication all over the country, to maintain all the records within the Good Luck Sales app with proper formatting and can deliver daily report precisely and on time.">
	<meta name="Keywords" content="digital, sales, marketing, software, marketing software, e-learning, digital learning, sales software, e-book software, e-books, electronic books, electronic learning, digigoodluck, goodluck, digigoodluck.com, goodluck.com, gl, g, good, luck, bad luck, 2019, 2018, saharanpur, delhi road, publication, good luck publishers, goodluck publication">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
	<link href="dist/attention.css" rel="stylesheet">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<style>
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
<body>
<script src="dist/attention.js"></script>
<script >
function goSuccess(){
		$('.overlay1').addClass('active');
		new Attention.Alert({
			title: 'ADD NEW BOOK SELLER VISIT',
			content: 'Visit Added Successfully',
			afterClose: () => {
				$('.overlay1').removeClass('active');
			}
		});
	}
function goFailure(){
		$('.overlay1').addClass('active');
		new Attention.Alert({
			title: 'Oops!!',
			content: 'Error in Adding...Please try again later!',
			afterClose: () => {
				$('.overlay1').removeClass('active');
			}
		});
	}
</script>

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
	
<div class="container" style="min-height:300px;">


<div class="container out">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well">
			<form role="form" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
				<fieldset>
					<legend>Add Book Seller Visit</legend>
					<span class="text-success">
					<?php if (isset($success_message))
					{ 
					?>
					<script>
					goSuccess();
					</script>
					<?php
					}
					?>
					</span>
					<span class="text-danger">
					<?php if (isset($error_message)) 
					{ 
					?>
					<script>
					goFailure();
					</script>
					<?php
					}
					?>
					</span>
					
					<div class="form-group">
						<label for="name">City</label>
						<select name="city" id="city" class="form-control" />
						 <option selected disabled >Select City</option>
						<?php
						  $res=mysqli_query($conn,"select * from citylist where state='$state' order by city_name");
						  while($row=mysqli_fetch_array($res))
						  {  
						  ?>
						  <option value="<?php  echo $row ["city_name"]; ?>" ><?php  echo $row ["city_name"]; ?></option>
						  <?php
						  }
						  ?>
						</select>
						<span class="text-danger"><?php if (isset($city_error)) echo $city_error; ?></span>
					</div>
					<div class="form-group">
						<label for="name">Book Seller Name</label>
						<select name="name" id="school" class="form-control" />
						<option selected disabled>Select Name</option>
						</select>
						<span class="text-danger"><?php if (isset($school_error)) echo $school_error; ?></span>
					</div>
					<input type="hidden" name="school" id="school_hidden">
					<div class="form-group">
						<label for="name">Contact No.</label>
						<input type="text" name="num" id="num"  placeholder="Contact No." required value="" class="form-control" />
						<span class="text-danger"></span>
					</div>
					<div class="form-group">
						<label for="name">Email</label>
						<input type="text" name="email" id="email" readonly placeholder="Email" required value="" class="form-control" />
						<span class="text-danger"></span>
					</div>
					<div class="form-group">
						<label for="name">Address</label>
						<input type="text" name="address" id="address" readonly placeholder="Address" required value="" class="form-control" />
						<span class="text-danger"></span>
					</div>
					<div class="form-group">
						<label for="name">Visit Purpose</label>
						<input type="text" name="purpose" placeholder="Enter Purpose" required value="" class="form-control" />
					</div>
					<div class="form-group">
						<label for="name">Payment Recd. GL</label>
						<input type="text" name="payment_gl" placeholder="Payment GL"  value="" class="form-control" />
					</div>
					<div class="form-group">
						<label for="name">Payment Recd. VP</label>
						<input type="text" name="payment_vp" placeholder="Payment VP"  value="" class="form-control" />
					</div>
					<div class="form-group">
						<label for="name">Remarks</label>
						<input type="text" name="remarks" placeholder="Enter Remarks"  value="" class="form-control" />
					</div>
					<div class="form-group">
						<label for="name">Schedule Next Visit</label>
						<input type="date" name="visit_date" placeholder="Next Visit Date"  class="form-control" />
					</div>
					<div class="form-group">
						<label for="name">Reminder</label>
						<input type="text" name="reminder" placeholder="Reminder for next Visit" value="<?php if($error) echo $reminder; ?>" class="form-control" />
					</div>
					<div class="form-group">
						<input type="submit" name="add_bookseller_visit" value="Add Book Seller Visit" class="btn" style="background:#fab017; font-weight:bold;" />
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>
</div>
<br>
<br>
<br>
<br>


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


$("#city").change(function(){
	var city = $(this).val();
	var state = "<?php echo $state; ?>";
	
	$.ajax({
		url: 'get_bookseller.php',
		type: 'POST',
		data: {'state':state,'city':city},
		dataType: 'json',
		success:function(response){

			var len = response.length;
			$("#school").empty();
			$("#school").append("<option disabled selected value=''>Select Book Seller</option>");
			for( var i = 0; i<len; i++){
				var id = response[i]['id'];
				var name = response[i]['name'];

				$("#school").append("<option value='"+id+"'>"+name+"</option>");

			}
		}
	});
});


$("#school").change(function(){
	var school = $(this).val();
	var schoolname = $("#school option:selected").text();
	var state = "<?php echo $state; ?>";
	var city = $('#city').val();
	$("#school_hidden").val(schoolname);
	console.log(school);
	$.ajax({
		url: 'get_bookseller_details.php',
		type: 'POST',
		data: {'state':state,'city':city,'b_id':school},
		dataType: 'json',
		success:function(response){
			
			var len = response.length;
			for( var i = 0; i<len; i++){
				var num = response[i]['num'];
				var email = response[i]['email'];
				var address = response[i]['address'];

				$('#num').val(num);
				$('#email').val(email);
				$('#address').val(address);
			}
		}
	});

});

});


</script>
</body>

</html>