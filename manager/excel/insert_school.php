<?php
error_reporting(E_ALL); ini_set('display_errors', 'on');
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
                
                $s_name = "";
                if(isset($Row[2])) {
                    $s_name = mysqli_real_escape_string($conn,$Row[2]);
                }
                
				$s_code = "";
                if(isset($Row[3])) {
                    $s_code = mysqli_real_escape_string($conn,$Row[3]);
                }
				
				$s_board = "";
                if(isset($Row[4])) {
                    $s_board = mysqli_real_escape_string($conn,$Row[4]);
                }
				
				
				$s_strength = "";
                if(isset($Row[5])) {
                    $s_strength = mysqli_real_escape_string($conn,$Row[5]);
                }
				
				
				$s_email = "";
                if(isset($Row[6])) {
                    $s_email = mysqli_real_escape_string($conn,$Row[6]);
                }
				
				
				$s_contact = "";
                if(isset($Row[7])) {
                    $s_contact = mysqli_real_escape_string($conn,$Row[7]);
                }
				
				
				$s_address = "";
                if(isset($Row[8])) {
                    $s_address = mysqli_real_escape_string($conn,$Row[8]);
                }
				
				
				$s_state = "";
                if(isset($Row[9])) {
                    $s_state = mysqli_real_escape_string($conn,$Row[9]);
                }
				
				
				$s_city = "";
                if(isset($Row[10])) {
                    $s_city = mysqli_real_escape_string($conn,$Row[10]);
                }
				
				
                if (!empty($u_id) || !empty($u_name) || !empty($s_name) || !empty($s_code) || !empty($s_board) || !empty($s_strength) || !empty($s_email) || !empty($s_contact) || !empty($s_address) || !empty($s_state) || !empty($s_city)) {
                    $query = "insert into school_list(user_id,user_name,school_name,school_code,school_board,school_strength,school_email,school_contact,school_address,school_state,school_city) values('".$u_id."','".$u_name."','".$s_name."','".$s_code."','".$s_board."','".$s_strength."','".$s_email."','".$s_contact."','".$s_address."','".$s_state."','".$s_city."')";
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
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"
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
    $sqlSelect = "SELECT * FROM school_list";
    $result = mysqli_query($conn, $sqlSelect);

if (mysqli_num_rows($result) > 0)
{
?>
        
    <table class='tutorial-table'>
        <thead>
            <tr>
                <th>User Id</th>
                <th>User Name</th>
                <th>School Name</th>
                <th>School Code</th>
                <th>School Board</th>
                <th>School Strength</th>
                <th>School Email</th>
                <th>School Contact</th>
                <th>School Address</th>
                <th>School State</th>
                <th>School City</th>

            </tr>
        </thead>
<?php
    while ($row = mysqli_fetch_array($result)) {
?>                  
        <tbody>
        <tr>
            <td><?php  echo $row['user_id']; ?></td>
            <td><?php  echo $row['user_name']; ?></td>
            <td><?php  echo $row['school_name']; ?></td>
            <td><?php  echo $row['school_code']; ?></td>
            <td><?php  echo $row['school_board']; ?></td>
            <td><?php  echo $row['school_strength']; ?></td>
            <td><?php  echo $row['school_email']; ?></td>
            <td><?php  echo $row['school_contact']; ?></td>
            <td><?php  echo $row['school_address']; ?></td>
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