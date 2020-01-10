<!DOCTYPE html>
<?php 
session_start();
include_once("include/db_connect.php");
if (!isset($_SESSION['admin_id'])) {
header ("location:login.php");
}
$error = false;

if(isset($_GET['salesman']) && isset($_GET['school']) && isset($_GET['state']) && isset($_GET['city']) && isset($_GET['start_date']) && isset($_GET['end_date']) )
{
	$start_date =$_GET['start_date'];
	$end_date =$_GET['end_date'];
	$state =$_GET['state'];
	$school =$_GET['school'];
	$city =$_GET['city'];
	$salesman =$_GET['salesman'];
}

else if(isset($_GET['salesman']) && isset($_GET['school']) && isset($_GET['state']) && isset($_GET['city']) )
{
	$state =$_GET['state'];
	$school =$_GET['school'];
	$city =$_GET['city'];
	$salesman =$_GET['salesman'];
}
else if(isset($_GET['salesman']) && isset($_GET['state']) && isset($_GET['school']) && isset($_GET['start_date']) && isset($_GET['end_date']) )
{
	$start_date =$_GET['start_date'];
	$end_date =$_GET['end_date'];
	$state =$_GET['state'];
	$school =$_GET['school'];
	$salesman =$_GET['salesman'];
}
else if(isset($_GET['salesman']) && isset($_GET['state']) && isset($_GET['school']) )
{
	$state =$_GET['state'];
	$school =$_GET['school'];
	$salesman =$_GET['salesman'];
}

else if(isset($_GET['state']) && isset($_GET['city']) && isset($_GET['school'])  && isset($_GET['start_date']) && isset($_GET['end_date']))
{
	$start_date =$_GET['start_date'];
	$end_date =$_GET['end_date'];
	$school =$_GET['school'];
	$city =$_GET['city'];
	$state =$_GET['state'];
}

else if(isset($_GET['state']) && isset($_GET['city']) && isset($_GET['school']) )
{
	$school =$_GET['school'];
	$city =$_GET['city'];
	$state =$_GET['state'];
}
else if(isset($_GET['state']) && isset($_GET['city']) && isset($_GET['salesman'])  && isset($_GET['start_date']) && isset($_GET['end_date']))
{
	$start_date =$_GET['start_date'];
	$end_date =$_GET['end_date'];
	$salesman =$_GET['salesman'];
	$city =$_GET['city'];
	$state =$_GET['state'];
}
else if(isset($_GET['state']) && isset($_GET['city']) && isset($_GET['salesman']))
{
	$salesman =$_GET['salesman'];
	$city =$_GET['city'];
	$state =$_GET['state'];
}
else if(isset($_GET['state']) && isset($_GET['city']))
{
	$city =$_GET['city'];
	$state =$_GET['state'];
}
else if(isset($_GET['state']) && isset($_GET['school'])  && isset($_GET['start_date']) && isset($_GET['end_date']))
{
	$start_date =$_GET['start_date'];
	$end_date =$_GET['end_date'];
	$school =$_GET['school'];
	$state =$_GET['state'];
}
else if(isset($_GET['state']) && isset($_GET['school']))
{
	$school =$_GET['school'];
	$state =$_GET['state'];
}
else if(isset($_GET['state']) && isset($_GET['salesman'])  && isset($_GET['start_date']) && isset($_GET['end_date']))
{
	$start_date =$_GET['start_date'];
	$end_date =$_GET['end_date'];
	$salesman =$_GET['salesman'];
	$state =$_GET['state'];
}
else if(isset($_GET['state']) && isset($_GET['salesman']))
{
	$salesman =$_GET['salesman'];
	$state =$_GET['state'];
}
else if(isset($_GET['state']))
{
	$state =$_GET['state'];
}
else if(isset($_GET['salesman_id']) && isset($_GET['salesman']))
{
	$salesman_id =$_GET['salesman_id'];
	$salesman =$_GET['salesman'];
}
else if(isset($_GET['start_date']) && isset($_GET['end_date']))
{
	$start_date =$_GET['start_date'];
	$end_date =$_GET['end_date'];
}

