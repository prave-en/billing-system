<?php
include('sales_session.php');
if(!isset($_SESSION['sales_login_session'])){
header("location: sales_login.php"); // Redirecting To Home Page
}
?>
<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <title>sales</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
   body{
  margin: 0;
}
.overflow{
  width: 100%;
  height: 100%;
  overflow:auto;
}
tr th{
    position: sticky;
    top: 0;
    background-color: #484848;
    height: 25px;
   }
.topnav {
  overflow: hidden;
  background-color: #494848;
  width: 100%;
}
.topnav a {
  float: left;
  display: block;
  color: white;
  text-align: center;
  padding-left: 30px;
  padding-right: 30px;
  padding-top: 10px;
  padding-bottom: 10px;
  text-decoration: none;
  font-size: 15px;
  border:0px solid black;
  border-radius: 0px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #ddd;
  color: black;
}

.topnav .icon {
  display: none;
  color: black;
}
 @media screen and (max-width: 830px) {
  .topnav a:not(:nth-child(3)) {display:none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}
@media screen and (max-width: 830px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
}

.header{
    display: inline-block;
    text-align: center;
    margin-left: 13%;
  }
  .container{
    height: 350px;
    width: 100%;
    background-color: #696969;
  }
  .footer{
    background-color: #494848;
    width: 100%;
    height: 42px;
    text-align: center;
    font-size: 15px;
  }

   .sale{
    background-color:#696969;
    width:15%;
    color: white;
    padding-top: 3px;
    padding-bottom: 5px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    border: 1px solid black;
    border-radius: 5px;
    font-size: 15px;
   }
   .sale:hover{
    background-color: #484848;
   }

   input[type=text],input[type=number]{
    width: 70%;
    height: 20px;
    border: 1px solid black;
    border-radius: 5px;
    text-align: center;
    outline: none;
  }
   input[type=text]:focus,input[type=number]:focus{
   background-color: #cccccc;
  }

  .logout{
     position: absolute;
     top: 10%;
     right: 5%;
    }
    .logout_button{
      border:2px solid red;
      border-radius: 50px;
      display: inline-block;
      padding-top: 5px;
      padding-left: 7px;
      padding-right: 5px;
      padding-bottom: 5px;
      background-color: white;

    }

</style>
</head>
<body>
<table align="center" border="0" width="100%" bgcolor="#696969">
  <tr><td><img src="logo.png"><div class="header"><b><h2>MRP DEPARTMENTAL STORE<br><h4>BIRENDRANAGAR,SURKHET</h4></b></div></td></tr>
    <tr><td height="20"></td></tr>
<tr><td>
<div class="topnav" id="myTopnav">
  <a href="index.php">Home</a>
  <a href="new_entry1.php">Entry</a>
  <a href="sales1.php" class="active">Sales</a>
  <a href="entry_record.php">Entry Record</a>
  <a href="sales_record.php">Sales Record</a>
  <a href="store.php">Store</a>
  <a href="admin_home.php">Admin</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div></td></tr>

<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>


<tr><td height="5"></td></tr>
<tr><td class="container" align="center">
<div class="overflow">

  <form method="POST" action="salesdb1.php" autocomplete="off">
  <table class="table table-bordered" id="crud_table" border="1" width="100%">
    <tr><td colspan="5"><input list="select1" type="text" name="customers_name[]" placeholder="Customers Name" style="width: 20%">&nbsp<input list="select2" type="text" name="customers_address[]" placeholder="Customers Address" style="width: 20%"></td></tr>
    <tr>
      <th>S no.</th>
      <th>Product Discription</th>
      <th>Quantity</th>
      <th width="80px">Remove</th>
      </tr>
    
      <tr align="center"><td>1</td>
      <td><input list="select3" type="text" name="product_name[]" required></td>
      <td><input type="number" name="quantity[]" style="width: 150px" required></td>
      <td></td>
      </tr>
    </table>
    <br><p align="right"><button type="button" name="add" id="add" class="sale" style="width: 55px">+</button>&nbsp&nbsp&nbsp&nbsp</p>

    </td></tr>
   
<tr><td colspan="4" align="right">
  <input type="number" name="discount_percentage[]" placeholder="Discount %" style="width: 10%">&nbsp
  <input type="submit" name="cash_sales" value="Cash Sale" class="sale">&nbsp
  <input type="submit" name="credit_sales" value="Credit Sale" class="sale">&nbsp&nbsp
</td></tr></form>


<script>
$(document).ready(function(){
 var count = 1;
 $('#add').click(function(){
  count = count + 1;
  var html_code = "<tr id='row"+count+"' align='center'>";
   html_code += "<td>" +count+ "</td>"
   html_code += "<td><input list='select3' type='text' name='product_name[]' required></td>";
   html_code += "<td><input type='text' name='quantity[]'  style='width: 150px' required></td>";
   html_code += "<td align='center'><button name='remove' data-row='row"+count+"' class='sale remove'  style='width: 70%'>-</button></td>";   
   html_code += "</tr>";  
   $('#crud_table').append(html_code);
 });
 
 $(document).on('click', '.remove', function(){
  var delete_row = $(this).data("row");
  $('#' + delete_row).remove();
 });
});
</script>


 <div class="logout"><a href="sales_logout.php" id="logout" title="Salesman Logout" class="logout_button" align="center"><i class="fa fa-sign-out" style="font-size:25px;color:black" ></i></a></div>

<tr><td class="footer">copyright &copy 2019  Mid-Western University Surkhet,Nepal</td></tr>

 <datalist id="select1">
 <?php
 $pdo = new PDO('mysql:host=localhost;dbname=mrp', 'root', '');
 $sql = "SELECT customers_name FROM credit_sales";
 $stmt = $pdo->prepare($sql);
 $stmt->execute();
 $users = $stmt->fetchAll();?>
 <?php foreach($users as $user): ?>
 <option value="<?= $user['customers_name']; ?>"><?= $user['customers_name']; ?></option>
 <?php endforeach; ?>
 </datalist>

 <datalist id="select2">
 <?php
 $pdo = new PDO('mysql:host=localhost;dbname=mrp', 'root', '');
 $sql = "SELECT customers_address FROM credit_sales";
 $stmt = $pdo->prepare($sql);
 $stmt->execute();
 $users = $stmt->fetchAll();?>
 <?php foreach($users as $user): ?>
 <option value="<?= $user['customers_address']; ?>"><?= $user['customers_address']; ?></option>
 <?php endforeach; ?>
 </datalist>

 <datalist id="select3">
 <?php
 $pdo = new PDO('mysql:host=localhost;dbname=mrp', 'root', '');
 $sql = "SELECT product_name FROM store";
 $stmt = $pdo->prepare($sql);
 $stmt->execute();
 $users = $stmt->fetchAll();?>
 <?php foreach($users as $user): ?>
 <option value="<?= $user['product_name']; ?>"><?= $user['product_name']; ?></option>
 <?php endforeach; ?>
 </datalist>

</body>
</html>
