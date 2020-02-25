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
if(isset($salesman_id)){
	$gat ="select * from users where uid ='$salesman_id'";
	$rat = mysqli_query($conn,$gat);
	$raw = mysqli_fetch_array($rat);
	$salesman = $raw['user'];
}
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add QB Stock - Good Luck Sales - Digigoodluck.com</title>
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
	th{
		border:1px solid;
		color:#32B394;
		font-size:20px;
		text-align:center;
	}
	td{
		text-align:center;
		font-size:20px;
		border:1px solid;
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
						$cbse1_a = $row_attendance['cbse1_a'];
						$cbse2_a = $row_attendance['cbse2_a'];
						$cbse3_a = $row_attendance['cbse3_a'];
						$cbse4_a = $row_attendance['cbse4_a'];
						$cbse5_a = $row_attendance['cbse5_a'];
						$cbse6_a = $row_attendance['cbse6_a'];
						$cbse7_a = $row_attendance['cbse7_a'];
						$icse1_a = $row_attendance['icse1_a'];
						$icse2_a = $row_attendance['icse2_a'];
						$icse3_a = $row_attendance['icse3_a'];
						$icse4_a = $row_attendance['icse4_a'];
						$icse5_a = $row_attendance['icse5_a'];
						$icse6_a = $row_attendance['icse6_a'];
						$icse7_a = $row_attendance['icse7_a'];
						$icse8_a = $row_attendance['icse8_a'];
						$icse9_a = $row_attendance['icse9_a'];
					   $icse10_a = $row_attendance['icse10_a'];
					    
						$given_cbse1 = $cbse1_a - $cbse1;
						$given_cbse2 = $cbse2_a - $cbse2;
						$given_cbse3 = $cbse3_a - $cbse3;
						$given_cbse4 = $cbse4_a - $cbse4;
						$given_cbse5 = $cbse5_a - $cbse5;
						$given_cbse6 = $cbse6_a - $cbse6;
						$given_cbse7 = $cbse7_a - $cbse7;
						$given_icse1 = $icse1_a - $icse1;
						$given_icse2 = $icse2_a - $icse2;
						$given_icse3 = $icse3_a - $icse3;
						$given_icse4 = $icse4_a - $icse4;
						$given_icse5 = $icse5_a - $icse5;
						$given_icse6 = $icse6_a - $icse6;
						$given_icse7 = $icse7_a - $icse7;
						$given_icse8 = $icse8_a - $icse8;
						$given_icse9 = $icse9_a - $icse9;
					   $given_icse10 = $icse10_a - $icse10;
					   
					   
						$get="select * from qb_school_list where user_id='$salesman_id' and school_board='CBSE'";
						$run= mysqli_query($conn, $get);
						$row=mysqli_num_rows($run);
						
						$get1="select * from qb_school_list where user_id='$salesman_id' and school_board='ICSE'";
						$run1= mysqli_query($conn, $get1);
						$row2=mysqli_num_rows($run1);
						
						$sql1 = "select * from qb_visit WHERE user_id='$salesman_id'" ;
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
						
					?>
                    <form role="form" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
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
            
			<div class="container-fluid" style="min-height:500px;">
			<div class="container-fluid out">
				<div class="row">
					<div class="col-md-12 col-md-offset-12 well">
					<table id="school_list2" class="table table-striped table-responsive w-100 d-block d-md-table" style="border:2px solid; width:100%;">
						<tbody>
						<tr>
						<th colspan="10" style="color:black; padding:20px; border:1px solid; font-size:22px;">CBSE Specimen Details of <?php echo $salesman; ?></th>
						</tr>
						<tr>
						<th></th>
						<th></th>
						<th>Subject</th>
						<th>English</th>
						<th>Hindi A</th>
						<th>Hindi B</th>
						<th>Math Basic</th>
						<th>Math Standard</th>
						<th>Science</th>
						<th>Social Studies</th>
						</tr>
						<tr>
						<th>Total School </th>
						<th><?php echo $row;?></th>
						<th>Provided</th>
						<td><?php echo $cbse1_a; ?></td>
						<td><?php echo $cbse2_a; ?></td>
						<td><?php echo $cbse3_a; ?></td>
						<td><?php echo $cbse4_a; ?></td>
						<td><?php echo $cbse5_a; ?></td>
						<td><?php echo $cbse6_a; ?></td>
						<td><?php echo $cbse7_a; ?></td>
						</tr>
						<tr>
						<th>Schools Covered </th>
						<th><?php echo $cbse;?></th>
						<th>Given</th>
						<td><?php echo $given_cbse1; ?></td>
						<td><?php echo $given_cbse2; ?></td>
						<td><?php echo $given_cbse3; ?></td>
						<td><?php echo $given_cbse4; ?></td>
						<td><?php echo $given_cbse5; ?></td>
						<td><?php echo $given_cbse6; ?></td>
						<td><?php echo $given_cbse7; ?></td>
						</tr>
						<tr>
						<th>Schools Remaining </th>
						<th><?php echo $row - $cbse;?></th>
						<th>Balance</th>
						<td><?php echo $cbse1; ?></td>
						<td><?php echo $cbse2; ?></td>
						<td><?php echo $cbse3; ?></td>
						<td><?php echo $cbse4; ?></td>
						<td><?php echo $cbse5; ?></td>
						<td><?php echo $cbse6; ?></td>
						<td><?php echo $cbse7; ?></td>
						</tr>
						</tbody>
					</table>
					
					<br>
					<br>
					<br>
					<table id="school_list" class="table table-striped table-responsive w-100 d-block d-md-table" style="border:2px solid; width:100%;">
						<tbody>
						<tr>
						<th colspan="13" style="color:black; padding:20px; border:1px solid; font-size:22px;">ICSE Specimen Details of <?php echo $salesman; ?></th>
						</tr>
						<tr>
						<th></th>
						<th></th>
						<th>Subject</th>
						<th>Biology</th>
						<th>Chemistry</th>
						<th>Computer</th>
						<th>Geography</th>
						<th>History & Civics</th>
						<th>English Literature</th>
						<th>English Language</th>
						<th>Math</th>
						<th>Physics</th>
						<th>Hindi</th>
						</tr>
						<tr>
						<th>Total Schools</th>
						<th><?php echo $row2;?></th>
						<th>Provided</th>
						<td><?php echo $icse1_a; ?></td>
						<td><?php echo $icse2_a; ?></td>
						<td><?php echo $icse3_a; ?></td>
						<td><?php echo $icse4_a; ?></td>
						<td><?php echo $icse5_a; ?></td>
						<td><?php echo $icse6_a; ?></td>
						<td><?php echo $icse7_a; ?></td>
						<td><?php echo $icse8_a; ?></td>
						<td><?php echo $icse9_a; ?></td>
						<td><?php echo $icse10_a; ?></td>
						</tr>
						<tr>
						<th>Schools Covered </th>
						<th><?php echo $icse;?></th>
						<th>Given</th>
						<td><?php echo $given_icse1; ?></td>
						<td><?php echo $given_icse2; ?></td>
						<td><?php echo $given_icse3; ?></td>
						<td><?php echo $given_icse4; ?></td>
						<td><?php echo $given_icse5; ?></td>
						<td><?php echo $given_icse6; ?></td>
						<td><?php echo $given_icse7; ?></td>
						<td><?php echo $given_icse8; ?></td>
						<td><?php echo $given_icse9; ?></td>
						<td><?php echo $given_icse10; ?></td>
						</tr>
						<tr>
						<th>Schools Remaining </th>
						<th><?php echo $row2 - $icse;?></th>
						<th>Balance</th>
						<td><?php echo $icse1; ?></td>
						<td><?php echo $icse2; ?></td>
						<td><?php echo $icse3; ?></td>
						<td><?php echo $icse4; ?></td>
						<td><?php echo $icse5; ?></td>
						<td><?php echo $icse6; ?></td>
						<td><?php echo $icse7; ?></td>
						<td><?php echo $icse8; ?></td>
						<td><?php echo $icse9; ?></td>
						<td><?php echo $icse10; ?></td>
						</tr>
						</tbody>
					</table>
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