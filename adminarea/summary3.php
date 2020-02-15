<!DOCTYPE html>
<?php 
session_start();
include_once("include/db_connect.php");
if (!isset($_SESSION['admin_id'])) {
header ("location:login.php");
}
if(isset($_GET['salesman_id']) && isset($_GET['salesman']) && isset($_GET['state'])){
$_SESSION['salesman_id'] = $_GET['salesman_id'];
$_SESSION['salesman'] = $_GET['salesman'];
$_SESSION['state'] = $_GET['state'];

}
$error = false;
$salesman_id = $_SESSION['salesman_id'];
$salesman = $_SESSION['salesman'] ;
$state = $_SESSION['state'];


?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Summary - Good Luck Sales - Digigoodluck.com</title>
	<meta name="Description" content="Good Luck Sales is a software tool for the salesman working for a publication all over the country, to maintain all the records within the Good Luck Sales app with proper formatting and can deliver daily report precisely and on time.">
	<meta name="Keywords" content="digital, sales, marketing, software, marketing software, e-learning, digital learning, sales software, e-book software, e-books, electronic books, electronic learning, digigoodluck, goodluck, digigoodluck.com, goodluck.com, gl, g, good, luck, bad luck, 2019, 2018, saharanpur, delhi road, publication, good luck publishers, goodluck publication">
    
	<link rel="shortcut icon" href="img/favicon.png">

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style5.css">
	<link href="dist/attention.css" rel="stylesheet">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
<body >
<script src="dist/attention.js"></script>
<script >
function goSuccess(){
		$('.overlay1').addClass('active');
		new Attention.Alert({
			title: 'New Entry Success',
			content: 'Successfully Added!',
			afterClose: () => {
				$('.overlay1').removeClass('active');
			}
		});
	}
function goFailure(){
		$('.overlay1').addClass('active');
		new Attention.Alert({
			title: 'New Entry Failed',
			content: 'Failed',
			afterClose: () => {
				$('.overlay1').removeClass('active');
			}
		});
	}
</script>

