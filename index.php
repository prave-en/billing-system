<!DOCTYPE html>
<html>
<head>
  <title>home</title>
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
  .topnav a:not(:nth-child(1)) {display:none;}
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

</style>
</head>
<body>
<table align="center" border="0" width="100%" bgcolor="#696969">
  <tr><td><img src="logo.png"><div class="header"><b><h2>MRP DEPARTMENTAL STORE<br><h4>BIRENDRANAGAR,SURKHET</h4></b></div></td></tr>
    <tr><td height="20"></td></tr>
<tr><td>
<div class="topnav" id="myTopnav">
  <a href="index.php" class="active">Home</a>
  <a href="new_entry1.php">Entry</a>
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
  <div class=""><table border="0" width="100%">
  <tr>
    <td align="center"></td>
  </tr></table></div>
</td></tr>


<tr><td class="footer">copyright &copy 2019  Mid-Western University Surkhet,Nepal</td></tr>

</body>
</html>
