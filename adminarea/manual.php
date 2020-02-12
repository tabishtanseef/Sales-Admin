<!DOCTYPE html>
<?php 
session_start();
include_once("include/db_connect.php");
if (!isset($_SESSION['admin_id'])) {
header ("location:login.php");
}
if(isset($_GET['salesman_id']) && isset($_GET['salesman']) && isset($_GET['state'])){
$_SESSION['salesman_id'] = $_GET['salesman_id'];
$_SESSION['salesman'] = $_GET['salesman'];
$_SESSION['state'] = $_GET['state'];

}
$error = false;
$salesman_id = $_SESSION['salesman_id'];
$salesman = $_SESSION['salesman'] ;
$state = $_SESSION['state'];
	


if (isset($_POST['add_school'])) {
	$name = mysqli_real_escape_string($conn, $_POST['school_name']);
	$email = strtolower(mysqli_real_escape_string($conn, $_POST['school_email']));
	$num = mysqli_real_escape_string($conn, $_POST['school_num']);

	$address = mysqli_real_escape_string($conn, $_POST['school_address']);
	$strength = mysqli_real_escape_string($conn, $_POST['school_strength']);
	
	//echo "<script>alert('$state');</script>";
	
	$g = "SELECT school_name FROM school_list WHERE school_name ='$name' and school_address='$address' and user_id='$salesman_id'";
	$r = mysqli_query($conn,$g);
	$ch = mysqli_fetch_array($r);
	if (strlen($ch['school_name']) != 0)
	{
	  $error_message_school = "This School is already Added!";
	}	
	else{

	if (!preg_match('/^\d{10}$/',$num)) {
		//$error = true;
		//$num_error = "Contact No. must contain 10 Digits";
	}
	if (!preg_match("/^[0-9]+$/",$strength)) {
		//$error = true;
		//$strength_error = "Strength must contain only Digits";
	}
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		//$error = true;
		//$email_error = "Please Enter Valid Email ID";
	}
	if(!isset($_POST['school_board'])){
		$error = true;
		$city_error = "Please select a Board";
	}else{
		$board = mysqli_real_escape_string($conn, $_POST['school_board']);
	}
	
	if(!isset($_POST['school_city'])){
		$error = true;
		$city_error = "Please select a city";
	}else{
		$city = mysqli_real_escape_string($conn, $_POST['school_city']);
	}

	if (!$error) {
	
		if(mysqli_query($conn, "INSERT INTO school_list(user_id, user_name, school_name, school_board, school_strength, school_email, school_contact, school_address, school_state, school_city) VALUES('". $salesman_id ."','". $salesman ."','". $name ."', '" . $board . "', '". $strength ."', '". $email ."', '". $num ."', '". $address ."', '". $state ."','". $city ."')")) {
			$success_message_school = "School Successfully Added!";
		} else {
			$error_message_school = "Error in Adding...Please try again later!";
		}
	}
	}
}

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
	  $error_message_person = "This Person is already Added!";
	}	
	else{
	
	if (!preg_match("/^[a-zA-Z ]+$/",$p_name)) {
		$error = true;
		$pname_error = "Name must contain only alphabets and space";
	}
	if(!isset($_POST['person_school_city'])){
		$error = true;
		$city_error = "Please select a city";
	}
	else{
		$school_city = mysqli_real_escape_string($conn, $_POST['person_school_city']);
	}
	if(!isset($_POST['person_school_name'])){
		$error = true;
		$school_error = "Please select a school name";
	}
	else{
		$school_id = mysqli_real_escape_string($conn, $_POST['person_school_name']);
		$school_name = mysqli_real_escape_string($conn, $_POST['school']);
	}
	if(!$error){
		if(mysqli_query($conn, "INSERT INTO contact_person_list(user_id, user_name, p_name, p_email, p_num, designation, school_state, school_city, school_id, school_name) VALUES
		('". $salesman_id ."','" . $salesman . "','" . $p_name . "', '" . $p_email . "', '" . $p_num . "', '" . $designation . "', '". $state . "','". $school_city ."','". $school_id ."','". $school_name ."')")) {
			$success_message_person = "Person Successfully Added!";
		} else {
			
			echo "<script>alert('$salesman_id');</script>";
			echo "<script>alert('$salesman');</script>";
			echo "<script>alert('$p_name');</script>";
			echo "<script>alert('$p_email');</script>";
			echo "<script>alert('$p_num');</script>";
			echo "<script>alert('$designation');</script>";
			echo "<script>alert('$state');</script>";
			echo "<script>alert('$school_city');</script>";
			echo "<script>alert('$school_id');</script>";
			echo "<script>alert('$school_name');</script>";
			$error_message_person = "Error in Adding...Please try again later!";
		}
	}
	}
}

