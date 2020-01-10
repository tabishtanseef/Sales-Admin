<!DOCTYPE HTML>
<?php 
ob_start();
include_once("include/db_connect.php");
session_start();
if(isset($_SESSION['user_id'])) {
	header("Location: index.php");
}
$error = false;
if (isset($_POST['add'])) {
	$m_id = mysqli_real_escape_string($conn, $_POST['manager']);
	$s_name = strtolower(mysqli_real_escape_string($conn, $_POST['salesman_name']));
	$s_id = strtolower(mysqli_real_escape_string($conn, $_POST['salesman']));
	
	$g = "SELECT id FROM under_manager WHERE m_id ='$m_id' and s_id='$s_id'";
	$r = mysqli_query($conn,$g);
	$ch = mysqli_fetch_array($r);
	
	if (strlen($ch['id']) != 0)
	{
		$error_message = "This is already added!";
	}	
	else{
		if(mysqli_query($conn, "INSERT INTO under_manager(m_id, s_id, s_name) VALUES('" . $m_id . "', '" . $s_id . "', '" . $s_name . "')")) {
			$success_message = "Successfully Registered!";
			echo "<script>alert('Successfully Registered!');</script>";
		} else {
			$error_message = "Error in registering...Please try again later!";
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
<body >

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
					<legend>Add Salesman under Manager</legend>

					<ul class="list-unstyled components">
					<li class="nav-item active">
					    <div class="form-group">
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
                    </li>
					<li class="nav-item active">
						<div class="form-group">
							<select name="manager" id="manager" class="form-control" />
							<option selected disabled>Select Manager</option>
							</select>
						</div>
                    </li>
					<li class="nav-item active">
						<div class="form-group">
							<select name="salesman" id="person" class="form-control" />
							<option selected disabled>Select Salesman</option>
							</select>
							<span class="text-danger"><?php if (isset($salesman_error)) echo $salesman_error; ?></span>
						</div>
					</li>
					<ul>
					<input type="hidden" name="salesman_name" id="s_hidden">
					<div class="form-group">
						<input type="submit" name="add" value="Add Salesman" class="btn" style="background:#fab017; font-weight:bold;" />
					</div>
				</fieldset>
			</form>
			<span class="text-success"><?php if (isset($success_message)) { echo $success_message; } ?></span>
			<span class="text-danger"><?php if (isset($error_message)) {  echo $error_message; } ?></span>
		</div>
	</div>
	
</div>
</div>

<script>
$(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
			var school = $(this).val();
			
			$("#statedd").change(function(){
				
				var state =  $(this).val();

				$.ajax({
					url: 'get_attendance.php',
					type: 'GET',
					data: {'shahrukh':state},
					dataType: 'json',
					success:function(response){
						var len = response.length;
						$("#person").empty();
						$("#person").append("<option disabled selected value=''>Select Salesman</option>");
						for( var i = 0; i<len; i++){
							var id = response[i]['id'];
							var name = response[i]['name'];
							$("#person").append("<option value='"+id+"'>"+name+"</option>");

						}
					}
				});
			});
			
			
			$("#statedd").change(function(){
				
				var state =  $(this).val();

				$.ajax({
					url: 'get_manager.php',
					type: 'GET',
					data: {'shahrukh':state},
					dataType: 'json',
					success:function(response){

						var len = response.length;

						$("#manager").empty();
						$("#manager").append("<option disabled selected value=''>Select manager</option>");
						for( var i = 0; i<len; i++){
							var id = response[i]['id'];
							var name = response[i]['name'];
							$("#manager").append("<option value='"+id+"'>"+name+"</option>");

						}
					}
				});
			});
						
			$("#person").change(function(){
				var s_name = $("#person option:selected").text();
				$("#s_hidden").val(s_name);
			});
			
        });

</script>
</body>

</html>