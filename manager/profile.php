<!DOCTYPE html>
<?php 
session_start();
include_once("include/db_connect.php");
if (!isset($_SESSION['admin_id'])) {
header ("location:login.php");
}
$error = false;
if (isset($_POST['update'])) {

	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);	
	
	
	if(strlen($password) < 6) {
		$error = true;
		$password_error = "Password must be minimum of 6 characters";
	}
	if($password != $cpassword) {
		$error = true;
		$cpassword_error = "Password and Confirm Password doesn't match";
	}
	if (!$error) {
		if(mysqli_query($conn, "Update users SET pass= '" . md5($password) . "' where uid = $_SESSION[user_id]")) {
			$success_message = "Successfully Updated!";
		} else {
			$error_message = "Error in Updating...Please try again later!";
		}
	}
	
}
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Good Luck Sales - Digigoodluck.com</title>
	<meta name="Description" content="Good Luck Sales is a software tool for the salesman working for a publication all over the country, to maintain all the records within the Good Luck Sales app with proper formatting and can deliver daily report precisely and on time.">
	<meta name="Keywords" content="digital, sales, marketing, software, marketing software, e-learning, digital learning, sales software, e-book software, e-books, electronic books, electronic learning, digigoodluck, goodluck, digigoodluck.com, goodluck.com, gl, g, good, luck, bad luck, 2019, 2018, saharanpur, delhi road, publication, good luck publishers, goodluck publication">
    
<link rel="shortcut icon" href="img/favicon.png">
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
	font-weight:bold;
	text-align:right;
	color:#32B394;
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
                                <a class="nav-link" href="#">Admin Profile</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            
			<div class="container" style="min-height:500px;">
			<div class="container out">
				<div class="row">
					<div class="col-md-12 col-md-offset-12 well">
					<span class="text-success"><?php if (isset($success_message)) { echo $success_message; } ?></span>
						<span class="text-danger"><?php if (isset($error_message)) { echo $error_message; } ?></span>
						<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
							<fieldset>
								<legend>Update Profile</legend>
								<div class="row sub" style="margin-top:2%;">
									<div class="col-sm-12 horizontal-scroll">
										<table class="table table-hover table-responsive w-100 d-block d-md-table" style="width:100%;">
											<tbody>
											<tr>
											<td style="padding-top:20px;" >Name</td>
											<td><input type="text" name="" readonly value="<?php echo $_SESSION['admin_name']; ?>"  class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;"><label for="name">Email</label></td>
											<td><input type="text" name="" readonly value="<?php echo $_SESSION['admin_email']; ?>"  class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">Contact No.</td>
											<td><input type="text" name="" readonly value="<?php echo $_SESSION['admin_num']; ?>"  class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">Password</td>
											<td><input type="password" name="password" placeholder="Password" required class="form-control" />
											<span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">Confirm Password</td>
											<td><input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control" />
											<span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span></td>
											</tr>
											</tbody>
										</table>


									</div>
								</div>
								
								<div class="form-group">
									<center><input type="submit" name="update" value="Update!" class="btn" style="background:#fab017; font-weight:bold;" /></center>
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
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
        });
    </script>
</body>

</html>