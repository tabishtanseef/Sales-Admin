<!DOCTYPE HTML>
<?php 
ob_start();
include_once("include/db_connect.php");
session_start();
if(isset($_SESSION['user_id'])) {
	header("Location: index.php");
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
			$success_message = "Successfully Registered!";
			echo "<script>alert('Successfully Registered!');</script>";
		} else {
			$error_message = "Error in registering...Please try again later!";
		}
	}
	
	}
}
?>

<html>
<head>
<meta charset="UTF-8" />
<meta name="description" content="Progress Button Styles: Creative effects for loading buttons" />
		<link href="https://fonts.googleapis.com/css?family=Assistant:800|Major+Mono+Display|PT+Sans" rel="stylesheet">
		<meta name="author" content="Codrops" />
		<link rel="shortcut icon" href="img/favicon.png">
		<title>Good Luck Sales - Digigoodluck.com</title>
		<meta name="Description" content="Good Luck Sales is a software tool for the salesman working for a publication all over the country, to maintain all the records within the Good Luck Sales app with proper formatting and can deliver daily report precisely and on time.">
		<meta name="Keywords" content="digital, sales, marketing, software, marketing software, e-learning, digital learning, sales software, e-book software, e-books, electronic books, electronic learning, digigoodluck, goodluck, digigoodluck.com, goodluck.com, gl, g, good, luck, bad luck, 2019, 2018, saharanpur, delhi road, publication, good luck publishers, goodluck publication">
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<link href="css/style.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Gamja+Flower|Kanit|Raleway" rel="stylesheet">
		<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js" integrity="sha384-pjaaA8dDz/5BgdFUPX6M/9SUZv4d12SUPF0axWc+VRZkx5xU3daN+lYb49+Ax+Tl" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</head>
<body onload="myLoading()">
<div id="loading"></div>
<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
	<a class="navbar-brand" href="#">
		<img src="img/sales.png" width="100" height="" alt="">
	  </a>
</nav>

	<br>
	<br>
	<br>
<div class="container" style="min-height:500px;">


<div class="container out">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well">
			<form role="form" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
				<fieldset>
					<legend>Sign Up</legend>

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
						<input type="submit" name="signup" value="Sign Up" class="btn" style="background:#fab017; font-weight:bold;" />
					</div>
				</fieldset>
			</form>
			<span class="text-success"><?php if (isset($success_message)) { echo $success_message; } ?></span>
			<span class="text-danger"><?php if (isset($error_message)) {  echo $error_message; } ?></span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">	
		Already Registered? <a href="login.php">Login Here</a>
		</div>
	</div>	
</div>
</div>

<script>
function myLoading(){
	$('#loading').css('display','none');
	
}

</script>
</body>

</html>