<!DOCTYPE html>
<?php 
session_start();
include_once("include/db_connect.php");
if (!isset($_SESSION['admin_id'])) {
header ("location:login.php");
}
$error = false;

if(isset($_GET['salesman']) && isset($_GET['state']) && isset($_GET['city']))
{
	$state =$_GET['state'];
	$city =$_GET['city'];
	$salesman =$_GET['salesman'];
}
else if(isset($_GET['salesman']) && isset($_GET['state']))
{
	$state =$_GET['state'];
	$salesman =$_GET['salesman'];
}
else if(isset($_GET['salesman_id']) && isset($_GET['salesman']))
{
	$salesman_id =$_GET['salesman_id'];
	$salesman =$_GET['salesman'];
}
else if(isset($_GET['state']) && isset($_GET['city']))
{
	$city =$_GET['city'];
	$state =$_GET['state'];
}
else if(isset($_GET['state']))
{
	$state =$_GET['state'];
}

if (isset($_POST['go'])) {
	if(!isset($_POST['school_state'])){
	$error = true;
	$state_error = "Please select a state";
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
	if(!isset($_POST['salesman'])){
	$error = true;
	}
	else{
			$salesman = mysqli_real_escape_string($conn, $_POST['salesman']);
	}
	if(!$error){
		header ("location:school_list.php?salesman=$salesman&state=$state&city=$city");
		
	}
	
}
function school($run_attendance) {
	$n=1;
while($row_attendance=mysqli_fetch_array($run_attendance))
	{
		
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
		
		
		
		echo "<tr title='$salesman'>
		<td>$n</td>
		<td class='link'>$school_name</td>
		<td>$school_id</td>
		<td>$school_board</td>
		<td>$school_strength</td>
		<td>$school_contact</td>
		<td>$school_email</td>
		<td>$school_address</td>
		<td>$school_city</td>
		<td>$school_state</td>
		
		
		</tr>
		
		";
	  $n++; 
	}	
	
	
}
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Good Luck Sales</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/stl.css">
	<link rel="stylesheet" href="MDB/css/mdb.min.css">
	<!-- Your custom styles (optional) -->
	<link href="MDB/css/addons/datatables.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Google Fonts Roboto -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
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
	font-size:18px !important; 
	font-weight:bold !important	;
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
					<form role="form" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
								<br>
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
							<br>
                               <div class="form-group">
									<select name="city" id="city" class="form-control" />
									<option selected disabled>Select City</option>
									</select>
								</div>
                            </li>
							&nbsp;&nbsp;
							<li class="nav-item active">
							<br>
                               <div class="form-group">
									<select name="salesman" id="person" class="form-control" />
									<option selected disabled>Select Salesman</option>
									</select>
									<span class="text-danger"><?php if (isset($salesman_error)) echo $salesman_error; ?></span>
								</div>
                            </li>
							<li class="nav-item">
								<div class="form-group">
									&nbsp;&nbsp;<input type="submit" name="go" value="Go!" class="btn" style="background:#fab017; font-weight:bold;" />
					             </div>
					        </li>
							<li class="nav-item">
								<div class="form-group">
									&nbsp;&nbsp;<input type="submit" id="btnExport" onclick="fnExcelReport();" value="Export to Excel" class="btn" style="background:#35B394; color:white; font-weight:bold;" />
					             </div>
					        </li>
                        </ul>
                    </div>
					</form>
                </div>
            </nav>
			<?php
			if(isset($salesman) && isset($city) && isset($state)){
				echo "<h4>&nbsp;&nbsp;&nbsp;&nbsp; School List of $salesman in $state - $city</h4>";
			}
			else if(isset($salesman) && isset($state)){
			echo "<h4>&nbsp;&nbsp;&nbsp;&nbsp; School List of $salesman in $state</h4>";
			}
			else if(isset($city) && isset($state)){
			echo "<h4>&nbsp;&nbsp;&nbsp;&nbsp; School List of $state - $city</h4>";
			}
			else if(isset($state)){
			echo "<h4>&nbsp;&nbsp;&nbsp;&nbsp; School List of $state</h4>";
			}
			else if(isset($salesman)){
			echo "<h4>&nbsp;&nbsp;&nbsp;&nbsp; School List of $salesman</h4>";
			}
			?>
			
			<div class="row sub" style="margin-top:2%;">
				<div class="col-sm-12 horizontal-scroll">
					<table id="school_list" class="table table-hover table-responsive table-bordered table-striped w-100 d-block d-md-table" style="width:100%;">
						<thead>
						<th>Sr. No.</th>
						<th>School Name</th>
						<th>School ID</th>
						<th>School Board</th>
						<th>School Strength</th>
						<th>Contact No.</th>
						<th>School Email</th>
						<th>School Address</th>
						<th>School City</th>
						<th>School State</th>
						
						</thead>
						<tbody>
						<?php
						
						
						if(isset($salesman) && isset($state) && isset($city)){
							
						$get_attendance="select * from school_list where user_name ='$salesman' AND school_state = '$state' and school_city='$city' order by school_name";
						$run_attendance= mysqli_query($conn, $get_attendance);
						 
						school($run_attendance);
						}
						else if(isset($salesman) && isset($state)){
							
						$get_attendance="select * from school_list where user_name ='$salesman' AND school_state = '$state' order by school_name";
						$run_attendance= mysqli_query($conn, $get_attendance);
						 
						school($run_attendance);
						}
						
						else if(isset($state) && isset($city)){
							
						$get_attendance="select * from school_list where school_state = '$state' AND school_city='$city' order by school_name";
						$run_attendance= mysqli_query($conn, $get_attendance);
						 
						school($run_attendance);
						}
						else if(isset($salesman_id)){
							
						$get_attendance="select * from school_list where user_id = '$salesman_id' order by school_name";
						$run_attendance= mysqli_query($conn, $get_attendance);
						 
						school($run_attendance);
						}
						else if(isset($state)){
							
						$get_attendance="select * from school_list where school_state = '$state' order by school_name";
						$run_attendance= mysqli_query($conn, $get_attendance);
						 
						school($run_attendance);
						}
						else{
						$get_attendance="select * from school_list order by school_name";
						$run_attendance= mysqli_query($conn, $get_attendance);
						 
						school($run_attendance);	
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
<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="MDB/js/popper.min.js"></script>
	<!-- Bootstrap core JavaScript -->
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="MDB/js/addons/datatables.min.js"></script>
	<script type="text/javascript" src="MDB/js/mdb.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
			
			$('#school_list').DataTable();
			$('.dataTables_length').addClass('bs-select');
			
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