if (isset($_POST['add_visit'])) {
	
	$date= mysqli_real_escape_string($conn, $_POST['actual_date']);
	date_default_timezone_set("Asia/Calcutta");
	$currentTimeinSeconds = date("h:i:s");  
	$timestamp = strtotime($date);
	$day = date('l', $timestamp);
	
	$response = mysqli_real_escape_string($conn, $_POST['response']);
	$supply = mysqli_real_escape_string($conn, $_POST['supply']);
	$remarks = mysqli_real_escape_string($conn, $_POST['remarks']);
	$specimen_given = mysqli_real_escape_string($conn, $_POST['specimen_given']);
	$specimen_required = mysqli_real_escape_string($conn, $_POST['specimen_required']);
	
	if(!isset($_POST['school_city_visit'])){
		$error = true;
		$city_error = "Please select a city";
	}
	else{
		$school_city = mysqli_real_escape_string($conn, $_POST['school_city_visit']);
	}
	if(!isset($_POST['school_name_visit'])){
		$error = true;
		$school_error = "Please select a school name";
	}
	else{
	    $school_id = mysqli_real_escape_string($conn, $_POST['school_name_visit']);
		$school_name = mysqli_real_escape_string($conn, $_POST['school2']);
	}
	
	$strength = mysqli_real_escape_string($conn, $_POST['strength']);
	$board = mysqli_real_escape_string($conn, $_POST['board']);
	$address = mysqli_real_escape_string($conn, $_POST['address']);
	$contact_person = mysqli_real_escape_string($conn, $_POST['person']);
	$num = mysqli_real_escape_string($conn, $_POST['num']);
	
	
	if(!$error){

		if(mysqli_query($conn, "INSERT INTO visits(user_id, user_name, date, time, day, school_comment, supply_through, your_comment, specimen_given, specimen_required, school_state, school_city, school_id, school_name, board, strength, address, contact_person, contact_person_no) VALUES
		('". $salesman_id ."','" . $salesman . "','" . $date . "', '". $currentTimeinSeconds ."', '". $day ."', '" . $response . "', '" . $supply . "', '" . $remarks . "', '" . $specimen_given . "','" . $specimen_required . "', '". $state . "','". $school_city ."','". $school_id ."','". $school_name ."','". $board ."','". $strength ."','". $address ."','". $contact_person ."','". $num ."')")) {
			
			if(mysqli_query($conn, "UPDATE school_list SET total_visits = total_visits + 1 WHERE id = '".$school_id."' ")){
				$success_message_visit = "Visit Successfully Added!";
			}
		}
		else {
			$error_message_visit = "Error in Adding...Please try again later!";
		}
		
		
	}
}
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Manual Reporting - Good Luck Sales - Digigoodluck.com</title>
	<meta name="Description" content="Good Luck Sales is a software tool for the salesman working for a publication all over the country, to maintain all the records within the Good Luck Sales app with proper formatting and can deliver daily report precisely and on time.">
	<meta name="Keywords" content="digital, sales, marketing, software, marketing software, e-learning, digital learning, sales software, e-book software, e-books, electronic books, electronic learning, digigoodluck, goodluck, digigoodluck.com, goodluck.com, gl, g, good, luck, bad luck, 2019, 2018, saharanpur, delhi road, publication, good luck publishers, goodluck publication">
    
	<link rel="shortcut icon" href="img/favicon.png">

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style5.css">
	<link href="dist/attention.css" rel="stylesheet">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="js/date_time.js"></script> 
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
	legend{
		color:#35B394;
		font-weight:bold;
	}
	</style>
</head>

<body >
<script src="dist/attention.js"></script>
<script >
function goSuccess(){
		$('.overlay1').addClass('active');
		new Attention.Alert({
			title: 'New Entry Success',
			content: 'Successfully Added!',
			afterClose: () => {
				$('.overlay1').removeClass('active');
				window.location="manual.php";
			}
		});
	}
function goFailure(){
		$('.overlay1').addClass('active');
		new Attention.Alert({
			title: 'New Entry Failed',
			content: 'Failed',
			afterClose: () => {
				$('.overlay1').removeClass('active');
				window.location="manual.php";
			}
		});
	}
</script>

<div class="overlay1"></div>
    <div class="wrapper">
        <!-- Sidebar Holder -->
        <?php include('sidebar.php');?>
        <!-- Page Content Holder -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <h2>Manual Reporting of <?php echo $_SESSION['salesman'];?></h2>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
			<div class="container" style="min-height:500px;">
			<div class="container out">	
				<div class="row">
					<div class="col-md-4">
						<form role="form" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
							<fieldset>
								<legend>Add School</legend>
								<span class="text-success">
								<?php if (isset($success_message_school))
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
								<?php if (isset($error_message_school)) 
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
									<label for="name">School Name</label>
									<input type="text" name="school_name" placeholder="Enter School Name" required class="form-control" />
									<span class="text-danger"><?php if (isset($uname_error)) echo $uname_error; ?></span>
								</div>
								<div class="form-group">
									<label for="name">School Board</label>
									<select name="school_board" required class="form-control" />
										<option selected disabled >Select Board</option>
										<option value="CBSE">CBSE</option>
										<option value="ICSE">ICSE</option>
										<option value="STATE">STATE</option>
									</select>
									<span class="text-danger"><?php if (isset($board_error)) echo $board_error; ?></span>
								</div>
								<div class="form-group">
									<label for="name">School Strength</label>
									<input type="text" name="school_strength" placeholder="Enter School Strength"   class="form-control" />
									<span class="text-danger"></span>
								</div>
								<div class="form-group">
									<label for="name">School Email</label>
									<input type="text" name="school_email" placeholder="Enter School Email"  class="form-control" />
									<span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
								</div>
								<div class="form-group">
									<label for="name">School Contact No.</label>
									<input type="text" maxlength="10" name="school_num" placeholder="School Contact No."   class="form-control" />
									<span class="text-danger"><?php if (isset($num_error)) echo $num_error; ?></span>
								</div>
								<div class="form-group">
									<label for="name">School Address</label>
									<input type="text" name="school_address" placeholder="Enter School Address" required class="form-control" />
									<span class="text-danger"><?php if (isset($address_error)) echo $address_error; ?></span>
								</div>
								<div class="form-group">
									<label for="name">School City</label>
									<select name="school_city"  class="form-control" />
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
									<input type="submit" name="add_school" value="Add School" class="btn" style="background:#fab017; font-weight:bold;" />
								</div>
							</fieldset>
						</form>
					</div>
					<div class="col-md-4">
						<form role="form" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
							<fieldset>
								<legend>Add Contact Person</legend>
								<span class="text-success">
								<?php if (isset($success_message_person))
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
								<?php if (isset($error_message_person)) 
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
									<input type="text" name="p_name" placeholder="Enter Name" required  class="form-control" />
									<span class="text-danger"><?php if (isset($pname_error)) echo $pname_error; ?></span>
								</div>
								<div class="form-group">
									<label for="name">Person Designaton</label>
									<input type="text" name="designation" placeholder="Enter Designaton"  class="form-control" />
									<span class="text-danger"><?php if (isset($designation_error)) echo $designation_error; ?></span>
								</div>
								<div class="form-group">
									<label for="name">Person Email</label>
									<input type="text" name="p_email" placeholder="Enter Email"   class="form-control" />
									<span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
								</div>
								<div class="form-group">
									<label for="name">Person Contact No.</label>
									<input type="text" maxlength="10" name="p_num" placeholder="Contact No."   class="form-control" />
									<span class="text-danger"><?php if (isset($num_error)) echo $num_error; ?></span>
								</div>
								<div class="form-group">
									<label for="name">School City</label>
									<select name="person_school_city" id="city" class="form-control" />
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
									<select name="person_school_name" id="school" class="form-control" />
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
					<div class="col-md-4">
						<form role="form" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
							<fieldset>
								<legend>Add Visit</legend>
								<span class="text-success">
								<?php if (isset($success_message_visit))
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
								<?php if (isset($error_message_visit)) 
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
									<label for="name">Visited On</label>
									<input type="date" name="actual_date" placeholder="Visited On"   class="form-control" />
								</div>
								<div class="form-group">
									<label for="name">School City</label>
									<select name="school_city_visit" id="city2" class="form-control" />
									 <option selected disabled >Select City</option>
									<?php
									  $res=mysqli_query($conn,"select * from citylist where state='$state'");
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
									<label for="name">School Name</label>
									<select name="school_name_visit" id="school2" class="form-control" />
									<option selected disabled>Select School</option>
									</select>
									<span class="text-danger"><?php if (isset($school_error)) echo $school_error; ?></span>
								</div>
								<input type="hidden" name="school2" id="school_hidden2">
								<div class="form-group">
									<label for="name">School Board</label>
									<input type="text" name="board" id="board2" readonly placeholder="School Board" required value="" class="form-control" />
									<span class="text-danger"></span>
								</div>
								<div class="form-group">
									<label for="name">School Strength</label>
									<input type="text" name="strength" id="strength2"  placeholder="School Strength" required value="" class="form-control" />
									<span class="text-danger"></span>
								</div>
								<div class="form-group">
									<label for="name">School Address</label>
									<input type="text" name="address" id="address2" readonly placeholder="School Address" required value="" class="form-control" />
									<span class="text-danger"></span>
								</div>
								<div class="form-group">
									<label for="name">Contact Person</label>
									<select name="contact_person" id="person" class="form-control" >
									<option selected disabled>Select Person</option>
									</select>
								</div>
								<input type="hidden" name="person" id="person_hidden">
								<div class="form-group">
									<label for="name">Person Contact No.</label>
									<input type="text" name="num" id="num" placeholder="Person Contact No."  value="" class="form-control" />
								</div>
								<div class="form-group">
									<label for="name">Supply Through</label>
									<input type="text" name="supply" placeholder="Supply Through"  class="form-control" />
									<span class="text-danger"><?php if (isset($supply_error)) echo $supply_error; ?></span>
								</div>
								<div class="form-group">
									<label for="name">Specimen Given</label>
									<textarea name="specimen_given" placeholder="B.E.G (1-8) - 1 set "   class="form-control" ></textarea>
									<span class="text-danger"><?php if (isset($specimen_error)) echo $specimen_error; ?></span>
								</div>
								<div class="form-group">
									<label for="name">Specimen Required</label>
									<textarea name="specimen_required" placeholder="MST (1-8) - 1 set "   class="form-control" ></textarea>
									<span class="text-danger"><?php if (isset($specimen_error)) echo $specimen_error; ?></span>
								</div>
								<div class="form-group">
									<label for="name">School Comment</label>
									<input type="text" name="response" placeholder="Response Received" required  class="form-control" />
									<span class="text-danger"><?php if (isset($response_error)) echo $response_error; ?></span>
								</div>
								<div class="form-group">
									<label for="name">Your Comment</label>
									<input type="text" name="remarks" placeholder="Enter Your Remarks" required  class="form-control" />
									<span class="text-danger"><?php if (isset($remark_error)) echo $remark_error; ?></span>
								</div>
								
								<div class="form-group">
									<input type="submit" name="add_visit" value="Add Visit" class="btn" style="background:#fab017; font-weight:bold;" />
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
			</div>
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
$(document).ready(function () {

			$('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
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



$("#city2").change(function(){
	var city = $(this).val();
	var state = "<?php echo $state; ?>";
	
	$.ajax({
		url: 'get_school.php',
		type: 'POST',
		data: {'state':state,'city':city},
		dataType: 'json',
		success:function(response){

			var len = response.length;

			$("#school2").empty();
			$("#school2").append("<option disabled selected value=''>School List</option>");
			for( var i = 0; i<len; i++){
				var id = response[i]['id'];
				var name = response[i]['name'];
				
				$("#school2").append("<option value='"+id+"'>"+name+"</option>");
				
			}
		}
	});
});



$("#school2").change(function(){
	var school = $(this).val();
	var schoolname = $("#school2 option:selected").text();
	var state = "<?php echo $state; ?>";
	var city = $('#city2').val();
	$("#school_hidden2").val(schoolname);
	
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

				$('#board2').val(board);
				$('#strength2').val(strength);
				$('#address2').val(address);
			}
		}
	});
	$.ajax({
		url: 'get_person.php',
		type: 'POST',
		data: {'state':state,'city':city,'school':school},
		dataType: 'json',
		success:function(response){

			var len = response.length;

			$("#person").empty();
			$("#person").append("<option disabled selected value=''>Contact Person List</option>");
			for( var i = 0; i<len; i++){
				var id = response[i]['id'];
				var name = response[i]['name'];

				$("#person").append("<option value='"+id+"'>"+name+"</option>");
			}
		}
	});
});




$("#person").change(function(){
	var state = "<?php echo $state; ?>";
	var city = $('#city2').val();
	var p_id = $(this).val();
	var school = $("#school2 option:selected").text();
	var personname = $("#person option:selected").text();
	$("#person_hidden").val(personname);
	
	
	$.ajax({
		url: 'get_contact_no.php',
		type: 'POST',
		data: {'state':state,'city':city,'school':school,'p_name':p_id},
		dataType: 'json',
		success:function(response){

			var len = response.length;

			for( var i = 0; i<len; i++){
				var num = response[i]['num'];
				$("#num").val(num);
			}
		}
	});
});









});
    </script>
</body>

</html>