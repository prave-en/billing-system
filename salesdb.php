<?php
include('sales_session.php');
if(!isset($_SESSION['sales_login_session'])){
header("location: sales_login.php"); // Redirecting To Home Page
}
?>
<?php //error_reporting(0);
include('practise6.php');
 ?>


<?php
 $num=count($_POST['num']);
      for($i=0;$i<$num;$i++)
    {
$customers_name[$i]=$_POST['customers_name'][$i];
 $customers_address[$i]=$_POST['customers_address'][$i];
}
?>

<script>
    function printDiv(divName){
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
    }
  </script>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="mrp_css1.css">  
  <title>bill</title>
</head>
<style>

  .printbtn{
    background-color:#696969;
    width:200px;
    color: white;
    padding-top: 3px;
    padding-bottom: 3px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    border: 1px solid black;
    border-radius: 3px;
    font-size: 15px;
  }
  .printbtn:hover{
    background-color: #484848
  }
  .purchase{
    text-decoration: underline;
    width: 100%;
  }
  
</style>
<body>
<?php
  if(isset($_POST['cash_sales'])){
    ?>
  <div id="printMe">
    <table align="center" border="0" width="1340" bgcolor="#ffffff">
    <tr><td colspan="3"><img src="logo.png"></td><td colspan="7"><b><h2>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspMRP DEPARTMENTAL STORE<br><h4>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspBIRENDRANAGAR,SURKHET</h4></b></td><td width="300" align="center"></td></tr>
    <tr><td colspan="11" height="20"></td></tr>
  
    <tr bgcolor="#ffffff"><td colspan="11" height="30" align="center"><b class="purchase">PURCHASE BILL</b></td></tr>
    <tr><td colspan="11" height="10"></td></tr>
      <tr><td colspan="11" height="20">
        <b> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspCustomers Name:</b>&nbsp&nbsp&nbsp <?php echo "$customers_name[0]"; ?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <b>Address:</b>&nbsp&nbsp&nbsp <?php echo "$customers_address[0]";?> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b> Date:</b> &nbsp&nbsp&nbsp<?php
date_default_timezone_set('Asia/Kathmandu');
echo date('l,jS F o   g:i:s a');
?></td></tr>
<tr><td colspan="11" align="center"><table border="1" width="1200"><tr align="center"><td>PRODUCT NAME</td><td>COMPANY NAME</td><td>QUANTITY</td><td>RATE</td><td>TOTAL PRICE</td><td>REMARKS</td></tr>

        <?php

   $num=count($_POST['num']);
      for($i=0;$i<$num;$i++)
    {

 $product_name[$i]=$_POST['product_name'][$i];
 $company_name[$i]=$_POST['company_name'][$i];
 $quantity[$i]=$_POST['quantity'][$i];
 $discount_percentage[$i]=$_POST['discount_percentage'];    


 $conn = mysqli_connect("localhost", "root", "");
 
 $db = mysqli_select_db($conn, "mrp");

 $query = mysqli_query($conn, "SELECT * FROM store WHERE product_name='$product_name[$i]' AND company_name='$company_name[$i]'");
 
 $rows = mysqli_num_rows($query);

 if($rows == 1){//matched

            $pdoQuery = "SELECT store_quantity FROM store WHERE product_name=:product_name AND company_name=:company_name";
    
    
    $pdoResult = $con->prepare($pdoQuery);
    
    
    $pdoExec = $pdoResult->execute(array(":product_name"=>$product_name[$i], ":company_name"=>$company_name[$i] ));
    
     if($pdoExec)
    {
      foreach($pdoResult as $row)
            {     
              $store_quantity[$i] = $row['store_quantity'];}}
             
               if ($quantity[$i]>$store_quantity[$i]) {
               

echo "<tr align='center'>"."<td>"; echo "$product_name[$i]"."</td>"."<td>";echo "$company_name[$i]"."</td>"."<td>";
echo ""."</td>"."<td>";echo ""."</td>"."<td>";
echo ""."</td>"."<td>";echo "out of stock"."</td>"."</tr>";

 }//if
 else{
   
                $store_quantity[$i] = $store_quantity[$i] - $quantity[$i];
 
            $pdoQuery = "DELETE  FROM store WHERE product_name=:product_name AND company_name=:company_name";
    
    
    $pdoResult = $con->prepare($pdoQuery);
    
    
    $pdoExec = $pdoResult->execute(array(":product_name"=>$product_name[$i], ":company_name"=>$company_name[$i] ));

     if($pdoExec)
    {
$pdo_add = $con->prepare("INSERT INTO store (product_name,company_name,store_quantity) VALUES (:product_name,:company_name,:store_quantity)");
$pdo_add->bindparam(':product_name',$product_name[$i]);
$pdo_add->bindparam(':company_name',$company_name[$i]);
$pdo_add->bindparam(':store_quantity',$store_quantity[$i]);
$pdo_add->execute();}


$pdoQuery = "SELECT * FROM pricing_details WHERE product_name=:product_name AND company_name=:company_name";
    
    $pdoResult = $con->prepare($pdoQuery);
    
    $pdoExec = $pdoResult->execute(array(":product_name"=>$product_name[$i], ":company_name"=>$company_name[$i] ));
    
     if($pdoExec)
    {
foreach($pdoResult as $row)
            {     
                $cost_price[$i] = $row['cost_price'];
                $selling_price[$i] = $row['selling_price'];
                $total_price[$i] = $selling_price[$i] * $quantity[$i];
                $discount_ammount[$i] = $selling_price[$i]/100*$discount_percentage[0];
                $after_discount[$i] = $selling_price[$i] - $discount_ammount[$i];//new sp
                $total_price1[$i]= $quantity[$i] * $after_discount[$i];
                $unit_profit[$i] = $after_discount[$i] - $cost_price[$i];
                $total_profit[$i] = $unit_profit[$i] * $quantity[$i];
                
                 $a=array_sum($total_price); ?>
                 <?php $b=$a/100*$discount_percentage[0] ?>
                 <?php $c=$a-$b;
                
               // echo array_sum($total_profit);
              }//foreach
            }//if.

$remarks[$i] = "cash";
            $pdo_add = $con->prepare("INSERT INTO sales (bill_no,product_name,company_name,quantity,customers_name,customers_address,cost_price, selling_price,after_discount,total_price1,discount_percentage,remarks) VALUES (:bill_no,:product_name,:company_name,:quantity,:customers_name,:customers_address,:cost_price,:selling_price,:after_discount,:total_price1,:discount_percentage,:remarks)");
$pdo_add->bindparam(':bill_no',$bill_no[0]);
$pdo_add->bindparam(':product_name',$product_name[$i]);
$pdo_add->bindparam(':company_name',$company_name[$i]);
$pdo_add->bindparam(':quantity',$quantity[$i]);
$pdo_add->bindparam(':customers_name',$customers_name[$i]);
$pdo_add->bindparam(':customers_address',$customers_address[$i]);
$pdo_add->bindparam(':cost_price',$cost_price[$i]);
$pdo_add->bindparam(':selling_price',$selling_price[$i]);
$pdo_add->bindparam(':after_discount',$after_discount[$i]);
$pdo_add->bindparam(':total_price1',$total_price1[$i]);
$pdo_add->bindparam(':discount_percentage',$discount_percentage[$i]);
$pdo_add->bindparam(':remarks',$remarks[$i]);
$pdo_add->execute();

$pdo_add = $con->prepare("INSERT INTO profit_loss (product_name,company_name,quantity,unit_profit,total_profit) VALUES (:product_name,:company_name,:quantity,:unit_profit,:total_profit)");
$pdo_add->bindparam(':product_name',$product_name[$i]);
$pdo_add->bindparam(':company_name',$company_name[$i]);
$pdo_add->bindparam(':quantity',$quantity[$i]);
$pdo_add->bindparam(':unit_profit',$unit_profit[$i]);
$pdo_add->bindparam(':total_profit',$total_profit[$i]);
$pdo_add->execute();

 echo "<tr align='center'>"."<td>";
echo "$product_name[$i]"."</td>"."<td>";echo "$company_name[$i]"."</td>"."<td>";
echo "$quantity[$i]"."</td>"."<td>";echo "$selling_price[$i]"."</td>"."<td>";
echo "$total_price[$i]"."</td>"."<td>";echo ""."</td>"."</tr>";

}//else

 } //matched close

 else{//not matched

echo "<tr align='center'>"."<td>"; echo "$product_name[$i]"."</td>"."<td>";echo "$company_name[$i]"."</td>"."<td>";
echo ""."</td>"."<td>";echo ""."</td>"."<td>";
echo ""."</td>"."<td>";echo "unavailable "."</td>"."</tr>";

 }//not matched close
}//for

       $pdo_add = $con->prepare("INSERT INTO ledger (customers_name,customers_address,total_amount,remarks) VALUES (:customers_name,:customers_address,:total_amount,:remarks)");
$pdo_add->bindparam(':customers_name',$customers_name[0]);
$pdo_add->bindparam(':customers_address',$customers_address[0]);
$pdo_add->bindparam(':total_amount',$c);
$pdo_add->bindparam(':remarks',$remarks[0]);
$pdo_add->execute();    

echo "<tr align='center'>"."<td colspan='4'>".""."</td>"."<td>";echo "<b>"."$a";echo"</td>"."<td>"."</td>";


 echo "<tr align='center'>"."<td colspan='4'>"."<b>"."Discount Percentage(Discount Amount)"."</td>"."<td>"."<b>"."$discount_percentage[0]"."%"."( $b)"."</td>"."<td>"."</td>"."</td>"."</tr>";


echo "<tr align='center'>"."<td colspan='4'>"."<b>"."Grand Total"."</td>"."<td>";echo "<b>"."$c";echo"</td>"."<td>"."Cash"."</td>"."</tr>";


?>
</table></td></tr></table></div>
<table border="0" align="center" width="1340">
<tr><td height="20"></td></tr>
<tr><td align="right">
<button onclick="printDiv('printMe')" class="printbtn">Print</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td></tr></table>

<?php
}//main if
?>









