<!DOCTYPE html>
<?php 
session_start();
include_once("include/db_connect.php");
if (!isset($_SESSION['admin_id'])) {
header ("location:login.php");
}
$error = false;
if(isset($_GET['salesman_id']))
{
	$_SESSION['salesman_id'] =$_GET['salesman_id'];
	
}
$salesman_id = $_SESSION['salesman_id'];

if (isset($_POST['update'])) {
	
	$english = mysqli_real_escape_string($conn, $_POST['english']);
	$hindi_a = mysqli_real_escape_string($conn, $_POST['hindi_a']);
	$hindi_b = mysqli_real_escape_string($conn, $_POST['hindi_b']);
	$math_b = mysqli_real_escape_string($conn, $_POST['math_b']);
	$math_s = mysqli_real_escape_string($conn, $_POST['math_s']);
	$science = mysqli_real_escape_string($conn, $_POST['science']);
	$sst = mysqli_real_escape_string($conn, $_POST['sst']);
	
	$biology = mysqli_real_escape_string($conn, $_POST['biology']);
	$chemistry = mysqli_real_escape_string($conn, $_POST['chemistry']);
	$computer = mysqli_real_escape_string($conn, $_POST['computer']);
	$geography = mysqli_real_escape_string($conn, $_POST['geography']);
	$history = mysqli_real_escape_string($conn, $_POST['history']);
	$literature = mysqli_real_escape_string($conn, $_POST['literature']);
	$language = mysqli_real_escape_string($conn, $_POST['language']);
	$math = mysqli_real_escape_string($conn, $_POST['math']);
	$physics = mysqli_real_escape_string($conn, $_POST['physics']);
	$hindi = mysqli_real_escape_string($conn, $_POST['hindi']);
	
	if(mysqli_query($conn, "Update qb_stock SET cbse1 = cbse1 + '$english', cbse2 = cbse2 + '$hindi_a', cbse3 = cbse3 + '$hindi_b', cbse4 = cbse4 + '$math_b', 
	cbse5 = cbse5 + '$math_s', cbse6 = cbse6 + '$science', cbse7 = cbse7 + '$sst', icse1 = icse1 + '$biology', icse2 = icse2 + '$chemistry', icse3 = icse3 + '$computer', 
	 icse4 = icse4 + '$geography', icse5 = icse5 + '$history', icse6 = icse6 + '$literature', icse7 = icse7 + '$language',  icse8 = icse8 + '$math',  
	 icse9 = icse9 + '$physics',  icse10 = icse10 + '$hindi' where user_id ='$salesman_id'")) {
		 
		$success_message = "Successfully Updated!";
	} 
	else {
		$error_message = "Error in Updating...Please try again later!";
	}
}
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit School Details - Good Luck Sales - Digigoodluck.com</title>
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
		width:100%;
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
	td input{
		width:100px !important;
		text-align:center;
	}
	.link{
		font-weight:bold;
		color:#E85A4F;
		text-align:left;
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
					<?php
						$get_attendance="select * from qb_stock where user_id='$salesman_id'";
						$run_attendance= mysqli_query($conn, $get_attendance);
						$row_attendance=mysqli_fetch_array($run_attendance);
						$salesman = $row_attendance['user_name'];
						$id = $row_attendance['id'];
						$cbse1 = $row_attendance['cbse1'];
						$cbse2 = $row_attendance['cbse2'];
						$cbse3 = $row_attendance['cbse3'];
						$cbse4 = $row_attendance['cbse4'];
						$cbse5 = $row_attendance['cbse5'];
						$cbse6 = $row_attendance['cbse6'];
						$cbse7 = $row_attendance['cbse7'];
						$icse1 = $row_attendance['icse1'];
						$icse2 = $row_attendance['icse2'];
						$icse3 = $row_attendance['icse3'];
						$icse4 = $row_attendance['icse4'];
						$icse5 = $row_attendance['icse5'];
						$icse6 = $row_attendance['icse6'];
						$icse7 = $row_attendance['icse7'];
						$icse8 = $row_attendance['icse8'];
						$icse9 = $row_attendance['icse9'];
						$icse10 = $row_attendance['icse10'];
					?>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#"><span class="link"><?php echo $salesman;?></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            
			<div class="container-fluid" style="min-height:500px;">
			<div class="container-fluid out">
				<div class="row">
					<div class="col-md-12 col-md-offset-12 well">
					<span class="text-success"><?php if (isset($success_message)) { echo $success_message; } ?></span>
						<span class="text-danger"><?php if (isset($error_message)) { echo $error_message; } ?></span>
						<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
							<fieldset>
								<legend>Update Question Bank Stock for <?php echo $salesman;?></legend>
								<div class="row" style="margin-top:2%;">
									<div class="col-md-5 horizontal-scroll sub" style="padding:20px;">
										<table class="table table-hover table-responsive w-100 d-block d-md-table" style="width:100%;">
											<tbody>
											<tr>
											<td colspan="4" style="padding-top:20px; font-size:25px;" ><center>CBSE</center></td>
											</tr>
											<tr>
											<td style="padding-top:20px;" >English</td>
											<td><input type="text" name="" readonly value="<?php echo $cbse1; ?>"  class="form-control" /></td>
											<td style="width:50px; font-size:24px; margin:auto;"><center>+</center></td>
											<td><input type="text" name="english" class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;" >Hindi A</td>
											<td><input type="text" name="" readonly value="<?php echo $cbse2; ?>"  class="form-control" /></td>
											<td style="width:50px; font-size:24px; margin:auto;"><center>+</center></td>
											<td><input type="text" name="hindi_a" class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">Hindi B</td>
											<td><input type="text" name="" readonly value="<?php echo $cbse3; ?>"  class="form-control" /></td>
											<td style="width:50px; font-size:24px; margin:auto;"><center>+</center></td>
											<td><input type="text" name="hindi_b" class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">Math Basic</td>
											<td><input type="text" name="" readonly value="<?php echo $cbse4; ?>"  class="form-control" /></td>
											<td style="width:50px; font-size:24px; margin:auto;"><center>+</center></td>
											<td><input type="text" name="math_b" class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">Math Standard</td>
											<td><input type="text" name="" readonly value="<?php echo $cbse5; ?>"  class="form-control" /></td>
											<td style="width:50px; font-size:24px; margin:auto;"><center>+</center></td>
											<td><input type="text" name="math_s" class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">Science</td>
											<td><input type="text" name="" readonly value="<?php echo $cbse6; ?>"  class="form-control" /></td>
											<td style="width:50px; font-size:24px; margin:auto;"><center>+</center></td>
											<td><input type="text" name="science" class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">Social Studies</td>
											<td><input type="text" name="" readonly value="<?php echo $cbse7; ?>"  class="form-control" /></td>
											<td style="width:50px; font-size:24px; margin:auto;"><center>+</center></td>
											<td><input type="text" name="sst" class="form-control" /></td>
											</tr>
											</tbody>
										</table>
									</div>
									<div class="col-md-6 horizontal-scroll sub" style="padding:20px;">
										<table class="table table-hover table-responsive w-100 d-block d-md-table" style="width:100%;">
											<tbody>
											<tr>
											<td colspan="4" style="padding-top:20px; font-size:25px;" ><center>ICSE</center></td>
											</tr>
											<tr>
											<td style="padding-top:20px;" >Biology</td>
											<td><input type="text" name="" readonly value="<?php echo $icse1; ?>"  class="form-control" /></td>
											<td style="width:50px; font-size:24px; margin:auto;"><center>+</center></td>
											<td><input type="text" name="biology" class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;" >Chemistry</td>
											<td><input type="text" name="" readonly value="<?php echo $icse2; ?>"  class="form-control" /></td>
											<td style="width:50px; font-size:24px; margin:auto;"><center>+</center></td>
											<td><input type="text" name="chemistry" class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">Computer</td>
											<td><input type="text" name="" readonly value="<?php echo $icse3; ?>"  class="form-control" /></td>
											<td style="width:50px; font-size:24px; margin:auto;"><center>+</center></td>
											<td><input type="text" name="computer" class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">Geography</td>
											<td><input type="text" name="" readonly value="<?php echo $icse4; ?>"  class="form-control" /></td>
											<td style="width:50px; font-size:24px; margin:auto;"><center>+</center></td>
											<td><input type="text" name="geography" class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">History & Civics</td>
											<td><input type="text" name="" readonly value="<?php echo $icse5; ?>"  class="form-control" /></td>
											<td style="width:50px; font-size:24px; margin:auto;"><center>+</center></td>
											<td><input type="text" name="history" class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">English Literature</td>
											<td><input type="text" name="" readonly value="<?php echo $icse6; ?>"  class="form-control" /></td>
											<td style="width:50px; font-size:24px; margin:auto;"><center>+</center></td>
											<td><input type="text" name="literature" class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">English Language</td>
											<td><input type="text" name="" readonly value="<?php echo $icse7; ?>"  class="form-control" /></td>
											<td style="width:50px; font-size:24px; margin:auto;"><center>+</center></td>
											<td><input type="text" name="language" class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">Math</td>
											<td><input type="text" name="" readonly value="<?php echo $icse8; ?>"  class="form-control" /></td>
											<td style="width:50px; font-size:24px; margin:auto;"><center>+</center></td>
											<td><input type="text" name="math" class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">Physics</td>
											<td><input type="text" name="" readonly value="<?php echo $icse9; ?>"  class="form-control" /></td>
											<td style="width:50px; font-size:24px; margin:auto;"><center>+</center></td>
											<td><input type="text" name="physics" class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">Hindi</td>
											<td><input type="text" name="" readonly value="<?php echo $icse10; ?>"  class="form-control" /></td>
											<td style="width:50px; font-size:24px; margin:auto;"><center>+</center></td>
											<td><input type="text" name="hindi" class="form-control" /></td>
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