else if(isset($_GET['salesman_id']) && isset($_GET['school_id']))
{
	$salesman_id =$_GET['salesman_id'];
	$school_id =$_GET['school_id'];
	echo "<script>alert('$salesman_id');</script>";
	echo "<script>alert('$school_id');</script>";
}

if (isset($_POST['go'])) {
	
	$start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
	$end_date = mysqli_real_escape_string($conn, $_POST['end_date']);
	
	
	
	
	
	if(!isset($_POST['school_state'])){
	$error = true;
	}
	 else{
			$state = mysqli_real_escape_string($conn, $_POST['school_state']);
		
	}
	if(!isset($_POST['city'])){
	$error = true;
	}
	 else{
			$city = mysqli_real_escape_string($conn, $_POST['city']);
		
	}
	if(!isset($_POST['school'])){
	$error = true;
	}
	 else{
			$school = mysqli_real_escape_string($conn, $_POST['school']);
		
	}
	if(!isset($_POST['salesman'])){
	$error = true;
	}
	else{
			$salesman = mysqli_real_escape_string($conn, $_POST['salesman']);
	}
	if(!$error){
		header ("location:visit_report.php?salesman_id=$salesman_id&school_id=$school_id");
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
		text-align:center;
		font-size:12px;
	}
	h4, th{
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
					<button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
					<form role="form" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            &nbsp;&nbsp;
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
							&nbsp;&nbsp;
							<li class="nav-item active">
                               <div class="form-group">
									<select name="city" id="city" class="form-control" />
									<option selected disabled>Select City</option>
									</select>
								</div>
                            </li>
							&nbsp;&nbsp;
							<li class="nav-item active">
                               <div class="form-group">
									<select name="school" id="school" class="form-control" />
									<option selected disabled>Select School</option>
									</select>
								</div>
                            </li>
							&nbsp;&nbsp;
							<li class="nav-item active">
                               <div class="form-group">
									<select name="salesman" id="person" class="form-control" />
									<option selected disabled>Select Salesman</option>
									</select>
									<span class="text-danger"><?php if (isset($salesman_error)) echo $salesman_error; ?></span>
								</div>
                            </li>
                        </ul>
                    </div>
					<div class="collapse navbar-collapse" id="navbarSupportedContent1">
                        <ul class="nav navbar-nav ml-auto">
                            
							&nbsp;&nbsp;
							<li class="nav-item active">
                               <div class="form-group">
									<span class="text-danger">From Date</span>
									<input type="date" name="start_date" class="form-control" value="">
								</div>
                            </li>
							&nbsp;&nbsp;
							<li class="nav-item active">
                                <div class="form-group">
									<span class="text-danger">To Date</span>
									<input type="date"  name="end_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
								</div>
                            </li>
							&nbsp;&nbsp;
							<li class="nav-item">
								<div class="form-group">
								<span class="text-danger"></span><br>
									&nbsp;&nbsp;<input type="submit" name="go" value="Go!" class="btn" style="background:#fab017; font-weight:bold;" />
					             </div>
					        </li>
							<li class="nav-item">
								<div class="form-group">
								<span class="text-danger"></span><br>
									&nbsp;&nbsp;<input type="submit" id="btnExport" onclick="fnExcelReport();" value="Export to Excel" class="btn" style="background:#35B394; color:white; font-weight:bold;" />
					             </div>
					        </li>
                        </ul>
                    </div>
					</form>
                </div>
            </nav>
			<?php
			if(isset($salesman) && isset($city) && isset($state) && isset($school)){
				echo "<h4>&nbsp;&nbsp;&nbsp;&nbsp; Visit Report of $salesman in $school of $state - $city</h4>";
			}
			else if(isset($salesman) && isset($school) && isset($state)){
			echo "<h4>&nbsp;&nbsp;&nbsp;&nbsp; Visit Report of $salesman in $school of $state</h4>";
			}
			else if(isset($city) && isset($school) && isset($state)){
			echo "<h4>&nbsp;&nbsp;&nbsp;&nbsp; Visit Report in $school of $state - $city</h4>";
			}
			else if(isset($city) && isset($salesman) && isset($state)){
			echo "<h4>&nbsp;&nbsp;&nbsp;&nbsp; Visit Report of $salesman of $state - $city</h4>";
			}
			else if(isset($city) && isset($state)){
			echo "<h4>&nbsp;&nbsp;&nbsp;&nbsp; Visit Report of $state - $city</h4>";
			}
			else if(isset($school) && isset($state)){
			echo "<h4>&nbsp;&nbsp;&nbsp;&nbsp; Visit Report of $school in $state</h4>";
			}
			else if(isset($salesman) && isset($state)){
			echo "<h4>&nbsp;&nbsp;&nbsp;&nbsp; Visit Report of $salesman in $state</h4>";
			}
			else if(isset($salesman) && isset($salesman_id)){
			echo "<h4>&nbsp;&nbsp;&nbsp;&nbsp; Visit Report of $salesman</h4>";
			}
			else if(isset($state)){
			echo "<h4>&nbsp;&nbsp;&nbsp;&nbsp; Visit Report of $state</h4>";
			}
			?>
			
			<div class="row sub" style="margin-top:2%;">
				<div class="col-sm-12 horizontal-scroll">
					<table id="school_list" class="table table-hover table-striped table-bordered table-responsive w-100 d-block d-md-table" style="width:100%;">
						<thead>
						<th>School Name</th>
						<th>School City</th>
						<th>Board</th>
						<th>Strength</th>
						<th>Contact Person</th>
						<th>Contact No.</th>
						<th>Supply Through</th>
						<th>Specimen Given</th>
						</thead>
						<tbody>
						<?php
						
						if(isset($salesman) && isset($state) && isset($city) && isset($school) && isset($start_date) && isset($end_date)){
							
						$get_attendance="select * from visits where user_name ='$salesman' AND school_state = '$state' and school_city='$city' and school_name='$school' and date BETWEEN '$start_date' AND '$end_date'order by date DESC";
						$run_attendance= mysqli_query($conn, $get_attendance);
						 
						visit($run_attendance);
						}
						
						else if(isset($salesman) && isset($state) && isset($city) && isset($school)){
							
						$get_attendance="select * from visits where user_name ='$salesman' AND school_state = '$state' and school_city='$city' and school_name='$school' order by date DESC";
						$run_attendance= mysqli_query($conn, $get_attendance);
						 
						visit($run_attendance);
						}
						else if(isset($salesman) && isset($state) && isset($school) && isset ($start_date) && isset($end_date)){
						
						$get_attendance="select * from visits where user_name ='$salesman' AND school_state = '$state' and school_name='$school' and date BETWEEN '$start_date' AND '$end_date'order by date DESC";
						$run_attendance= mysqli_query($conn, $get_attendance);
						
						visit($run_attendance);

						}
						else if(isset($salesman) && isset($state) && isset($school)){
						
						$get_attendance="select * from visits where user_name ='$salesman' AND school_state = '$state' and school_name='$school' order by date DESC";
						$run_attendance= mysqli_query($conn, $get_attendance);
						
						visit($run_attendance);

						}
						else if(isset($city) && isset($state) && isset($salesman) && isset ($start_date) && isset($end_date)){
							
						$get_attendance="select * from visits where school_city ='$city' AND school_state = '$state' and user_name='$salesman' and date BETWEEN '$start_date' AND '$end_date'order by date DESC";
						$run_attendance= mysqli_query($conn, $get_attendance);
						
						visit($run_attendance);

						}
						else if(isset($city) && isset($state) && isset($salesman)){
							
						$get_attendance="select * from visits where school_city ='$city' AND school_state = '$state' and user_name='$salesman' order by date DESC";
						$run_attendance= mysqli_query($conn, $get_attendance);
						
						visit($run_attendance);

						}
						else if(isset($city) && isset($state) && isset($school) && isset ($start_date) && isset($end_date)){
							
						$get_attendance="select * from visits where school_city ='$city' AND school_state = '$state' and school_name='$school' and date BETWEEN '$start_date' AND '$end_date'order by date DESC";
						$run_attendance= mysqli_query($conn, $get_attendance);
						
						visit($run_attendance);

						}
						else if(isset($city) && isset($state) && isset($school)){
							
						$get_attendance="select * from visits where school_city ='$city' AND school_state = '$state' and school_name='$school' order by date DESC";
						$run_attendance= mysqli_query($conn, $get_attendance);
						
						visit($run_attendance);

						}
						
						else if(isset($state) && isset($city)){
							
						$get_attendance="select * from visits where school_state = '$state' AND school_city='$city' order by date DESC";
						$run_attendance= mysqli_query($conn, $get_attendance);
						 
						visit($run_attendance);

						}
						
						else if(isset($school) && isset($state) && isset ($start_date) && isset($end_date) ){
							
						$get_attendance="select * from visits where school_name ='$school' AND school_state = '$state' and date BETWEEN '$start_date' AND '$end_date'order by date DESC";
						$run_attendance= mysqli_query($conn, $get_attendance);
						 
						visit($run_attendance);

						}
						else if(isset($school) && isset($state)){
							
						$get_attendance="select * from visits where school_name ='$school' AND school_state = '$state' order by date DESC";
						$run_attendance= mysqli_query($conn, $get_attendance);
						 
						visit($run_attendance);

						}
						else if(isset($salesman) && isset($state)  && isset ($start_date) && isset($end_date)){
							
						$get_attendance="select * from visits where user_name ='$salesman' AND school_state = '$state'  and date BETWEEN '$start_date' AND '$end_date'order by date DESC";
						$run_attendance= mysqli_query($conn, $get_attendance);
						 
						visit($run_attendance);

						}
						else if(isset($salesman) && isset($state) ){
							
						$get_attendance="select * from visits where user_name ='$salesman' AND school_state = '$state' order by date DESC";
						$run_attendance= mysqli_query($conn, $get_attendance);
						 
						visit($run_attendance);

						}
						else if(isset($salesman) && isset($salesman_id)){
							
						$get_attendance="select * from visits where user_id ='$salesman_id' order by date DESC";
						$run_attendance= mysqli_query($conn, $get_attendance);
						 
						visit($run_attendance);

						}
						else if(isset($state)){
							
						$get_attendance="select * from visits where school_state = '$state' order by date DESC";
						$run_attendance= mysqli_query($conn, $get_attendance);
						 
						visit($run_attendance);

						}
						else if(isset($start_date) && isset($end_date)){
							
						$get_attendance="select * from visits where date BETWEEN '$start_date' AND '$end_date' order by date DESC";
						$run_attendance= mysqli_query($conn, $get_attendance);
						 
						visit($run_attendance);

						}
						else{
						
						$specimen_given = "";
						$get_attendance="select * from visits where user_id ='$salesman_id' AND school_id='$school_id' ";
						$run_attendan= mysqli_query($conn, $get_attendance);
						
						while($row_attendance=mysqli_fetch_array($run_attendan))
						{
							$salesman = $row_attendance['user_name'];
							$s_name = $row_attendance['school_name'];
							$s_city = $row_attendance['school_city'];
							$board = $row_attendance['board'];
							$strength = $row_attendance['strength'];
							$c_person = $row_attendance['contact_person'];
							$c_person_no = $row_attendance['contact_person_no'];
							$contact_info = $c_person." - ".$c_person_no."<br> ";
							$supply = $row_attendance['supply_through'];
							$specimen_given = $row_attendance['specimen_given']."<br> ".$specimen_given; 
						}
						
						
						echo "<tr >
							<td>$s_name</td>
							<td>$s_city</td>
							<td>$board</td>
							<td>$strength</td>
							<td>$contact_info</td>
							<td></td>
							<td>$supply</td>
							<td>$specimen_given</td>
							</tr>
							
							";
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
			
			
        </div>
    </div>
	<iframe id="txtArea1" style="display:none"></iframe>
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

							$("#person").append("<option value='"+name+"'>"+name+"</option>");

						}
					}
				});
			});
			
			$("#statedd").change(function(){
				
				var state =  $(this).val();

				$.ajax({
					url: 'get_cities.php',
					type: 'GET',
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
			$("#statedd").change(function(){
				
				var state =  $(this).val();

				$.ajax({
					url: 'get_states_school.php',
					type: 'GET',
					data: {'shahrukh':state},
					dataType: 'json',
					success:function(response){

						var len = response.length;

						$("#school").empty();
						$("#school").append("<option disabled selected value=''>Select School</option>");
						for( var i = 0; i<len; i++){
							var id = response[i]['id'];
							var name = response[i]['name'];
							$("#school").append("<option value='"+name+"'>"+name+"</option>");

						}
					}
				});
			});
			$("#city").change(function(){
				var state = $('#statedd').val();
				var city =  $(this).val();

				$.ajax({
					url: 'get_specific_schools.php',
					type: 'GET',
					data: {'shahrukh':state,'city':city},
					dataType: 'json',
					success:function(response){

						var len = response.length;
						$("#school").empty();
						$("#school").append("<option disabled selected value=''>Select School</option>");
						for( var i = 0; i<len; i++){
							var name = response[i]['name'];

							$("#school").append("<option value='"+name+"'>"+name+"</option>");

						}
					}
				});
			});
			
			$("#city").change(function(){
				var state = $('#statedd').val();
				var city =  $(this).val();

				$.ajax({
					url: 'get_specific_users.php',
					type: 'GET',
					data: {'shahrukh':state,'city':city},
					dataType: 'json',
					success:function(response){

						var len = response.length;
						$("#person").empty();
						$("#person").append("<option disabled selected value=''>Select Salesman</option>");
						for( var i = 0; i<len; i++){
							var name = response[i]['name'];

							$("#person").append("<option value='"+name+"'>"+name+"</option>");

						}
					}
				});
			});
			
			$("#school").change(function(){
				var state = $('#statedd').val();
				var school =  $(this).val();

				$.ajax({
					url: 'get_specific_contact_person.php',
					type: 'GET',
					data: {'shahrukh':state,'school':school},
					dataType: 'json',
					success:function(response){

						var len = response.length;
						$("#person").empty();
						$("#person").append("<option disabled selected value=''>Select Salesman</option>");
						for( var i = 0; i<len; i++){
							var name = response[i]['name'];

							$("#person").append("<option value='"+name+"'>"+name+"</option>");

						}
					}
				});
			});
			
			
        });
		
		function fnExcelReport()
		{
			var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
			var textRange; var j=0;
			tab = document.getElementById('school_list'); // id of table

			for(j = 0 ; j < tab.rows.length ; j++) 
			{     
				tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
				//tab_text=tab_text+"</tr>";
			}

			tab_text=tab_text+"</table>";
			tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
			tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
			tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

			var ua = window.navigator.userAgent;
			var msie = ua.indexOf("MSIE "); 

			if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
			{
				txtArea1.document.open("txt/html","replace");
				txtArea1.document.write(tab_text);
				txtArea1.document.close();
				txtArea1.focus(); 
				sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
			}  
			else                 //other browser not tested on IE 11
				sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

			return (sa);
		}
		
		
		
		/*function exportTableToExcel(tableID, filename = ''){
				var downloadLink;
				var dataType = 'application/vnd.ms-excel';
				var tableSelect = document.getElementById(tableID);
				var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
				
				// Specify file name
				filename = filename?filename+'.xls':'excel_data.xls';
				
				// Create download link element
				downloadLink = document.createElement("a");
				
				document.body.appendChild(downloadLink);
				
				if(navigator.msSaveOrOpenBlob){
					var blob = new Blob(['\ufeff', tableHTML], {
						type: dataType
					});
					navigator.msSaveOrOpenBlob( blob, filename);
				}else{
					// Create a link to the file
					downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
				
					// Setting the file name
					downloadLink.download = filename;
					
					//triggering the function
					downloadLink.click();
				}
		}*/
    </script>
</body>

</html>