<?php
  if(isset($_POST['credit_sales'])){
    ?>
  <div id="printMe">
    <table align="center" border="0" width="1340" bgcolor="#ffffff">
    <tr><td colspan="3"><img src="logo.png"></td><td colspan="7"><b><h2>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspMRP DEPARTMENTAL STORE<br><h4>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspBIRENDRANAGAR,SURKHET</h4></b></td><td width="300" align="center"></td></tr>
    <tr><td colspan="11" height="20"></td></tr>
  
    <tr bgcolor="#ffffff"><td colspan="11" height="30" align="center"><b class="purchase">PURCHASE BILL </b></td></tr>
    <tr><td colspan="11" height="10"></td></tr>
      <tr><td colspan="11" height="20">
        <b> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspCustomers Name:</b>&nbsp&nbsp&nbsp <?php echo "$customers_name[0]"; ?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <b>Address:</b>&nbsp&nbsp&nbsp <?php echo "$customers_address[0]";?> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b> Date:</b> &nbsp&nbsp&nbsp<?php
date_default_timezone_set('Asia/Kathmandu');
echo date('l,jS F o   g:i:s a');
?></td></tr>
<tr><td colspan="11" align="center"><table border="1" width="1200"><tr align="center"><td>PRODUCT NAME</td><td>COMPANY NAME</td><td>QUANTITY</td><td>RATE</td><td>TOTAL PRICE</td><td>REMARKS</td></tr>

        <?php

 

   $num=count($_POST['num']);
      for($i=0;$i<$num;$i++)
    {

 $product_name[$i]=$_POST['product_name'][$i];
 $company_name[$i]=$_POST['company_name'][$i];
 $quantity[$i]=$_POST['quantity'][$i];
 $discount_percentage[$i]=$_POST['discount_percentage'];    


 $conn = mysqli_connect("localhost", "root", "");
 
 $db = mysqli_select_db($conn, "mrp");

 $query = mysqli_query($conn, "SELECT * FROM store WHERE product_name='$product_name[$i]' AND company_name='$company_name[$i]'");
 
 $rows = mysqli_num_rows($query);

 if($rows == 1){//matched




            $pdoQuery = "SELECT store_quantity FROM store WHERE product_name=:product_name AND company_name=:company_name";
    
    
    $pdoResult = $con->prepare($pdoQuery);
    
    
    $pdoExec = $pdoResult->execute(array(":product_name"=>$product_name[$i], ":company_name"=>$company_name[$i] ));
    
     if($pdoExec)
    {
      foreach($pdoResult as $row)
            {     
              $store_quantity[$i] = $row['store_quantity'];}}
             
               if ($quantity[$i]>$store_quantity[$i]) {
               

echo "<tr align='center'>"."<td>"; echo "$product_name[$i]"."</td>"."<td>";echo "$company_name[$i]"."</td>"."<td>";
echo ""."</td>"."<td>";echo ""."</td>"."<td>";
echo ""."</td>"."<td>";echo "out of stock"."</td>"."</tr>";

 }//if
 else{
   
                $store_quantity[$i] = $store_quantity[$i] - $quantity[$i];
 
            $pdoQuery = "DELETE  FROM store WHERE product_name=:product_name AND company_name=:company_name";
    
    
    $pdoResult = $con->prepare($pdoQuery);
    
    
    $pdoExec = $pdoResult->execute(array(":product_name"=>$product_name[$i], ":company_name"=>$company_name[$i] ));

     if($pdoExec)
    {
$pdo_add = $con->prepare("INSERT INTO store (product_name,company_name,store_quantity) VALUES (:product_name,:company_name,:store_quantity)");
$pdo_add->bindparam(':product_name',$product_name[$i]);
$pdo_add->bindparam(':company_name',$company_name[$i]);
$pdo_add->bindparam(':store_quantity',$store_quantity[$i]);
$pdo_add->execute();}


$pdoQuery = "SELECT * FROM pricing_details WHERE product_name=:product_name AND company_name=:company_name";
    
    $pdoResult = $con->prepare($pdoQuery);
    
    $pdoExec = $pdoResult->execute(array(":product_name"=>$product_name[$i], ":company_name"=>$company_name[$i] ));
    
     if($pdoExec)
    {
foreach($pdoResult as $row)
            {     
                $cost_price[$i] = $row['cost_price'];
                $selling_price[$i] = $row['selling_price'];
                $total_price[$i] = $selling_price[$i] * $quantity[$i];
                $discount_ammount[$i] = $selling_price[$i]/100*$discount_percentage[0];
                $after_discount[$i] = $selling_price[$i] - $discount_ammount[$i];//new sp
                $unit_profit[$i] = $after_discount[$i] - $cost_price[$i];
                $total_price1[$i]= $quantity[$i] * $after_discount[$i];
                //$unit_profit[$i] = $selling_price[$i] - $cost_price[$i];
                $total_profit[$i] = $unit_profit[$i] * $quantity[$i];
                
                
               // echo array_sum($total_profit);
              }//foreach
            }//if.

$servername="localhost";
$username="root";
$password="";
$dbname="mrp";
$con=mysqli_connect($servername,$username,$password,$dbname);
$sql = "SELECT * FROM sales order by bill_no desc LIMIT 1";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
     $bill_no[$i] = $row["bill_no"];
     //echo "$quantity"."<br>";
    }}

$sql="SELECT count(sales_id) AS total FROM sales";
$result=mysqli_query($con,$sql);
$values=mysqli_fetch_assoc($result);
$num_row=$values['total'];
//echo($num_row) ."<br>";

try{
  $con=new PDO("mysql:host=localhost;dbname=mrp",'root','');
  $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
 echo"ERROR".$e->getMessage();
}

if ($num_row==0) {
$bill_no[$i]="1";
}
   
else{
$bill_no[$i]=$bill_no[$i]+1;
}

$remarks[$i] = "credit";
            $pdo_add = $con->prepare("INSERT INTO sales (bill_no,product_name,company_name,quantity,customers_name,customers_address,cost_price, selling_price,after_discount,total_price1,discount_percentage,remarks) VALUES (:bill_no,:product_name,:company_name,:quantity,:customers_name,:customers_address,:cost_price,:selling_price,:after_discount,:total_price1,:discount_percentage,:remarks)");
$pdo_add->bindparam(':bill_no',$bill_no[0]);
$pdo_add->bindparam(':product_name',$product_name[$i]);
$pdo_add->bindparam(':company_name',$company_name[$i]);
$pdo_add->bindparam(':quantity',$quantity[$i]);
$pdo_add->bindparam(':customers_name',$customers_name[$i]);
$pdo_add->bindparam(':customers_address',$customers_address[$i]);
$pdo_add->bindparam(':cost_price',$cost_price[$i]);
$pdo_add->bindparam(':selling_price',$selling_price[$i]);
$pdo_add->bindparam(':after_discount',$after_discount[$i]);
$pdo_add->bindparam(':total_price1',$total_price1[$i]);
$pdo_add->bindparam(':discount_percentage',$discount_percentage[$i]);
$pdo_add->bindparam(':remarks',$remarks[$i]);
$pdo_add->execute();

$pdo_add = $con->prepare("INSERT INTO profit_loss (product_name,company_name,quantity,unit_profit,total_profit) VALUES (:product_name,:company_name,:quantity,:unit_profit,:total_profit)");
$pdo_add->bindparam(':product_name',$product_name[$i]);
$pdo_add->bindparam(':company_name',$company_name[$i]);
$pdo_add->bindparam(':quantity',$quantity[$i]);
$pdo_add->bindparam(':unit_profit',$unit_profit[$i]);
$pdo_add->bindparam(':total_profit',$total_profit[$i]);
$pdo_add->execute();

 echo "<tr align='center'>"."<td>";
echo "$product_name[$i]"."</td>"."<td>";echo "$company_name[$i]"."</td>"."<td>";
echo "$quantity[$i]"."</td>"."<td>";echo "$selling_price[$i]"."</td>"."<td>";
echo "$total_price[$i]"."</td>"."<td>";echo ""."</td>"."</tr>";

}//else

 } //matched close

 else{//not matched

echo "<tr align='center'>"."<td>"; echo "$product_name[$i]"."</td>"."<td>";echo "$company_name[$i]"."</td>"."<td>";
echo ""."</td>"."<td>";echo ""."</td>"."<td>";
echo ""."</td>"."<td>";echo "unavailable "."</td>"."</tr>";

 }//not matched close
}//for

            $a=array_sum($total_price); ?>
            <?php $b=$a/100*$discount_percentage[0] ?>
            <?php $c=$a-$b;

            $pdo_add = $con->prepare("INSERT INTO ledger (customers_name,customers_address,total_amount,remarks) VALUES (:customers_name,:customers_address,:total_amount,:remarks)");