<div class="overlay1"></div>
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
				<h2>&nbsp;&nbsp;&nbsp;&nbsp;Summary of <?php echo $_SESSION['salesman'];?></h2>
			<div class="container-fluid" style="min-height:500px;">
			<div class="container-fluid out">	
				<div class="row sub" style="margin-top:2%;">
				<div class="col-sm-12 horizontal-scroll">
					<table id="summary_report" class="table table-hover table-striped table-bordered table-dark table-responsive w-100 d-block d-md-table" style="width:100%;">
						<thead>
						<th>Sr. No.</th>
						<th>STATIONS</th>
						<th>BOARD</th>
						<th>No. of Schools</th>
						<th>Visited Schools</th>
						<th colspan="12">MONTHLY VISITS</th>
						<th></th>
						<th colspan="5">No. of Visits</th>
						</thead>
						<tbody>
						<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>Sep</td>
						<td>Oct</td>
						<td>Nov</td>
						<td>Dec</td>
						<td>Jan</td>
						<td>Feb</td>
						<td>Mar</td>
						<td>Apr</td>
						<td>May</td>
						<td>Jun</td>
						<td>Jul</td>
						<td>Aug</td>
						<td></td>
						<td>0 V</td>
						<td>1 V</td>
						<td>2 V</td>
						<td>3 V</td>
						<td>3+ V</td>
						</tr>
						
						
						<?php
						$n=1;
							
						$sql="select * from school_list where user_id ='$salesman_id' and is_deleted='0'";

						$result = mysqli_query($conn,$sql);

						$users_arr = array();

						while($row = mysqli_fetch_array($result) ){
							$name = $row['school_city'];
							$new = array_push($users_arr, $name);
							$users_arr = array_values(array_unique($users_arr,SORT_REGULAR));
						}
						
						$new = count($users_arr);
						
						
						$i = 0;
						
						$total_school =0;
						
						$total_visited =0;
						
						$total_jan = 0;
						$total_feb = 0;
						$total_mar = 0;
						$total_apr = 0;
						$total_may = 0;
						$total_jun = 0;
						$total_jul = 0;
						$total_aug = 0;
						$total_sep = 0;
						$total_oct = 0;
						$total_nov = 0;
						$total_dec = 0;
						$final_0_visit = 0;
						$final_1_visit = 0;
						$final_2_visit = 0;
						$final_3_visit = 0;
						$final_3p_visit = 0;
						
						
						
						while($i < $new){
							
							//counting no. of schools in particular city
							
							
							//CBSE
														
							$sql21 = "select * from school_list WHERE school_city ='$users_arr[$i]' and user_id='$salesman_id' and school_board = 'CBSE' and is_deleted='0'" ;

							$result21 = mysqli_query($conn,$sql21);

							$j1 = mysqli_num_rows ( $result21 );
							
							$c_visit0 = $j1;
							$c_visit1 = 0;
							$c_visit2 = 0;
							$c_visit3 = 0;
							$c_visit3p = 0;
							
							//ICSE
														
							$sql22 = "select * from school_list WHERE school_city ='$users_arr[$i]' and user_id='$salesman_id' and school_board = 'ICSE' and is_deleted='0'" ;

							$result22 = mysqli_query($conn,$sql22);

							$j2 = mysqli_num_rows ( $result22 );
							
							$i_visit0 = $j2;
							$i_visit1 = 0;
							$i_visit2 = 0;
							$i_visit3 = 0;
							$i_visit3p = 0;
							
							
							//STATE
														
							$sql23 = "select * from school_list WHERE school_city ='$users_arr[$i]' and user_id='$salesman_id' and school_board = 'STATE' and is_deleted='0'" ;

							$result23 = mysqli_query($conn,$sql23);

							$j3 = mysqli_num_rows ( $result23 );
							
							$s_visit0 = $j3;
							$s_visit1 = 0;
							$s_visit2 = 0;
							$s_visit3 = 0;
							$s_visit3p = 0;
							
							
							//counting complete


							//counting no. of visited schools in particular city

							
							//CBSE
							$sql31 = "select * from visits WHERE school_city ='$users_arr[$i]' and user_id='$salesman_id' and board ='CBSE' and is_deleted='0'" ;

							$result31 = mysqli_query($conn,$sql31);

							$visited_schools1 = array();
							$jan1 = 0;
							$feb1 = 0;
							$mar1 = 0;
							$apr1 = 0;
							$may1 = 0;
							$jun1 = 0;
							$jul1 = 0;
							$aug1 = 0;
							$sep1 = 0;
							$oct1 = 0;
							$nov1 = 0;
							$dec1 = 0;
							
							$u_cbse = array();
							
							while($row = mysqli_fetch_array($result31) ){
								$name = $row['school_id'];
								$xx = array_push($u_cbse, $name);
								$u_cbse = array_values(array_unique($u_cbse,SORT_REGULAR));
								
								$k1 = array_push($visited_schools1, $name);
								$visited_schools1 = array_values(array_unique($visited_schools1,SORT_REGULAR));
								$date = $row['date'];
								
								$date = date("d-M-Y", strtotime($date));
								$time=strtotime($date);
								
								$db_month=date("F",$time);
								
								if($db_month == "January"){ $jan1++; }
								else if($db_month == "February"){ $feb1++; }
								else if($db_month == "March"){ $mar1++; }
								else if($db_month == "April"){ $apr1++; }
								else if($db_month == "May"){ $may1++; }
								else if($db_month == "June"){ $jun1++; }
								else if($db_month == "July"){ $jul1++; }
								else if($db_month == "August"){ $aug1++; }
								else if($db_month == "September"){ $sep1++; }
								else if($db_month == "October"){ $oct1++; }
								else if($db_month == "November"){ $nov1++; }
								else if($db_month == "December"){ $dec1++; }
							}
							
							$tabish = count($u_cbse);
						//	echo "<script>alert($tabish);</script>";
							
							for($tab1=0; $tab1<$tabish; $tab1++){
								
								
								$my_query = "select * from visits WHERE school_id ='$u_cbse[$tab1]' and is_deleted='0'" ;


								$my_result = mysqli_query($conn,$my_query);

								$final_result = mysqli_num_rows($my_result);
								
							//	echo"<script>alert($name);</script>";
								
								if($final_result == 0){
									
								}
								else if($final_result == 1){
									$c_visit1++;
									$c_visit0--;
								}
								else if($final_result == 2){
									$c_visit2++;
									$c_visit0--;
								}
								else if($final_result == 3){
									$c_visit3++;
									$c_visit0--;
								}
								else if($final_result > 3){
									$c_visit3p++;
									$c_visit0--;
								}
								
							}
							
							$k1 = count($visited_schools1);
							echo "<pre>";
							print_r ($visited_schools1);
							
							
							
							
							
							
							//ICSE
							$sql32 = "select * from visits WHERE school_city ='$users_arr[$i]' and user_id='$salesman_id' and board ='ICSE' and is_deleted='0'" ;

							$result32 = mysqli_query($conn,$sql32);

							$visited_schools2 = array();
							$jan2 = 0;
							$feb2 = 0;
							$mar2 = 0;
							$apr2 = 0;
							$may2 = 0;
							$jun2 = 0;
							$jul2 = 0;
							$aug2 = 0;
							$sep2 = 0;
							$oct2 = 0;
							$nov2 = 0;
							$dec2 = 0;
							
							$u_icse = array();



							while($row = mysqli_fetch_array($result32) ){
								$name = $row['school_id'];
								
								$yy = array_push($u_icse, $name);
								$u_icse = array_values(array_unique($u_icse,SORT_REGULAR));
								$k2 = array_push($visited_schools2, $name);
								$visited_schools2 = array_values(array_unique($visited_schools2,SORT_REGULAR));
								
								$date = $row['date'];
								$date = date("d-M-Y", strtotime($date));
								$time=strtotime($date);
								$db_month=date("F",$time);
								 if($db_month == "January"){ $jan2++; }
								 else if($db_month == "February"){ $feb2++; }
								 else if($db_month == "March"){ $mar2++; }
								 else if($db_month == "April"){ $apr2++; }
								 else if($db_month == "May"){ $may2++; }
								 else if($db_month == "June"){ $jun2++; }
								 else if($db_month == "July"){ $jul2++; }
								 else if($db_month == "August"){ $aug2++; }
								 else if($db_month == "September"){ $sep2++; }
								 else if($db_month == "October"){ $oct2++; }
								 else if($db_month == "November"){ $nov2++; }
								 else if($db_month == "December"){ $dec2++; }
							}
							
							$tabish2 = count($u_icse);
						//	echo "<script>alert($tabish);</script>";
							
							for($tab2=0; $tab2<$tabish2; $tab2++){
								
								
								$my_query = "select * from visits WHERE school_id ='$u_icse[$tab2]' and is_deleted='0'" ;

								$my_result = mysqli_query($conn,$my_query);

								$final_result = mysqli_num_rows ( $my_result );
								
								if($final_result == 1){
									$i_visit1++;
									$i_visit0--;
								}
								else if($final_result == 2){
									$i_visit2++;
									$i_visit0--;
								}
								else if($final_result == 3){
									$i_visit3++;
									$i_visit0--;
								}
								else if($final_result > 3){
									$i_visit3p++;
									$i_visit0--;
								}
								
							}
							
							$k2 = count($visited_schools2);
							echo "<pre>";
							print_r ($visited_schools2);
							//STATE
							$sql33 = "select * from visits WHERE school_city ='$users_arr[$i]' and user_id='$salesman_id' and board ='STATE' and is_deleted='0'" ;

							$result33 = mysqli_query($conn,$sql33);

							$visited_schools3 = array();
							$jan3 = 0;
							$feb3 = 0;
							$mar3 = 0;
							$apr3 = 0;
							$may3 = 0;
							$jun3 = 0;
							$jul3 = 0;
							$aug3 = 0;
							$sep3 = 0;
							$oct3 = 0;
							$nov3 = 0;
							$dec3 = 0;
							
							$u_state = array();

							while($row = mysqli_fetch_array($result33) ){
								$name = $row['school_id'];
								$zz = array_push($u_state, $name);
								$u_state = array_values(array_unique($u_state,SORT_REGULAR));
								$k3 = array_push($visited_schools3, $name);
								$visited_schools3 = array_values(array_unique($visited_schools3,SORT_REGULAR));
								
								$date = $row['date'];
								$date = date("d-M-Y", strtotime($date));
								$time=strtotime($date);
								$db_month=date("F",$time);
								 if($db_month == "January"){ $jan3++; }
								 else if($db_month == "February"){ $feb3++; }
								 else if($db_month == "March"){ $mar3++; }
								 else if($db_month == "April"){ $apr3++; }
								 else if($db_month == "May"){ $may3++; }
								 else if($db_month == "June"){ $jun3++; }
								 else if($db_month == "July"){ $jul3++; }
								 else if($db_month == "August"){ $aug3++; }
								 else if($db_month == "September"){ $sep3++; }
								 else if($db_month == "October"){ $oct3++; }
								 else if($db_month == "November"){ $nov3++; }
								 else if($db_month == "December"){ $dec3++; }
							}
								
							$tabish3 = count($u_state);
						//	echo "<script>alert($tabish);</script>";
							
							for($tab3=0; $tab3<$tabish3; $tab3++){
								
								
								$my_query = "select * from visits WHERE school_id ='$u_state[$tab3]' and is_deleted='0'" ;

								$my_result = mysqli_query($conn,$my_query);

								$final_result = mysqli_num_rows ( $my_result );
								
								if($final_result == 1){
									$s_visit1++;
									$s_visit0--;
								}
								else if($final_result == 2){
									$s_visit2++;
									$s_visit0--;
								}
								else if($final_result == 3){
									$s_visit3++;
									$s_visit0--;
								}
								else if($final_result > 3){
									$s_visit3p++;
									$s_visit0--;
								}	
							}
							
							$k3 = count($visited_schools3);
							echo "<pre>";
							print_r ($visited_schools3);
							
							 if($c_visit0 < 0){
								 $c_visit0=0;
							 }
							 if($i_visit0 < 0){
								 $i_visit0=0;
							 }
							 if($s_visit0 < 0){
								 $s_visit0=0;
							 }
							
							//counting complete
	
						
						
						
							echo "<tr>
							<td>$n</td>
							<td>$users_arr[$i]</td>
							<td>CBSE</td>
							<td>$j1</td>
							<td>$k1</td>
							<td>$sep1</td>
							<td>$oct1</td>
							<td>$nov1</td>
							<td>$dec1</td>
							<td>$jan1</td>
							<td>$feb1</td>
							<td>$mar1</td>
							<td>$apr1</td>
							<td>$may1</td>
							<td>$jun1</td>
							<td>$jul1</td>
							<td>$aug1</td>
							<td></td>
							<td>$c_visit0</td>
							<td>$c_visit1</td>
							<td>$c_visit2</td>
							<td>$c_visit3</td>
							<td>$c_visit3p</td>
							
							</tr>
							
							
							<tr>
							<td></td>
							<td></td>
							<td>ICSE </td>
							<td>$j2</td>
							<td>$k2</td>
							<td>$sep2</td>
							<td>$oct2</td>
							<td>$nov2</td>
							<td>$dec2</td>
							<td>$jan2</td>
							<td>$feb2</td>
							<td>$mar2</td>
							<td>$apr2</td>
							<td>$may2</td>
							<td>$jun2</td>
							<td>$jul2</td>
							<td>$aug2</td>
							<td></td>
							<td>$i_visit0</td>
							<td>$i_visit1</td>
							<td>$i_visit2</td>
							<td>$i_visit3</td>
							<td>$i_visit3p</td>
							</tr>
							
							
							<tr>
							<td></td>
							<td></td>
							<td>STATE </td>
							<td>$j3</td>
							<td>$k3</td>
							<td>$sep3</td>
							<td>$oct3</td>
							<td>$nov3</td>
							<td>$dec3</td>
							<td>$jan3</td>
							<td>$feb3</td>
							<td>$mar3</td>
							<td>$apr3</td>
							<td>$may3</td>
							<td>$jun3</td>
							<td>$jul3</td>
							<td>$aug3</td>
							<td></td>
							<td>$s_visit0</td>
							<td>$s_visit1</td>
							<td>$s_visit2</td>
							<td>$s_visit3</td>
							<td>$s_visit3p</td>
							</tr>";
							
							$total_jan = $total_jan + $jan1 + $jan2 + $jan3;
							$total_feb = $total_feb + $feb1 + $feb2 + $feb3;
							$total_mar = $total_mar + $mar1 + $mar2 + $mar3;
							$total_apr = $total_apr + $apr1 + $apr2 + $apr3;
							$total_may = $total_may + $may1 + $may2 + $may3;
							$total_jun = $total_jun + $jun1 + $jun2 + $jun3;
							$total_jul = $total_jul + $jul1 + $jul2 + $jul3;
							$total_aug = $total_aug + $aug1 + $aug2 + $aug3;
							$total_sep = $total_sep + $sep1 + $sep2 + $sep3;
							$total_oct = $total_oct + $oct1 + $oct2 + $oct3;
							$total_nov = $total_nov + $nov1 + $nov2 + $nov3;
							$total_dec = $total_dec + $dec1 + $dec2 + $dec3;
							$final_0_visit = $final_0_visit + $c_visit0 + $i_visit0 + $s_visit0;
							$final_1_visit = $final_1_visit + $c_visit1 + $i_visit1 + $s_visit1;
							$final_2_visit = $final_2_visit + $c_visit2 + $i_visit2 + $s_visit2;
							$final_3_visit = $final_3_visit + $c_visit3 + $i_visit3 + $s_visit3;
							$final_3p_visit = $final_3p_visit + $c_visit3p + $i_visit3p + $s_visit3p;							
							$n++;
							$i++;
							
						}
						$aru="select * from school_list where user_id ='$salesman_id' and is_deleted='0'";

						$khush = mysqli_query($conn,$aru);
						
						$total_school = mysqli_num_rows($khush);
						
						$aru1="select * from school_list where user_id ='$salesman_id' and is_deleted='0' and total_visits!='0'";

						$khush1 = mysqli_query($conn,$aru1);
						
						$total_visited = mysqli_num_rows($khush1);
						
						echo "<tr>
						<td></td>
						<td>Total</td>
						<td></td>
						<td>$total_school</td>
						<td>$total_visited</td>
						<td>$total_sep</td>
						<td>$total_oct</td>
						<td>$total_nov</td>
						<td>$total_dec</td>
						<td>$total_jan</td>
						<td>$total_feb</td>
						<td>$total_mar</td>
						<td>$total_apr</td>
						<td>$total_may</td>
						<td>$total_jun</td>
						<td>$total_jul</td>
						<td>$total_aug</td>
						<td></td>
						<td>$final_0_visit</td>
						<td>$final_1_visit</td>
						<td>$final_2_visit</td>
						<td>$final_3_visit</td>
						<td>$final_3p_visit</td>
						</tr>"
						?>
						</tbody>
					</table>
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

	});
	function fnExcelReport()
	{
		var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
		var textRange; var j=0;
		tab = document.getElementById('summary_report'); // id of table

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