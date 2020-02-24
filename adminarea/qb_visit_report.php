<!DOCTYPE html>
<?php 
session_start();
include_once("include/db_connect.php");
if (!isset($_SESSION['admin_id'])) {
header ("location:login.php");
}

if(isset($_GET['salesman_id']))
{
	$_SESSION['salesman_id'] =$_GET['salesman_id'];
}
$salesman_id = $_SESSION['salesman_id'];

?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ICSE QB Visit Report - Good Luck Sales - Digigoodluck.com</title>
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
					<button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
					<form role="form" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="">
                    
					<div class="collapse navbar-collapse" id="navbarSupportedContent1">
                        <ul class="nav navbar-nav ml-auto">
							&nbsp;&nbsp;
							<li class="nav-item">
								<div class="form-group">
								<span class="text-danger"></span><br>
									&nbsp;&nbsp;<input type="submit" id="btnExport" onclick="fnExcelReport(); " value="Export ICSE" class="btn" style="background:#35B394; color:white; font-weight:bold;" />
					             </div>
					        </li>
							<li class="nav-item">
								<div class="form-group">
								<span class="text-danger"></span><br>
									&nbsp;&nbsp;<input type="submit" id="btnExport" onclick="fnExcelReport2(); " value="Export CBSE" class="btn" style="background:#35B394; color:white; font-weight:bold;" />
					             </div>
					        </li>
                        </ul>
                    </div>
					</form>
                </div>
            </nav>
			<?php
			if(isset($salesman_id)){
				$gat ="select * from users where uid ='$salesman_id'";
				$rat = mysqli_query($conn,$gat);
				$raw = mysqli_fetch_array($rat);
				$salesman = $raw['user'];
				echo "<h4>&nbsp;&nbsp;&nbsp;&nbsp; ICSE Question Bank Visit of $salesman</h4>";
			}
			?>
			
			<div class="row sub" style="margin-top:2%;">
				<div class="col-sm-12 horizontal-scroll">
					<table id="school_list" class="table table-hover table-striped table-bordered table-responsive w-100 d-block d-md-table" style="width:100%;">
						<thead>
						<th>Sr. No.</th>
						<th>City</th>
						<th>ICSE School </th>
						<th>Board</th>
						<th>Strength</th>
						<th>Address</th>
						<th>Subject</th>
						<th>Teacher Name</th>
						<th>Contact No.</th>
						<th>Email</th>
						<th>Date</th>
						<th>Time</th>
						<th>Day</th>
						</thead>
						<tbody>
						<?php
							
						$n=1;
	
						$sql="select * from qb_school_list where user_id ='$salesman_id' and school_board='ICSE'";

						$result = mysqli_query($conn,$sql);

						$users_arr = array();

						while($row = mysqli_fetch_array($result) ){
							$name = $row['school_city'];
							$new = array_push($users_arr, $name);
							$users_arr = array_values(array_unique($users_arr,SORT_REGULAR));
						}

						//print_r($users_arr);

						$new = count($users_arr);
						$i = 0;

						while($i < $new){
							$sql1 = "select * from qb_visit WHERE city ='$users_arr[$i]' and user_id='$salesman_id' and board='ICSE'" ;
							$result1 = mysqli_query($conn,$sql1);
							
							$cbse_schools = array();
							$icse_schools = array();
							
							while($row1 = mysqli_fetch_array($result1) ){
								$school_id = $row1['school_id'];
								$board = $row1['board'];
								if($board=='ICSE'){
									array_push($icse_schools, $school_id);
									$icse_schools = array_values(array_unique($icse_schools,SORT_REGULAR));
								}
								else{
									array_push($cbse_schools, $school_id);
									$cbse_schools = array_values(array_unique($cbse_schools,SORT_REGULAR));
								}	
							}
							
							$cbse = count($cbse_schools);
							$icse = count($icse_schools);
							
							//print_r($cbse_schools);
							//print_r($icse_schools);
						$tabish2 = 0;
						$tabish = 0;
							while ($tabish<$cbse){
								$sql2 = "select * from qb_visit WHERE school_id='$cbse_schools[$tabish]' order by subject" ;
								$result2 = mysqli_query($conn,$sql2);
								$meri = 0;
								while($row2 = mysqli_fetch_array($result2) ){
								$city = $row2['city'];
								$school_name = $row2['school_name'];
								$board = $row2['board'];
								$strength = $row2['strength'];
								$address = $row2['address'];
								$subject = $row2['subject'];
								$t_name = $row2['t_name'];
								$t_num = $row2['t_num'];
								$t_email = $row2['t_email'];
								$date = $row2['date'];
								$day = $row2['day'];
								$time = $row2['time'];
								if($meri==0){
								  echo "<tr >
										<td>$n</td>
										<td>$city</td>
										<td>$school_name</td>
										<td>$board</td>
										<td>$strength</td>
										<td>$address</td>
										<td>$subject</td>
										<td>$t_name</td>
										<td>$t_num</td>
										<td>$t_email</td>
										<td>$date</td>
										<td>$day</td>
										<td>$time</td>
										</tr>";
								}
								else{
								  echo "<tr >
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td>$subject</td>
										<td>$t_name</td>
										<td>$t_num</td>
										<td>$t_email</td>
										<td>$date</td>
										<td>$day</td>
										<td>$time</td>
										</tr>";
								}
								$meri++;
								}
								$tabish++;
							}
							
							while ($tabish2<$icse){
								$sql2 = "select * from qb_visit WHERE school_id='$icse_schools[$tabish2]' order by subject" ;
								$result2 = mysqli_query($conn,$sql2);
								$teri = 0;
								while($row2 = mysqli_fetch_array($result2) ){
								$city = $row2['city'];
								$school_name = $row2['school_name'];
								$board = $row2['board'];
								$strength = $row2['strength'];
								$address = $row2['address'];
								$subject = $row2['subject'];
								$t_name = $row2['t_name'];
								$t_num = $row2['t_num'];
								$t_email = $row2['t_email'];
								$date = $row2['date'];
								$day = $row2['day'];
								$time = $row2['time'];
								  if($teri==0){
								  echo "<tr >
										<td>$n</td>
										<td>$city</td>
										<td>$school_name</td>
										<td>$board</td>
										<td>$strength</td>
										<td>$address</td>
										<td>$subject</td>
										<td>$t_name</td>
										<td>$t_num</td>
										<td>$t_email</td>
										<td>$date</td>
										<td>$day</td>
										<td>$time</td>
										</tr>";
								}
								else{
								  echo "<tr >
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td>$subject</td>
										<td>$t_name</td>
										<td>$t_num</td>
										<td>$t_email</td>
										<td>$date</td>
										<td>$day</td>
										<td>$time</td>
										</tr>";
								}
								$teri++;
								}
								$tabish2++;
							}
							$i++;
							$n++;
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
					url: 'get_qb_attendance.php',
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
					url: 'get_qb_states_school.php',
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
					url: 'get_qb_specific_schools.php',
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
					url: 'get_qb_specific_users.php',
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
					url: 'get_qb_specific_contact_person.php',
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
			
			$("#delete").click(function(){
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
		
		function fnExcelReport2()
		{
			var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
			var textRange; var j=0;
			tab = document.getElementById('school_list2'); // id of table

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
				sa2=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
			}  
			else                 //other browser not tested on IE 11
				sa2 = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

			return (sa2);
		}
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
		
    </script>
</body>

</html>