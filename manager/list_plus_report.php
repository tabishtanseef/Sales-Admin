<!DOCTYPE html>
<?php 
session_start();

include_once("include/db_connect.php");
if (!isset($_SESSION['manager_id'])) {
header ("location:login.php");
}
$error = false;

if(isset($_GET['salesman_id']))
{
	$salesman_id =$_GET['salesman_id'];
	$get_attendance="select * from users where uid ='$salesman_id'";
	$run_attendance= mysqli_query($conn, $get_attendance);
	$row_attendance=mysqli_fetch_array($run_attendance);
	$salesman = $row_attendance['user'];
}
else{
	header ("location:index.php");
}
function school($run_attendance,$conn) {
	$n=1;
while($row_attendance=mysqli_fetch_array($run_attendance))
	{
		$salesman_id = $row_attendance['user_id'];
		$salesman = $row_attendance['user_name'];
		$school_id = $row_attendance['id'];
		$school_name = $row_attendance['school_name'];
		$school_code = $row_attendance['school_code'];
		$school_board = $row_attendance['school_board'];
		$school_strength = $row_attendance['school_strength'];
		$school_contact = $row_attendance['school_contact'];
		$school_email = $row_attendance['school_email'];
		$school_address = $row_attendance['school_address'];
		$school_city = $row_attendance['school_city'];
		$school_state = $row_attendance['school_state'];
		$is_deleted = $row_attendance['is_deleted'];
		
		if($is_deleted==0){
			
		
		
			$sql21 = "select * from visits WHERE school_id = '$school_id' and is_deleted='0' order by date DESC, id DESC" ;
			$result21 = mysqli_query($conn,$sql21);
			
			$j1 = mysqli_num_rows ( $result21 );
			
			echo "<tr title='$salesman'>
			<td>$n</td>
			<td class='link'>$school_name</td>
			<td>$school_id</td>
			<td>$school_board <br>$school_strength</td>
			<td>$school_address</td>
			<td>$school_city</td>
			<td>$j1</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
			</tr>
			";
			
			while($row=mysqli_fetch_array($result21)){
			
				$date = $row['date'];
				$c_person = $row['contact_person'];
				$c_person_no = $row['contact_person_no'];
				$supply = $row['supply_through'];
				$specimen_given = $row['specimen_given'];
				$specimen_required = $row['specimen_required'];
				$school_comment = $row['school_comment'];
				$your_comment = $row['your_comment'];
				$is_deleted2 = $row['is_deleted'];
				$date = date("d-M-Y", strtotime($date));
				
				echo "
				<tr>
				<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
				
				<td>$date</td>
				<td>$c_person ($c_person_no )</td>
				<td>$supply</td>
				<td>$specimen_given</td>
				<td>$specimen_required</td>
				<td>$school_comment</td>
				<td>$your_comment</td>
				</tr>
				
				";
			
			}
			echo "<tr>
				<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
				</tr>";	
		}
		$n++;
	}	
}
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>School List - Good Luck Sales - Digigoodluck.com</title>
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
		font-size:14px;
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
	.link{
		font-weight:bold;
		color:#E85A4F;
		text-align:left;
	}
	</style>
</head>

<body>

    <div class="wrapper">
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
					<a class="navbar-brand" href="index.php">
						<img src="img/sales.png" style="width:60%; padding:10px;" alt="">
					</a>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item">
								<div class="form-group">
									&nbsp;&nbsp;
									&nbsp;&nbsp;<a href="logout.php"><button class="btn" style="background:#FAB016; color:white; font-weight:bold;" />Log Out</button></a>
					             </div>
					        </li>
							<li class="nav-item">
								<div class="form-group">
									&nbsp;&nbsp;<input type="submit" id="btnExport" onclick="fnExcelReport();" value="Export to Excel" class="btn" style="background:#35B394; color:white; font-weight:bold;" />
					             </div>
					        </li>
                        </ul>
                    </div>
					<button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                </div>
            </nav>
			<?php
			if(isset($salesman) || isset($salesman_id) ){
				echo "<h4>&nbsp;&nbsp;&nbsp;&nbsp; School List of $salesman</h4>";
			}
			?>
			
			<div class="row sub" style="margin-top:2%;">
				<div class="col-sm-12 horizontal-scroll">
					<table id="school_list" class="table table-hover table-bordered table-striped table-responsive w-100 d-block d-md-table" style="width:100%;">
						<thead>
						<th>Sr. No.</th>
						<th>School Name</th>
						<th>School ID</th>
						<th>School Board & Strength</th>
						<th>School Address</th>
						<th>School City</th>
						<th>No. of Visits</th>
						<th>Date</th>
						<th>Contact Info</th>
						<th>Supply Through</th>
						<th>Specimen Given</th>
						<th>Specimen Required</th>
						<th>School Comment</th>
						<th>Your Comment</th>
						</thead>
						<tbody>
						
						<?php						
						if(isset($salesman) && isset($state) && isset($city)){
							
						$get_attendance="select * from school_list where user_name ='$salesman' AND school_state = '$state' and school_city='$city' and is_deleted='0' order by school_name";
						$run_attendance= mysqli_query($conn, $get_attendance);
						 
						school($run_attendance,$conn);	
						}
						else if(isset($salesman) && isset($state)){
							
						$get_attendance="select * from school_list where user_name ='$salesman' AND school_state = '$state' and is_deleted='0' order by school_name";
						$run_attendance= mysqli_query($conn, $get_attendance);
						 
						school($run_attendance,$conn);	
						}
						
						else if(isset($state) && isset($city)){
							
						$get_attendance="select * from school_list where school_state = '$state' AND school_city='$city' and is_deleted='0' order by school_name";
						$run_attendance= mysqli_query($conn, $get_attendance);
						 
						school($run_attendance,$conn);	
						}
						else if(isset($salesman_id)){
							
						$get_attendance="select * from school_list where user_id = '$salesman_id' and is_deleted='0' order by school_name";
						$run_attendance= mysqli_query($conn, $get_attendance);
						 
						school($run_attendance,$conn);	
						}
						else if(isset($state)){
							
						$get_attendance="select * from school_list where school_state = '$state' and is_deleted='0' order by school_name";
						$run_attendance= mysqli_query($conn, $get_attendance);
						 
						school($run_attendance,$conn);	
						}
						else{
						
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
		
    </script>
</body>

</html>