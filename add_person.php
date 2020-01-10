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
if (isset($_POST['add_person'])) {

	$p_name = mysqli_real_escape_string($conn, $_POST['p_name']);
	$p_email = strtolower(mysqli_real_escape_string($conn, $_POST['p_email']));
	$p_num = mysqli_real_escape_string($conn, $_POST['p_num']);
	$designation = strtoupper(mysqli_real_escape_string($conn, $_POST['designation']));
	
	//echo "<script>alert('$state');</script>";
	$g = "SELECT p_name FROM contact_person_list WHERE p_name ='$p_name' AND p_num ='$p_num'";
	$r = mysqli_query($conn,$g);
	$ch = mysqli_fetch_array($r);
	if (strlen($ch['p_name']) != 0)
	{
	  $error_message = "This Person is already Added!";
	}	
	else{
	
	if (!preg_match("/^[a-zA-Z ]+$/",$p_name)) {
		$error = true;
		$pname_error = "Name must contain only alphabets and space";
	}
	/*if (!preg_match("/^[a-zA-Z ]+$/",$designation)) {
		$error = true;
		$designation_error = "Designaton must contain only alphabets and space";
	}
	if (!preg_match('/^\d{10}$/',$p_num)) {
		$error = true;
		$num_error = "Contact No. must contain 10 Digits";
	}
	if(!filter_var($p_email,FILTER_VALIDATE_EMAIL)) {
		$error = true;
		$email_error = "Please Enter Valid Email ID";
		
		
	}*/
	if(!isset($_POST['school_city'])){
		$error = true;
		$city_error = "Please select a city";
	}
	else{
		$school_city = mysqli_real_escape_string($conn, $_POST['school_city']);
	}
	if(!isset($_POST['school_name'])){
		$error = true;
		$school_error = "Please select a school name";
	}
	else{
		$school_id = mysqli_real_escape_string($conn, $_POST['school_name']);
		$school_name = mysqli_real_escape_string($conn, $_POST['school']);
	}
	if(!$error){
		
		$g = "SELECT * FROM contact_person_list WHERE p_name ='$p_name' and school_name='$school_name' and school_city='$school_city'";
		$r = mysqli_query($conn,$g);
		$ch = mysqli_fetch_array($r);
		if (strlen($ch['id']) != 0)
		{
		  echo"<script>alert('This Person is already registered!');</script>";
		}	
		else{
			if(mysqli_query($conn, "INSERT INTO contact_person_list(user_id, user_name, p_name, p_email, p_num, designation, school_state, school_city, school_id, school_name) VALUES
			('". $u_id ."','" . $u_name . "','" . $p_name . "', '" . $p_email . "', '" . $p_num . "', '" . $designation . "', '". $state . "','". $school_city ."','". $school_id ."','". $school_name ."')")) {
				$success_message = "Person Successfully Added!";
			} else {
				$error_message = "Error in Adding...Please try again later!";
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
			title: 'ADD NEW CONTACT PERSON',
			content: 'Person Added Successfully',
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
					<legend>Add Contact Person</legend>
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
						<label for="name">Person Name</label>
						<input type="text" name="p_name" placeholder="Enter Name" required value="<?php if($error) echo $p_name; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($pname_error)) echo $pname_error; ?></span>
					</div>
					<div class="form-group">
						<label for="name">Person Designaton</label>
						<input type="text" name="designation" placeholder="Enter Designaton"  value="<?php if($error) echo $designation; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($designation_error)) echo $designation_error; ?></span>
					</div>
					<div class="form-group">
						<label for="name">Person Email</label>
						<input type="text" name="p_email" placeholder="Enter Email"  value="<?php if($error) echo $p_email; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
					</div>
					<div class="form-group">
						<label for="name">Person Contact No.</label>
						<input type="text" maxlength="10" name="p_num" placeholder="Contact No."  value="<?php if($error) echo $p_num; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($num_error)) echo $num_error; ?></span>
					</div>
					<div class="form-group">
						<label for="name">School City</label>
						<select name="school_city" id="city" class="form-control" />
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
						<label for="name">School</label>
						<select name="school_name" id="school" class="form-control" />
						<option selected disabled>Select School</option>
						</select>
						<span class="text-danger"><?php if (isset($school_error)) echo $school_error; ?></span>
					</div>
					<input type="hidden" name="school" id="school_hidden">
					<div class="form-group">
						<label for="name">School Board</label>
						<input type="text" name="board" id="board" readonly placeholder="School Board" required value="" class="form-control" />
						<span class="text-danger"></span>
					</div>
					<div class="form-group">
						<label for="name">School Strength</label>
						<input type="text" name="strength" id="strength" readonly placeholder="School Strength" required value="" class="form-control" />
						<span class="text-danger"></span>
					</div>
					<div class="form-group">
						<label for="name">School Address</label>
						<input type="text" name="address" id="address" readonly placeholder="School Address" required value="" class="form-control" />
						<span class="text-danger"></span>
					</div>
					<div class="form-group">
						<input type="submit" name="add_person" value="Add Person" class="btn" style="background:#fab017; font-weight:bold;" />
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
		url: 'get_school.php',
		type: 'POST',
		data: {'state':state,'city':city},
		dataType: 'json',
		success:function(response){

			var len = response.length;

			$("#school").empty();
			$("#school").append("<option disabled selected value=''>Select School</option>");
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
	
	$.ajax({
		url: 'get_school_details.php',
		type: 'POST',
		data: {'state':state,'city':city,'school':school},
		dataType: 'json',
		success:function(response){
			
			var len = response.length;
			for( var i = 0; i<len; i++){
				var strength = response[i]['strength'];
				var board = response[i]['board'];
				var address = response[i]['address'];

				$('#board').val(board);
				$('#strength').val(strength);
				$('#address').val(address);
			}
		}
	});

});

});


</script>
</body>

</html>