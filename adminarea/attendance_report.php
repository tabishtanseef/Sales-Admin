<!DOCTYPE html>
<?php 
session_start();
include_once("include/db_connect.php");
if (!isset($_SESSION['admin_id'])) {
header ("location:login.php");
}
$error = false;


if(isset($_GET['salesman']) && isset($_GET['state']) && isset($_GET['city']) && isset($_GET['month']))
{
	$month =$_GET['month'];
	$state =$_GET['state'];
	$city =$_GET['city'];
	$salesman =$_GET['salesman'];
}
else if(isset($_GET['salesman']) && isset($_GET['state']) && isset($_GET['city']))
{
	$state =$_GET['state'];
	$city =$_GET['city'];
	$salesman =$_GET['salesman'];
}

else if(isset($_GET['salesman']) && isset($_GET['state']) && isset($_GET['month']))
{
	$month =$_GET['month'];
	$state =$_GET['state'];
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
		$salesman_error = "Please select a salesmans";
	}
	else{
		$salesman = mysqli_real_escape_string($conn, $_POST['salesman']);	
	}
	
	if(!isset($_POST['month'])){
		$error = true;
	}
	else{
		$month = mysqli_real_escape_string($conn, $_POST['month']);	
	}
	
	if(!$error){
		header ("location:attendance_report.php?salesman=$salesman&state=$state&city=$city&month=$month");
	}

}
function getAttendance($run_attendance){
	
	$n=1;
	while($row_attendance=mysqli_fetch_array($run_attendance))
	{
		
		$date = $row_attendance['date'];
		$day = $row_attendance['day'];
		$start_time = $row_attendance['start_time'];
		$end_time = $row_attendance['end_time'];
		$date = date("d-M-Y", strtotime($date));
		
		
		echo "<tr>
		<td>$n</td>
		<td>$day</td>
		<td>$date</td>
		<td>$start_time</td>
		<td>$end_time</td>
		
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
	<meta http-equiv="content-type" content="text/plain; charset=UTF-8"/>
    <title>Attendance Report - Good Luck Sales - Digigoodluck.com</title>
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
									
									<select name="salesman" id="person" class="form-control" />
									<option selected disabled>Select Salesman</option>
									</select>
									<span class="text-danger"><?php if (isset($salesman_error)) echo $salesman_error; ?></span>
								</div>
							</li>
							&nbsp;&nbsp;
							<li class="nav-item active">
                               <div class="form-group">
									<select name="month" id="month" class="form-control" />
									<option selected disabled>Select Month</option>
									<option value="January">January</option>
									<option value="February">February</option>
									<option value="March">March</option>
									<option value="April">April</option>
									<option value="May">May</option>
									<option value="June">June</option>
									<option value="July">July</option>
									<option value="August">August</option>
									<option value="September">September</option>
									<option value="October">October</option>
									<option value="November">November</option>
									<option value="December">December</option>
									</select>
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
			if(isset($salesman)){
			echo "<h4>&nbsp;&nbsp;&nbsp;&nbsp; Attendance Report of $salesman</h4>";
			}
			?>
			<div class="row sub" style="margin-top:2%;">
				<div class="col-sm-12 horizontal-scroll">
					<table id="attendance_report" class="table table-hover table-responsive w-100 d-block d-md-table" style="width:100%;">
						<thead>
						<th>Sr. No.</th>
						<th>Day</th>
						<th>Date</th>
						<th>Start Time</th>
						<th>End Time</th>
						</thead>
						<tbody>
						<?php
						$n=1;
						
						if(isset($salesman) && isset($month)){
							
						$get_attendance="select * from attendance where user_name ='$salesman' order by date DESC";
						$run_attendance= mysqli_query($conn, $get_attendance);
						 
						while($row_attendance=mysqli_fetch_array($run_attendance))
						{
							
							$date = $row_attendance['date'];
							$day = $row_attendance['day'];
							$start_time = $row_attendance['start_time'];
							$end_time = $row_attendance['end_time'];
							$date = date("d-M-Y", strtotime($date));
							
							$time=strtotime($date);
							$db_month=date("F",$time);
							if( $month == $db_month){
							
							echo "<tr>
							<td>$n</td>
							<td>$day</td>
							<td>$date</td>
							<td>$start_time</td>
							<td>$end_time</td>
							
							</tr>
							
							";
							$n++; 
							}
							else{
								
							}
						  
						}
						}
						
						else if(isset($salesman)){
							
						$get_attendance="select * from attendance where user_name ='$salesman' order by date DESC";
						$run_attendance= mysqli_query($conn, $get_attendance);
						 
						getAttendance($run_attendance);
						}
						
						
						
						
						else if(isset($salesman_id)){
							
						$get_attendance="select * from attendance where user_id ='$salesman_id' order by date DESC";
						$run_attendance= mysqli_query($conn, $get_attendance);
						getAttendance($run_attendance);
						}
						else{
						}
						?>
						</tbody>
					</table>
					


				</div>
			</div>
			<!--  my work    -->
		
			
			
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
		tab = document.getElementById('attendance_report'); // id of table

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