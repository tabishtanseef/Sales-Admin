<?php

include_once("db_connect.php");
require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');

if (isset($_POST["import"]))
{
    
    
  $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  
  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'uploads/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);
        
        $sheetCount = count($Reader->sheets());
        for($i=0;$i<$sheetCount;$i++)
			
		
		
        {
            
			
            $Reader->ChangeSheet($i);
            
            foreach ($Reader as $Row)
            {
				$u_id = "";
                if(isset($Row[0])) {
                    $u_id = mysqli_real_escape_string($conn,$Row[0]);
                }
          
                $u_name = "";
                if(isset($Row[1])) {
                    $u_name = mysqli_real_escape_string($conn,$Row[1]);
                }
                
                $p_name = "";
                if(isset($Row[2])) {
                    $p_name = mysqli_real_escape_string($conn,$Row[2]);
                }
                
				$p_email = "";
				
                if(isset($Row[3])) {
                    $p_email = mysqli_real_escape_string($conn,$Row[3]);
                }
				
				$p_num = "";
                if(isset($Row[4])) {
                    $p_num = mysqli_real_escape_string($conn,$Row[4]);
                }
				
				
				$designation = "";
                if(isset($Row[5])) {
                    $designation = mysqli_real_escape_string($conn,$Row[5]);
                }
				
				
				$s_state = "";
                if(isset($Row[6])) {
                    $s_state = mysqli_real_escape_string($conn,$Row[6]);
                }
				
				
				$s_city = "";
                if(isset($Row[7])) {
                    $s_city = mysqli_real_escape_string($conn,$Row[7]);
                }
				
				
				$s_id = "";
                if(isset($Row[8])) {
                    $s_id = mysqli_real_escape_string($conn,$Row[8]);
                }
                
				$s_name = "";
                if(isset($Row[9])) {
                    $s_name = mysqli_real_escape_string($conn,$Row[9]);
                }
				
				
				
                if (!empty($u_id) || !empty($u_name) || !empty($p_name) || !empty($p_email) || !empty($p_num) || !empty($designation) || !empty($s_state) || !empty($s_city) || !empty($s_name)) {
                    $query = "insert into contact_person_list(user_id,user_name,p_name,p_email,p_num,designation,school_state,school_city,school_id,school_name) values('".$u_id."','".$u_name."','".$p_name."','".$p_email."','".$p_num."','".$designation."','".$s_state."','".$s_city."','".$s_id."','".$s_name."')";
                    $result = mysqli_query($conn, $query);
                
                    if (! empty($result)) {
                        $type = "success";
                        $message = "Excel Data Imported into the Database";
                    } else {
                        $type = "error";
                        $message = "Problem in Importing Excel Data";
                    }
                }
             }
        
		
         }
  }
  else
  { 
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
  }
}
?>

<!DOCTYPE html>
<html>    
<head>
<style>    
body {
	font-family: Arial;
	width: 550px;
}

.outer-container {
	background: #F0F0F0;
	border: #e0dfdf 1px solid;
	padding: 40px 20px;
	border-radius: 2px;
}

.btn-submit {
	background: #333;
	border: #1d1d1d 1px solid;
    border-radius: 2px;
	color: #f0f0f0;
	cursor: pointer;
    padding: 5px 20px;
    font-size:0.9em;
}

.tutorial-table {
    margin-top: 40px;
    font-size: 0.8em;
	border-collapse: collapse;
	width: 100%;
}

.tutorial-table th {
    background: #f0f0f0;
    border-bottom: 1px solid #dddddd;
	padding: 8px;
	text-align: left;
}

.tutorial-table td {
    background: #FFF;
	border-bottom: 1px solid #dddddd;
	padding: 8px;
	text-align: left;
}

#response {
    padding: 10px;
    margin-top: 10px;
    border-radius: 2px;
    display:none;
}

.success {
    background: #c7efd9;
    border: #bbe2cd 1px solid;
}

.error {
    background: #fbcfcf;
    border: #f3c6c7 1px solid;
}

div#response.display-block {
    display: block;
}
</style>
</head>

<body>
    <h2>Import Excel File into MySQL Database using PHP</h2>
    
    <div class="outer-container">
        <form action="" method="post"
            name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
            <div>
                <label>Choose Excel
                    File</label> <input type="file" name="file"
                    id="file" accept=".xls,.xlsx">
                <button type="submit" id="submit" name="import"
                    class="btn-submit">Import</button>
        
            </div>
        
        </form>
        
    </div>
    <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
    
         
<?php
    $sqlSelect = "SELECT * FROM contact_person_list";
    $result = mysqli_query($conn, $sqlSelect);

if (mysqli_num_rows($result) > 0)
{
?>
        
    <table class='tutorial-table'>
        <thead>
            <tr>
                <th>Id</th>
                <th>User Id</th>
                <th>User Name</th>
                <th>Person Name</th>
                <th>Person Email</th>
                <th>Person Num</th>
                <th>Designation</th>
				<th>School Id</th>
				<th>School Name</th>
                <th>School State</th>
                <th>School City</th>
               
            </tr>
        </thead>
<?php
    while ($row = mysqli_fetch_array($result)) {
?>                  
        <tbody>
        <tr>
            <td><?php  echo $row['id']; ?></td>
            <td><?php  echo $row['user_id']; ?></td>
            <td><?php  echo $row['user_name']; ?></td>
            <td><?php  echo $row['p_name']; ?></td>
            <td><?php  echo $row['p_email']; ?></td>
            <td><?php  echo $row['p_num']; ?></td>
            <td><?php  echo $row['designation']; ?></td>
			<td><?php  echo $row['school_id']; ?></td>
			<td><?php  echo $row['school_name']; ?></td>
            <td><?php  echo $row['school_state']; ?></td>
            <td><?php  echo $row['school_city']; ?></td>
            
        </tr>
<?php
    }
?>
        </tbody>
    </table>
<?php 
} 
?>

</body>
</html>