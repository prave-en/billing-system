<!doctype html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   

    <title>sales record</title>
  </head>
  <style type="text/css">

    body{
  margin: 0;
}
.overflow{
  width: 100%;
  height: 100%;
  overflow:auto;
}
.topnav {
  overflow: hidden;
  background-color:#484848;
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
  .topnav a:not(:nth-child(5)) {display:none;}
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
@media screen and (max-width: 830px){
  table tr {
    font-size: 12px;
  }
}

.header{
    display: inline-block;
    text-align: center;
    margin-left: 13%;
  }
  .container{
    height: 350px;
    width: 830px;
  }
  .footer{
    background-color: #484848;
    width: 100%;
    height: 42px;
    text-align: center;
    font-size: 15px;
  }
  
  
    #myTable_filter{
      display: none;
    }
    #myInputTextField{
      border-radius: 3px;
      border:1px solid black;
      width: 30%;
      color: black;
      padding-left: 20px;
      padding-top: 5px;
      padding-bottom: 5px;
      outline: none;
     
    }
   tr tr th{
    position: sticky;
    top: 0;
    background-color: #484848;
    height: 25px;
    
   }

   tr tr:hover{
    background-color: #484848;
    color: black;
   }
  
  </style>
  <body>
    <table align="center" border="0" width="100%" bgcolor="#696969">
      <tr><td><img src="logo.png"><div class="header"><b><h2>MRP DEPARTMENTAL STORE<br><h4>BIRENDRANAGAR,SURKHET</h4></b></div></td></tr>
    <tr><td height="20"></td></tr>
<tr><td>
<div class="topnav" id="myTopnav">
  <a href="index.php">Home</a>
  <a href="new_entry1.php">Entry</a>
  <a href="sales1.php">Sales</a>
  <a href="entry_record.php">Entry Record</a>
  <a href="sales_record.php" class="active">Sales Record</a>
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
<tr><td height="3"></td></tr>
  <tr><td align="center"><input type="text"  name="product_name"  id="myInputTextField" placeholder="Search....." autocomplete="off"></td></tr>
  <tr><td height="3"></td></tr>
     <tr><td align="center" class="container">
    <div class="overflow">
     <table border="1" id="myTable" bgcolor="#696969" width="100%">
  <thead>
    <tr align="center">
      <th>Bl_no.</th>
      <th>Id</th>
      <th>Sales Date</th>
      <th>Customers Name</th>
      <th>Address</th>
      <th>Product Discription</th>
      <th>Quantity</th>
      <th>Unti Price</th>
      <th>Discount %</th>
      <th>After Dis.</th>
      <th>Total Price</th>
      <th>Remarks</th>
      
    </tr>
  </thead>
    <?php
  $servername="localhost";
  $username="root";
$password="";
$dbname="mrp";
$con=mysqli_connect($servername,$username,$password,$dbname);

$sql = "SELECT * FROM sales  ORDER BY sales_id DESC";
$result = mysqli_query($con, $sql);


if (mysqli_num_rows($result) > 0) {
  
    while($row = mysqli_fetch_assoc($result)) {
      
        echo "<tr align='center'>";
        echo "<td width=''>". $row["bill_no"]. "</td>";
        echo "<td width=''>". $row["sales_id"]. "</td>";
        echo "<td width=''>". $row["sales_date"]. "</td>";
        echo "<td width=''>". $row["customers_name"]. "</td>";
        echo "<td width=''>". $row["customers_address"]. "</td>";
        echo "<td width=''>". $row["product_name"]. "</td>";
        echo "<td width=''>". $row["quantity"]. "</td>";
        echo "<td width=''>". $row["selling_price"]. "</td>";
        echo "<td width=''>". $row["discount_percentage"]. "</td>";
        echo "<td width=''>". $row["after_discount"]. "</td>";
        echo "<td width=''>". $row["total_price1"]."</td>";
        echo "<td width=''>". $row["remarks"]."</td>"."</tr>";


        
    }
}
mysqli_close($con);
?>
 
</tbody></table><div></td></tr>
  <tr><td class="footer">copyright &copy 2019  Mid-Western University Surkhet,Nepal</td></tr>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
      $(document).ready( function () {
    $('#myTable').DataTable();
} );//main
    </script>

    <script type="text/javascript">
       $('#myTable').DataTable({
        paging: false
         //order: [[ 3, "desc" ]]
});//total data
    </script>

<script type="text/javascript">
oTable = $('#myTable').DataTable(); 
$('#myInputTextField').keyup(function(){
      oTable.search($(this).val()).draw() ;
})
</script>

<script type="text/javascript">
  var table = $('#myTable').DataTable();
 
// Sort by column 1 and then re-draw
table
    .order( [ 0, 'desc' ] )
    .draw();
</script>


  </body>
</html>

       