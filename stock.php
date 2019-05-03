<?php
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['manager_id'];
$user=$_SESSION['username'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."index.php");
exit();
}
if(isset($_POST['submit'])){
$sname=$_POST['sr_no'];
$cat=$_POST['Mfd_date'];
$des=$_POST['Exp_date'];
$com=$_POST['Refill_date'];
$sup=$_POST['Floor'];
$qua=$_POST['Block'];



$sql=mysql_query("INSERT INTO stock(Block	,Mfd_date,	Exp_date,	Refill_date,	floor,	sr_no)
VALUES('$qua','$cat','$des','$com','$sup','$sname')");
if($sql>0) {header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/stock.php");
}else{
$message1="<font color=red>Registration Failed, Try again</font>";
}
	}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $user;?> -EXTINGUISHER DETAILS</title>
<link rel="stylesheet" type="text/css" href="style/mystyle.css">
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" /> 
<link rel="stylesheet" href="style/table.css" type="text/css" media="screen" /> 
<script src="js/function.js" type="text/javascript"></script>
<style>#left-column {height: 477px;}
 #main {height: 477px;}</style>
</head>
<body>
<div id="content">
<div id="header">
<h1><a href="#"><img src="images/fe.jpg"></a> EXTINGUISHER DETAILS</h1></div>
<div id="left_column">
<div id="button">
<ul>
			<li><a href="manager.php">Dashboard</a></li>
			
			<li><a href="stock.php">Manage Stock</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>	
</div>
		</div>
<div id="main">
<div id="tabbed_box" class="tabbed_box">  
    <h4>Manage Stock</h4> 
<hr/>	
    <div class="tabbed_area">  
      
        <ul class="tabs">  
            <li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1"  
            <li><a href="javascript:tabSwitch('tab_2', 'content_2');" id="tab_2">Add Extinguishers</a></li>  
             
        </ul>  
          
        <div id="content_1" class="content">  
		 <?php echo $message;
			  echo $message1;
			  ?>
      
		<?php
		/* 
		View
        Displays all data from 'Stock' table
		*/

        // connect to the database
        include_once('connect_db.php');

        // get results from database
		
        $result = mysql_query("SELECT * FROM stock") 
                or die(mysql_error());
		// display data in table
        echo "<table border='1' cellpadding='3'>";
         echo "<tr><th>ID</th><th>sr_no</th><th>Mfd date</th><th>Exp date</th><th>Refill date</th><th>floor </th><th>block</th></tr>";

        // loop through results of database query, displaying them in the table
        while($row = mysql_fetch_array( $result )) {
                
                // echo out the contents of each row into a table
                echo "<tr>";
                echo '<td>' . $row[0] . '</td>';
            echo '<td>' . $row[6] . '</td>';  
                echo '<td>' . $row[2] . '</td>';
				echo '<td>' . $row[3] . '</td>';
				echo '<td>' . $row[4] . '</td>';
				echo '<td>' . $row[5] . '</td>';
				echo '<td>' . $row[1] . '</td>';?>
				<td><a href="delete_stock.php?stock_id=<?php echo $row[0]?>"><img src="images/delete-icon.jpg" width="24" height="24" border="0" /></a></td>
				<?php
		 } 
        // close table>
        echo "</table>";
?> 
        </div>  
        <div id="content_2" class="content">  
         <!--Add Drug-->
		 <?php echo $message;
			  echo $message1;
			  ?>
			<form name="myform" onsubmit="return validateForm(this);" action="stock.php" method="post" >
			<table width="420" height="106" border="0" >	
				<tr><td align="center"><input name="sr_no" type="text" style="width:170px" placeholder="serial no" required="required" id="drug_name" /></td></tr>
				<tr><td align="center"><input name="Mfd_date" type="text" style="width:170px" placeholder="mfd date" required="required" id="category"/></td></tr>
				<tr><td align="center"><input name="Exp_date" type="text" style="width:170px" placeholder="exp date" required="required" id="description" /></td></tr>
				<tr><td align="center"><input name="Refill_date" type="text" style="width:170px" placeholder="refill date"  required="required" id="company" /></td></tr>  
				<tr><td align="center"><input name="Floor" type="text" style="width:170px" placeholder="floor" required="required" id="supplier" /></td></tr>  
				<tr><td align="center"><input name="Block" type="text" style="width:170px" placeholder="block" required="required" id="quantity" /></td></tr>  
				
				<tr><td align="center"><input name="submit" type="submit" value="Submit" id="submit"/></td></tr>
            </table>
		</form>
        </div>  
              
    </div>  
  
</div>
 
</div>
<div id="footer" align="Center"> BACKEND IMPLEMENTATION</div>
</div>
</body>
</html>
