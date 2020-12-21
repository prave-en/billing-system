<?php
include('admin_session.php');
if(!isset($_SESSION['admin_login_session'])){
header("location: admin.php"); // Redirecting To Home Page
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>creditors</title>
</head>
<style type="text/css">
	body{
		margin:0;
	}
	.overflow{
  width: 100%;
  height: 100%;
  overflow:auto;
}
.container{
    height: 400px;
    width: 830px;
  }
  tr th{
  	position: sticky;
  	top: 0;
  	background-color: #484848;
  }
  tr tr:hover{
  	background-color: #484848;
  }
  .back{
  	border-radius: 3px;
  	border:1px solid black;
  	display: inline-block;
  	width: 30%;
  	padding-top: 3px;
  	padding-bottom: 3px;
  	background-color: #696969;
    text-decoration: none;
    text-align: center;
    color: black;
  }
  .back:hover{
  	background-color: #484848;
  }
</style>
<body>

	<table border="0" width="100%" bgcolor="#696969">
            <tr><td height="50" colspan="2"><img src="logo.png"></td></tr>
            <tr><td height="30" colspan="2" bgcolor="#484848" align="center"><b>CREDITORS<b></td></tr>
                <tr><td height="20" colspan="2"></td></tr>
                <tr><td class="container" colspan="2">
                	<div class="overflow">
                	<table border="1" width="100%">
                		<tr><th>Customers Name</th><th>Customers Address</th><th>Credit Amount</th></tr>

                			<?php
  $servername="localhost";
  $username="root";
$password="";
$dbname="mrp";
$con=mysqli_connect($servername,$username,$password,$dbname);

$sql = "SELECT * FROM credit_sales";
$result = mysqli_query($con, $sql);
$sum = 0;
if (mysqli_num_rows($result) > 0) {
  
    while($row = mysqli_fetch_assoc($result)) {
      
        echo "<tr align='center'>";
        echo "<td width=''>". $row["customers_name"]. "</td>";
        echo "<td width=''>". $row["customers_address"]. "</td>";
        echo "<td width=''>". $row["credit_amount"]. "</td>"."</tr>";
        $sum += $row['credit_amount'];
        
    }
}
mysqli_close($con);
?>

                	</table></div>
                </td></tr>
                <tr><td height="30" align="right" colspan="2"><b>Total Credit = </b>

                		<b><?php echo $sum; ?></b>&nbsp&nbsp&nbsp
                	</td></tr>
                	<tr><td colspan="2" align="center" height="30">
                		 <a href="admin_home.php" class="back">Back</a>&nbsp&nbsp&nbsp
            <a href="ammout_received.php" class="back"> cash received</a></td></tr>

</body>
</html>
