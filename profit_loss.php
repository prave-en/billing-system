<?php
include('admin_session.php');
if(!isset($_SESSION['admin_login_session'])){
header("location: admin.php"); // Redirecting To Home Page
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>profit and loss</title>
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
  	width: 70%;
  	padding-top: 3px;
  	padding-bottom: 3px;
  	background-color: #696969;
  }
  .back:hover{
  	background-color: #484848;
  }
</style>
<body>

	<table border="0" width="100%" bgcolor="#696969">
            <tr><td height="50" colspan="2"><img src="logo.png"></td></tr>
            <tr><td height="30" colspan="2" bgcolor="#484848" align="center"><b>PROFIT AND LOSS<b></td></tr>
                <tr><td height="20"></td></tr>
                <tr><td class="container" colspan="2">
                	<div class="overflow">
                	<table border="1" width="100%">
                		<tr><th>Date</th><th>Product Name</th><th>Quantity</th><th>Unit Profit</th><th>Total Profit</th></tr>

                			<?php
  $servername="localhost";
  $username="root";
$password="";
$dbname="mrp";
$con=mysqli_connect($servername,$username,$password,$dbname);

$sql = "SELECT * FROM profit_loss";
$result = mysqli_query($con, $sql);
$sum = 0;
if (mysqli_num_rows($result) > 0) {
  
    while($row = mysqli_fetch_assoc($result)) {
      
        echo "<tr align='center'>";
        echo "<td width=''>". $row["pl_date"]. "</td>";
        echo "<td width=''>". $row["product_name"]. "</td>";
        //echo "<td width=''>". $row["company_name"]. "</td>";
        echo "<td width=''>". $row["quantity"]. "</td>";
        echo "<td width=''>". $row["unit_profit"]. "</td>";
        echo "<td width=''>". $row["total_profit"]. "</td>"."</tr>";
        $sum += $row['total_profit'];
        
    }
}
mysqli_close($con);
?>

                	</table></div>
                </td></tr>
                <tr><td height="30" align="center"><b>Total Profit</b></td>

                	<td>
                		<b><?php echo $sum; ?></b>
                	</td></tr>
                	<tr><td colspan="2" align="center" height="30">
                		 <button onclick="goBack()" class="back" >Back</button>
      <script>
function goBack() {
 location= "admin_home.php";
}
</script>
                	</td></tr>

</body>
</html>
