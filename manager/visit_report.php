<!DOCTYPE html>
<?php 
session_start();
include_once("include/db_connect.php");
if (!isset($_SESSION['manager_id'])) {
	header ("location:login.php");
}
else{
	$m_id=$_SESSION['manager_id'];
	$state = $_SESSION['manager_state'];
}

$error = false;

if(isset($_GET['salesman_id']) && isset($_GET['salesman']) && isset($_GET['start_date']) && isset($_GET['end_date']))
{
	$start_date =$_GET['start_date'];
	$end_date =$_GET['end_date'];
	$_SESSION['salesman_id'] =$_GET['salesman_id'];
	$_SESSION['salesman'] =$_GET['salesman'];
}
else if(isset($_GET['salesman_id']) && isset($_GET['salesman']))
{
	$_SESSION['salesman_id'] =$_GET['salesman_id'];
	$_SESSION['salesman'] =$_GET['salesman'];
}

else if(isset($_GET['start_date']) && isset($_GET['end_date']))
{
	$start_date =$_GET['start_date'];
	$end_date =$_GET['end_date'];
}

$salesman_id=$_SESSION['salesman_id'];
$salesman=$_SESSION['salesman'];

if (isset($_POST['go'])) {
	
	$start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
	$end_date = mysqli_real_escape_string($conn, $_POST['end_date']);
	
header ("location:visit_report.php?salesman_id=$salesman_id&salesman=$salesman&start_date=$start_date&end_date=$end_date");

}

function visit($run_attendance) {
	$n=1;
    while($row_attendance=mysqli_fetch_array($run_attendance))
	{
		$v_id = $row_attendance['id'];
		$salesman = $row_attendance['user_name'];
		$date = $row_attendance['date'];
		$time = $row_attendance['time'];
		$day = $row_attendance['day'];
		$s_name = $row_attendance['school_name'];
		$s_city = $row_attendance['school_city'];
		$board = $row_attendance['board'];
		$strength = $row_attendance['strength'];
		$c_person = $row_attendance['contact_person'];
		$c_person_no = $row_attendance['contact_person_no'];
		$supply = $row_attendance['supply_through'];
		$specimen_given = $row_attendance['specimen_given'];
		$specimen_required = $row_attendance['specimen_required'];
		$school_comment = $row_attendance['school_comment'];
		$your_comment = $row_attendance['your_comment'];
		$date = date("d-M-Y", strtotime($date));
		
		echo "<tr title='$salesman'>
		<td>$n</td>
		<td>$date</td>
		<td>$time</td>
		<td>$day</td>
		<td>$s_name</td>
		<td>$s_city</td>
		<td>$board</td>
		<td>$strength</td>
		<td>$c_person</td>
		<td>$c_person_no</td>
		<td>$supply</td>
		<td>$specimen_given</td>
		<td>$specimen_required</td>
		<td>$school_comment</td>
		<td>$your_comment</td>
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
					<form role="form" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
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
			if(isset($salesman) && isset($salesman_id)){
				echo "<h4>&nbsp;&nbsp;&nbsp;&nbsp; Visit Report of $salesman</h4>";
			}
			?>
			<div class="row sub" style="margin-top:2%;">
				<div class="col-sm-12 horizontal-scroll">
					<table id="school_list" class="table table-hover table-striped table-bordered table-responsive w-100 d-block d-md-table" style="width:100%;">
						<thead>
						 <th>Sr. No.</th>
						<th>Date</th>
						<th>Time</th>
						<th>Day</th>
						<th>School Name</th>
						<th>School City</th>
						<th>Board</th>
						<th>Strength</th>
						<th>Contact Person</th>
						<th>Contact No.</th>
						<th>Supply Through</th>
						<th>Specimen Given</th>
						<th>Specimen Required</th>
						<th>School Comment</th>
						<th>Your Comment</th>
						</thead>
						<tbody>
						<?php
						if(isset($salesman_id) && isset($start_date) && isset($end_date)){
							$get_attendance="select * from visits where user_id ='$salesman_id' and date BETWEEN '$start_date' AND '$end_date' and is_deleted='0' order by date DESC, id DESC";
							$run_attendance= mysqli_query($conn, $get_attendance);
							visit($run_attendance);
						}
						else{
							$get_attendance="select * from visits where user_id ='$salesman_id' and is_deleted='0' order by date DESC, id DESC";
							$run_attendance= mysqli_query($conn, $get_attendance);
							visit($run_attendance);
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