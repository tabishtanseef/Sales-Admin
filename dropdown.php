  
 <?php
 $link=mysqli_connect("localhost","root","");
 mysqli_select_db($link,"tblcitylist");
 
 ?> 
 
  <form name="form1" action="" method="post">  <table>
  <tr>
  <td>Select State</td>
  <td><select id="statedd" onchange="change_state()">
  <option>Select</option>
  
  
  <?php
  $res=mysqli_query($link,"select * from states");
  while($row=mysqli_fetch_array($res))
  {  
  ?>
  <option><?php  echo $row ["state_name"]; ?></option>
  <?php
  
  }
  
  ?>
  </select> 
  </td>
  </tr>
  
  <tr>
  <td>Select City</td>
  <td>
  <div id="city">
  <select>
  <option>Select</option>
  </select>
  </div>
  
  </td>
  </tr>
  
  </table>
  
  </form>
  
  
  
  <script>
  function change_state()
  {
	  var xmlhttp=new XMLHttpRequest();
	  xmlhttp.open("GET","ajax.php?state="+document.getElementById("statedd").value,false);
	  xmlhttp.send(null);
	  document.getElementById("city").innerHTML=xmlhttp.responseText;
	  
	  
	  
  }
  
    </script>
  
  