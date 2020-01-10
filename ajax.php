 
 <?php
 $link=mysqli_connect("localhost","root","");
 mysqli_select_db($link,"tblcitylist");
 $state=$_GET["state"];
 
 if($state!="")
 {
    $res=mysqli_query($link,"select * from statelist where state ='$state'");
    echo "<select>";
    while($row=mysqli_fetch_array($res))
    {
	 
     echo "<option>"; echo $row["city_name"];	echo "</option>"; 
     }	 
     echo "</select>";
 
 }
 ?> 