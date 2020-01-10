<!DOCTYPE html>
<?php 
session_start();
include_once("include/db_connect.php");
if (!isset($_SESSION['manager_id'])) {
header ("location:login.php");
}

if(isset($_GET['id']))
	{
		$id = $_GET['id'];
		$get_attendance="select * from users where uid = '$id'";
		$run_attendance= mysqli_query($conn, $get_attendance);	 
		$row_attendance=mysqli_fetch_array($run_attendance);
		$s_name = $row_attendance['user'];
		$s_num = $row_attendance['num'];
		$s_email = $row_attendance['email'];
		$s_state = $row_attendance['school_state'];
	}
if (isset($_POST['go'])) {
	
	if(!isset($_POST['school_state'])){
	$error = true;
	$state_error = "Please select a state";
	}
	else{
		$state = mysqli_real_escape_string($conn, $_POST['school_state']);
		header ("location:all_salesman.php?state=$state");
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
	h2{
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
        <!-- Page Content Holder -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
					<a class="navbar-brand" href="index.php">
						<img src="img/sales.png" style="width:60%; padding:10px;" alt="">
					</a>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            
							<li class="nav-item active">
                                <h2><?php echo $s_name; ?> Profile</h2>
                            </li>
							<li class="nav-item">
								<div class="form-group">
									&nbsp;&nbsp;
									&nbsp;&nbsp;<a href="logout.php"><button class="btn" style="background:#FAB016; color:white; font-weight:bold;" />Log Out</button></a>
					             </div>
					        </li>
                        </ul>
                    </div>
                </div>
            </nav>
			<div class="container" style="min-height:500px;">
			<div class="container out">
				<div class="row" >
					<div class="col-md-3" style="margin:auto;">
						<div class="form-group">
							<center><a target="_blank" href="school_list.php?salesman_id=<?php echo $id;?>&salesman=<?php echo $s_name;?>"><input type="submit" name="" value="School List" class="btn" style="background:#fab017; font-weight:bold;" /></a></center>
						</div>
					</div>
					<div class="col-md-3" style="margin:auto;">
						<div class="form-group">
							<center><a target="_blank" href="attendance_report.php?salesman_id=<?php echo $id;?>&salesman=<?php echo $s_name;?>"><input type="submit" name="" value="Attendance Report" class="btn" style="background:#fab017; font-weight:bold;" /></a></center>
						</div>
					</div>
					<div class="col-md-3" style="margin:auto;">
						<div class="form-group">
							<center><a target="_blank" href="visit_report.php?salesman_id=<?php echo $id;?>&salesman=<?php echo $s_name;?>"><input type="submit" name="" value="Visit Report" class="btn" style="background:#fab017; font-weight:bold;" /></a></center>
						</div>
					</div>
					<div class="col-md-3" style="margin:auto;">
						<div class="form-group">
							<center><a target="_blank" href="summary.php?salesman_id=<?php echo $id;?>&salesman=<?php echo $s_name;?>&state=<?php echo $s_state;?>"><input type="submit" name="" value="Summary Report" class="btn" style="background:#fab017; font-weight:bold;" /></a></center>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-md-offset-12 well">
							<fieldset>
								<legend></legend>
								<div class="row sub" style="margin-top:2%;">
									<div class="col-sm-12 horizontal-scroll">
										<table class="table table-hover table-responsive w-100 d-block d-md-table" style="width:100%;">
											<tbody>
											<tr>
											<td style="padding-top:20px;" >Salesman Id</td>
											<td><input type="text" id="userid" name="" readonly value="<?php echo $id; ?>"  class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;" >Salesman Name</td>
											<td><input type="text" name="" readonly value="<?php echo $s_name; ?>"  class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">Salesman Email</td>
											<td><input type="text" name="" readonly value="<?php echo $s_email; ?>"  class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">Contact No.</td>
											<td><input type="text" name="" readonly value="<?php echo $s_num; ?>"  class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">Working State</td>
											<td><input type="text" name="" readonly value="<?php echo $s_state; ?>"  class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;" rowspan="" >Working Cities</td>
											<td id="person">
											
											<!--<select name="salesman" id="person" class="form-control" />
											<option selected disabled>Working Cities</option>
											</select>-->
											</td>
											</tr>
											
											</tbody>
										</table>


									</div>
								</div>
							</fieldset>						
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
			
			getCities();
			
			
        });
		
		function getCities(){
			var id = $('#userid').val();
			$.ajax({
					url: 'get_salesmanCitiies.php',
					type: 'GET',
					data: {'shahrukh':id},
					dataType: 'json',
					success:function(response){

						var len = response.length;

						
						for( var i = 0; i<len; i++){
							var name = response[i]['name'];
							$('#person').append("<input type='text' readonly id=city"+i+" class='form-control' /><br>"); 
							$('#city'+i).val(name);
						}
					}
				});
			
		}
    </script>
</body>

</html>