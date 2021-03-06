<!DOCTYPE html>
<?php 
ob_start();
include_once("include/db_connect.php");
session_start();
if(!isset($_SESSION['admin_id'])) {
	header("Location: login.php");
}
$error = false;
if (isset($_POST['signup'])) {
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$email = strtolower(mysqli_real_escape_string($conn, $_POST['email']));
	$num = mysqli_real_escape_string($conn, $_POST['num']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);	
	
	$g = "SELECT email FROM users WHERE email ='$email'";
	$r = mysqli_query($conn,$g);
	$ch = mysqli_fetch_array($r);
	if (strlen($ch['email']) != 0)
	{
	  $error_message = "This Email is already registered!";
	}	
	else{
	
	if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
		$error = true;
		$uname_error = "Name must contain only alphabets and space";
	}
	if (!preg_match('/^\d{10}$/',$num)) {
		$error = true;
		$num_error = "Contact No. must contain 10 Digits";
	}
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		$error = true;
		$email_error = "Please Enter Valid Email ID";
	}
	if(strlen($password) < 6) {
		$error = true;
		$password_error = "Password must be minimum of 6 characters";
	}
	if($password != $cpassword) {
		$error = true;
		$cpassword_error = "Password and Confirm Password doesn't match";
	}
	if(!isset($_POST['school_state'])){
		$error = true;
			$state_error = "Please select a state";
	}else{
			$state = mysqli_real_escape_string($conn, $_POST['school_state']);
	}
	
	
	if (!$error) {
	
		if(mysqli_query($conn, "INSERT INTO users(user, email, num, pass, school_state) VALUES('" . $name . "', '" . $email . "', '" . $num . "', '" . md5($password) . "','". $state ."')")) {
			
			$gu = "SELECT * FROM users order by uid DESC";
			$ru = mysqli_query($conn,$gu);
			$chu = mysqli_fetch_array($ru);
			$qb_id = $chu['uid'];
			$qb_name = $chu['user'];
			if(mysqli_query($conn, "INSERT INTO qb_stock(user_id, user_name) VALUES('" . $qb_id . "', '" . $qb_name . "')")) {
				$success_message = "Salesman Successfully Added!";
			}			
		} 
		else {
			$error_message = "Error in registering...Please try again later!";
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

    <link rel="shortcut icon" href="img/favicon.png">
	<title>Add Salesman - Good Luck Sales - Digigoodluck.com</title>
	<meta name="Description" content="Good Luck Sales is a software tool for the salesman working for a publication all over the country, to maintain all the records within the Good Luck Sales app with proper formatting and can deliver daily report precisely and on time.">
	<meta name="Keywords" content="digital, sales, marketing, software, marketing software, e-learning, digital learning, sales software, e-book software, e-books, electronic books, electronic learning, digigoodluck, goodluck, digigoodluck.com, goodluck.com, gl, g, good, luck, bad luck, 2019, 2018, saharanpur, delhi road, publication, good luck publishers, goodluck publication">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style5.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
	<script src="js/date_time.js"></script> 
	<style>

	th, td{
	text-align:center;
	font-size:14px;
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
	.link{
		font-weight:bold;
		color:#E85A4F;
	}
	</style>
</head>

<body>

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
                               <h2>Add Salesman</h2>
                            </li>
                        </ul>
                    </div>
					
                </div>
            </nav>
			<div class="container" style="min-height:500px;">


			<div class="container out">
					<span class="text-success"><?php if (isset($success_message)) { echo $success_message; } ?></span>
					<span class="text-danger"><?php if (isset($error_message)) { echo $error_message; } ?></span>
				<div class="row sub">
					<div class="col-md-12 col-md-offset-12 well">
						<form role="form" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
							<fieldset>

								<div class="form-group">
									<label for="name">Name</label>
									<input type="text" name="name" placeholder="Enter Full Name" required value="<?php if($error) echo $name; ?>" class="form-control" />
									<span class="text-danger"><?php if (isset($uname_error)) echo $uname_error; ?></span>
								</div>
								<div class="form-group">
									<label for="name">Email</label>
									<input type="text" name="email" placeholder="Enter Email" required value="<?php if($error) echo $email; ?>" class="form-control" />
									<span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
								</div>
								<div class="form-group">
									<label for="name">Contact No.</label>
									<input type="text" maxlength="10" name="num" placeholder="Contact No." required value="<?php if($error) echo $num; ?>" class="form-control" />
									<span class="text-danger"><?php if (isset($num_error)) echo $num_error; ?></span>
								</div>
								<div class="form-group">
									<label for="name">School State</label>
									<select name="school_state" id="statedd" class="form-control" />
									 <option selected disabled >Select State</option>
									<?php
									  $res=mysqli_query($conn,"select * from states order by state_name");
									  while($row=mysqli_fetch_array($res))
									  {  
									  ?>
									  <option value="<?php  echo $row ["state_name"]; ?>" ><?php  echo $row ["state_name"]; ?></option>
									  <?php
									  }
									  ?>
									
									</select>
									<span class="text-danger"><?php if (isset($state_error)) echo $state_error; ?></span>
								</div>
								<div class="form-group">
									<label for="name">Password</label>
									<input type="password" name="password" placeholder="Password" required class="form-control" />
									<span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
								</div>
								<div class="form-group">
									<label for="name">Confirm Password</label>
									<input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control" />
									<span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
								</div>

								<div class="form-group">
									<center><input type="submit" name="signup" value="Add Salesman" class="btn" style="background:#fab017; font-weight:bold;" /></center>
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
			
			$("#statedd").change(function(){
				
				var state =  $(this).val();

				$.ajax({
					url: 'get_cities.php',
					type: 'POST',
					data: {'shahrukh':state},
					dataType: 'json',
					success:function(response){

						var len = response.length;

						$("#city").empty();
						$("#city").append("<option disabled selected value=''>Select City</option>");
						for( var i = 0; i<len; i++){
							var id = response[i]['id'];
							var name = response[i]['name'];
							$("#city").append("<option value='"+name+"'>"+name+"</option>");

						}
					}
				});
			});
			
			
			
			
        });
		
    </script>
</body>

</html>