$pdo_add->bindparam(':customers_name',$customers_name[0]);
$pdo_add->bindparam(':customers_address',$customers_address[0]);
$pdo_add->bindparam(':total_amount',$c);
$pdo_add->bindparam(':remarks',$remarks[0]);
$pdo_add->execute();  

echo "<tr align='center'>"."<td colspan='4'>".""."</td>"."<td>";echo "<b>"."$a";echo"</td>"."<td>"."</td>";


 echo "<tr align='center'>"."<td colspan='4'>"."<b>"."Discount Percentage(Discount Amount)"."</td>"."<td>"."<b>"."$discount_percentage[0]"."%"."( $b)"."</td>"."<td>"."</td>"."</td>"."</tr>";


echo "<tr align='center'>"."<td colspan='4'>"."<b>"."Grand Total"."</td>"."<td>";echo "<b>"."$c";echo"</td>"."<td>"."Credit"."</td>"."</tr>";



   $num=count($_POST['num']);
      for($i=0;$i<$num;$i++)
    {

 $customers_name=$_POST['customers_name'][$i];
 $customers_address=$_POST['customers_address'][$i];
}
 
 $conn = mysqli_connect("localhost", "root", "");
 
 $db = mysqli_select_db($conn, "mrp");

 $query = mysqli_query($conn, "SELECT * FROM credit_sales WHERE customers_name='$customers_name' AND customers_address='$customers_address'");
 
 $rows = mysqli_num_rows($query);

 if($rows == 1){//matched
  
  $pdoQuery = "SELECT credit_amount FROM credit_sales WHERE customers_name=:customers_name AND customers_address=:customers_address";
    
    
    $pdoResult = $con->prepare($pdoQuery);
    
    
    $pdoExec = $pdoResult->execute(array(":customers_name"=>$customers_name, ":customers_address"=>$customers_address ));
    
     if($pdoExec)
    {
      foreach($pdoResult as $row)
            {     
              $credit_amount = $row['credit_amount'];
              //echo "$total_amount"."<br>";
             //echo "$c"."<br>";
              $grand_total_amount = $credit_amount + $c;
              //echo "$grand_total_amount"."<br>";

              $pdoQuery = "DELETE  FROM credit_sales WHERE customers_name=:customers_name AND customers_address=:customers_address";
    
    
    $pdoResult = $con->prepare($pdoQuery);
    
    
    $pdoExec = $pdoResult->execute(array(":customers_name"=>$customers_name,":customers_address"=>$customers_address ));

     if($pdoExec)
    {
           $pdo_add = $con->prepare("INSERT INTO credit_sales (customers_name,customers_address,credit_amount) VALUES (:customers_name,:customers_address,:credit_amount)");
$pdo_add->bindparam(':customers_name',$customers_name);
$pdo_add->bindparam(':customers_address',$customers_address);
$pdo_add->bindparam(':credit_amount',$grand_total_amount);
$pdo_add->execute();  
             
            }}}
}//match end
else
{//not matched start
 $pdo_add = $con->prepare("INSERT INTO credit_sales (customers_name,customers_address,total_amount) VALUES (:customers_name,:customers_address,:total_amount)");
$pdo_add->bindparam(':customers_name',$customers_name);
$pdo_add->bindparam(':customers_address',$customers_address);
$pdo_add->bindparam(':total_amount',$c);
$pdo_add->execute();
}//not matched end


?>
</table></td></tr></table></div>
<table border="0" align="center" width="1340">
<tr><td height="20"></td></tr>
<tr><td align="right">
<button onclick="printDiv('printMe')" class="printbtn">Print</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td></tr></table>

<?php }//main if
?>