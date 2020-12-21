
<!DOCTYPE html>
<html>
<head>
  <title>entry</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
 body{
  margin: 0;
}
.overflow{
  overflow: auto;
  width: 100%;
  height: 100%;
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
  .topnav a:not(:nth-child(2)) {display:none;}
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
    height: 343px;
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

    input[type=text],input[type=number]{
    width: 80%;
    height: 20px;
    border: 1px solid black;
    border-radius: 5px;
    text-align: center;
    outline: none;
    margin:1px;
  }
   input[type=text]:focus,input[type=number]:focus{
   background-color: #cccccc;
  }

   .entry{
    background-color:#696969;
    width:50%;
    color: white;
    padding-top: 3px;
    padding-bottom: 3px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    border: 1px solid black;
    border-radius: 5px;
    font-size: 15px;
    outline: none;
   }
   .entry:hover{
    background-color: #484848;
   }
   tr tr th{
    position: sticky;
    top: 0;
    background-color: #484848;
    height: 25px;
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
  <a href="new_entry1.php" class="active">Entry</a>
  <a href="sales1.php">Sales</a>
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
  <div class="overflow"><table border="1" width="100%">
    <form action="new_entrydb.php" method="post">
  <tr align="center"><th>Product Name</th><th>Company Name</th><th>Quantity</th><th>Discription</th></tr>

      <?php
      $numbers=$_POST['num'];
      for($i=1;$i<=$numbers;$i++)
      {
    ?>
      <tr align="center">
        <td><input type="hidden" value="<?php echo $i;?>" name="num[]" />
          <input list="select1" type="text" name="product_name[]" required="">
        <datalist id="select1">
              <?php
$pdo = new PDO('mysql:host=localhost;dbname=mrp', 'root', '');
 $sql = "SELECT product_name FROM store";
 $stmt = $pdo->prepare($sql);
 $stmt->execute();
 $users = $stmt->fetchAll();?>
 <select id="dropdown" >
<?php foreach($users as $user): ?>
<option value="<?= $user['product_name']; ?>"><?= $user['product_name']; ?></option>
<?php endforeach; ?>
</datalist>
</td>
        <td><input list="select2" type="text" name="company_name[]" required="">
          <datalist id="select2">
              <?php
$pdo = new PDO('mysql:host=localhost;dbname=mrp', 'root', '');
 $sql = "SELECT company_name FROM store";
 $stmt = $pdo->prepare($sql);
 $stmt->execute();
 $users = $stmt->fetchAll();?>
 <select style="width:550px;" id="dropdown" >
<?php foreach($users as $user): ?>
<option value="<?= $user['company_name']; ?>"><?= $user['company_name']; ?></option>
<?php endforeach; ?>
</datalist>
</td>
        <td><input type="number" name="quantity[]" required=""></td>
        <td><input type="text" name="discription[]"></td></tr>
      <?php } ?>
    </table></div>
</td></tr>

<tr><td align="center"><input type="submit" name="new_entry" value="Entry" class="entry"></td></tr></form>
<tr><td height="10"></td></tr>
<tr><td class="footer">copyright &copy 2019  Mid-Western University Surkhet,Nepal</td></tr>

</body>
</html>
