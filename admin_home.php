<?php
include('admin_session.php');
if(!isset($_SESSION['admin_login_session'])){
header("location: admin.php"); // Redirecting To Home Page
}
$a = $_SESSION['start_time'];
$b = time() - $a;
if(isset($_SESSION['admin_login_session'])){
  if ($b > 3000) {
   unset($_SESSION["admin_login_session"]);
  }}
?>
<!DOCTYPE html>
<html>
<head>
  <title>admin home</title>
<link rel="stylesheet" type="text/css" href="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
  body{
  margin: 0;
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
  .topnav a:not(:nth-child(7)) {display:none;}
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
    height: 386px;
    width: 100%;
    background-color: #696969;
  }
  .footer{
    background-color: #484848;
    width: 100%;
    height: 42px;
    text-align: center;
    font-size: 15px;
  }

  .pricing_update{
      background-color: #696969;
      border: 1px solid black;
      border-radius: 3px;
      display: inline-block;
      width: 50%;
      text-align: center;
      padding-top: 5px;
      padding-bottom: 5px;
      color: white;
      font-size: 15px;
      text-decoration: none;
      margin-top: 5px;
      margin-bottom: 5px; 

    }
    .pricing_update:hover{
      background-color: #494848;
    }
    .pricing_update1{
      background-color: #696969;
      border: 1px solid black;
      border-radius: 3px;
      display: inline-block;
      width: 45%;
      text-align: center;
      padding-top: 5px;
      padding-bottom: 5px;
      color: white;
      font-size: 15px;
      text-decoration: none;
      margin-top: 5px;
      margin-bottom: 5px; 

    }
    .pricing_update1:hover{
      background-color: #494848;
    }
    input[type=text]{
      border-radius: 3px;
      border:1px solid black;
      height: 25px;
      width: 50%;
      text-align: center;
      margin-bottom: 5px;
      margin-top: 5px;
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

    .modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  padding:5px 15px 5px 15px;
  background-color: red;
}

.close:hover,
.close:focus {
  border:1px solid red;
  background-color: white;
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

</style>
</head>
<body>
<table align="center" border="0 " width="100%" bgcolor="#696969">
  <tr><td><img src="logo.png"><div class="header"><b><h2>MRP DEPARTMENTAL STORE<br><h4>BIRENDRANAGAR,SURKHET</h4></b></div></td></tr>
    <tr><td height="20"></td></tr>
<tr><td>
<div class="topnav" id="myTopnav">
  <a href="index.php">Home</a>
  <a href="new_entry1.php">Entry</a>
  <a href="sales1.php">Sales</a>
  <a href="entry_record.php">Entry Record</a>
  <a href="sales_record.php">Sales Record</a>
  <a href="store.php">Store</a>
  <a href="admin_home.php" class="active">Admin</a>
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
 
      <a href="account_management.php" class="pricing_update">ACCOUNT MANAGEMENT</a><br>
      <a href="pricing_update.php" class="pricing_update">PRICING UPDATE</a><br>
      <a href="profit_loss.php" class="pricing_update">PROFIT AND LOSS</a><br>
      <a href="creditors.php" class="pricing_update">CREDITORS</a><br>
      <button id="myBtn" class="pricing_update">LEDGER</button><br>
      <form action="regenerate_bill.php" method="post">
      <input type="text" name="bill_no" placeholder="bill no." style="width: 5%">&nbsp<input type="submit" name="regenerate_bill" value="REGENERATE BILL" class="pricing_update1"></form><br><br>
      <?php 
      $c = 30- $b;
      echo "session will be expire in ";
      echo "$c "." seconds"."<br>";
      ?>
      </td>
       </tr>

    <div class="logout"><a href="admin_logout.php" id="logout" title="Admin Logout" class="logout_button" align="center"><i class="fa fa-sign-out" style="font-size:25px;color:black" ></i></a></div>
<tr><td class="footer">copyright &copy 2019  Mid-Western University Surkhet,Nepal</td></tr>

<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <p><form action="ledger.php" method="post" autocomplete="off">
        <input type="text" name="customers_name" placeholder="Customers Name" id="dropdown1" list="select1" required=""><br><br>
        <input type="text" name="customers_address" placeholder="Customers Address" id="dropdown2" list="select2" required=""><br><br>
        <input type="submit" class="pricing_update" name="ledger" value="Submit">

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
      </form></p>
  </div></div>

<script>
var modal = document.getElementById("myModal");
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function() {
  modal.style.display = "block";
}
span.onclick = function() {
  modal.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }}
</script>
</body>
</html>
