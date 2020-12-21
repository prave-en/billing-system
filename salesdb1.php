<?php
 error_reporting(0);
 for ($a = 0; $a < count($_POST["product_name"]); $a++){
 $customers_name[$a] = $_POST["customers_name"][0];
 $customers_address[$a] = $_POST["customers_address"][0];}

$servername="localhost";
$username="root";
$password="";
$dbname="mrp";
$con=mysqli_connect($servername,$username,$password,$dbname);
$sql = "SELECT * FROM sales order by bill_no desc LIMIT 1";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
     $bill_no = $row["bill_no"];
     //echo "$bill_no"."<br>";
    }}

$sql="SELECT count(sales_id) AS total FROM sales";
$result=mysqli_query($con,$sql);
$values=mysqli_fetch_assoc($result);
$num_row=$values['total'];
//echo($num_row) ."<br>";

if ($num_row==0) {
$bill_no="1";
}
   
else{
$bill_no=$bill_no+1;
} ?>

<!DOCTYPE html>
<html>
<head>
  <title>Bill</title>
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


<div id="printMe">
    <table align="center" border="0" width="1340" bgcolor="#ffffff">
    <tr><td colspan="3"><img src="logo.png"></td><td colspan="7"><b><h2>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspMRP DEPARTMENTAL STORE<br><h4>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspBIRENDRANAGAR,SURKHET</h4></b></td><td width="300" align="center"></td></tr>
    <tr><td colspan="11" height="20"></td></tr>
  
    <tr bgcolor="#ffffff"><td colspan="11" height="30" align="center"><b class="purchase">PURCHASE BILL No. <?php echo "$bill_no"; ?></b></td></tr>
    <tr><td colspan="11" height="10"></td></tr>
      <tr><td colspan="11" height="20">
        <b> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspCustomers Name:</b>&nbsp&nbsp&nbsp <?php echo "$customers_name[0]"; ?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <b>Address:</b>&nbsp&nbsp&nbsp <?php echo "$customers_address[0]";?> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b> Date:</b> &nbsp&nbsp&nbsp<?php
date_default_timezone_set('Asia/Kathmandu');
echo date('l,jS F o   g:i a');
?></td></tr>
<tr><td colspan="11" align="center"><table border="1" width="1200"><tr align="center"><td>PRODUCT DISCRIPTION</td><td>QUANTITY</td><td>RATE</td><td>TOTAL PRICE</td><td>REMARKS</td></tr>

</body>
</html>



  <?php
  include("practise6.php");
  if (isset($_POST["cash_sales"]))
  {
    for ($a = 0; $a < count($_POST["product_name"]); $a++)
    {
      $customers_name[$a] = $_POST["customers_name"][0];
      $customers_address[$a] = $_POST["customers_address"][0];
      $product_name[$a] = $_POST["product_name"][$a];
      $quantity[$a] = $_POST["quantity"][$a];
      $discount_percentage[$a] = $_POST["discount_percentage"][0];
     
    
            $conn = mysqli_connect("localhost", "root", "");
            $db = mysqli_select_db($conn, "mrp");
            $query = mysqli_query($conn, "SELECT * FROM store WHERE product_name='$product_name[$a]'");$rows = mysqli_num_rows($query);
            if($rows == 1){ //matched start

            $pdoQuery = "SELECT store_quantity FROM store WHERE product_name=:product_name";
            $pdoResult = $con->prepare($pdoQuery);
            $pdoExec = $pdoResult->execute(array(":product_name"=>$product_name[$a]));
            if($pdoExec)
               {
                  foreach($pdoResult as $row)
               {     
              $store_quantity[$a] = $row['store_quantity'];
               }}

           if ($store_quantity[$a] < $quantity[$a])
{           
echo "<tr align='center'>"."<td>"; echo "$product_name[$a]"."</td>"."<td>";
echo ""."</td>"."<td>";echo ""."</td>"."<td>";
echo ""."</td>"."<td>";echo "out of stock"."</td>"."</tr>";
}
            else{
              $store_quantity[$a] = $store_quantity[$a] - $quantity[$a];
              
              $pdoQuery = "DELETE  FROM store WHERE product_name=:product_name";
              $pdoResult = $con->prepare($pdoQuery);
              $pdoExec = $pdoResult->execute(array(":product_name"=>$product_name[$a],));
              if($pdoExec)
               {
$pdo_add = $con->prepare("INSERT INTO store (product_name,store_quantity) VALUES (:product_name,:store_quantity)");
$pdo_add->bindparam(':product_name',$product_name[$a]);
$pdo_add->bindparam(':store_quantity',$store_quantity[$a]);
$pdo_add->execute();}

            $pdoQuery = "SELECT * FROM pricing_details WHERE product_name=:product_name";
            $pdoResult = $con->prepare($pdoQuery);
            $pdoExec = $pdoResult->execute(array(":product_name"=>$product_name[$a]));
            if($pdoExec)
            {
            foreach($pdoResult as $row)
            {
              $cost_price[$a] = $row['cost_price'];
              $selling_price[$a] = $row['selling_price'];
              $total_price[$a] = $selling_price[$a] * $quantity[$a];
              $discount_amount[$a] = $selling_price[$a]/100*$discount_percentage[0];
              $after_discount[$a] = $selling_price[$a] - $discount_amount[$a];//new sp
              $total_price1[$a] = $quantity[$a] * $after_discount[$a];
              $TA = array_sum($total_price);
              $DA = $TA/100*$discount_percentage[0];
              $grand_total = $TA - $DA;
              $unit_profit[$a] = $after_discount[$a] - $cost_price[$a];
              $total_profit[$a] = $unit_profit[$a] * $quantity[$a];
              
             }}

$remarks[$a] = "cash";
$pdo_add = $con->prepare("INSERT INTO sales (bill_no,product_name,quantity,customers_name,customers_address,cost_price, selling_price,after_discount,total_price,total_price1,discount_percentage,remarks) VALUES (:bill_no,:product_name,:quantity,:customers_name,:customers_address,:cost_price,:selling_price,:after_discount,:total_price,:total_price1,:discount_percentage,:remarks)");
$pdo_add->bindparam(':bill_no',$bill_no);
$pdo_add->bindparam(':product_name',$product_name[$a]);
$pdo_add->bindparam(':quantity',$quantity[$a]);
$pdo_add->bindparam(':customers_name',$customers_name[$a]);
$pdo_add->bindparam(':customers_address',$customers_address[$a]);
$pdo_add->bindparam(':cost_price',$cost_price[$a]);
$pdo_add->bindparam(':selling_price',$selling_price[$a]);
$pdo_add->bindparam(':after_discount',$after_discount[$a]);
$pdo_add->bindparam(':total_price',$total_price[$a]);
$pdo_add->bindparam(':total_price1',$total_price1[$a]);
$pdo_add->bindparam(':discount_percentage',$discount_percentage[$a]);
$pdo_add->bindparam(':remarks',$remarks[$a]);
$pdo_add->execute();

$pdo_add = $con->prepare("INSERT INTO profit_loss (product_name,quantity,unit_profit,total_profit) VALUES (:product_name,:quantity,:unit_profit,:total_profit)");
$pdo_add->bindparam(':product_name',$product_name[$a]);
$pdo_add->bindparam(':quantity',$quantity[$a]);
$pdo_add->bindparam(':unit_profit',$unit_profit[$a]);
$pdo_add->bindparam(':total_profit',$total_profit[$a]);
$pdo_add->execute();

echo "<tr align='center'>"."<td>";
echo "$product_name[$a]"."</td>"."<td>";
echo "$quantity[$a]"."</td>"."<td>";echo "$selling_price[$a]"."</td>"."<td>";
echo "$total_price[$a]"."</td>"."<td>";echo ""."</td>"."</tr>";

}//else quantity wala
           
        }// matched end
        else{ //not matched start
echo "<tr align='center'>"."<td>"; echo "$product_name[$a]"."</td>"."<td>";
echo ""."</td>"."<td>";echo ""."</td>"."<td>";
echo ""."</td>"."<td>";echo "unavailable "."</td>"."</tr>";
        }//not matched end
      } //for

  $pdo_add = $con->prepare("INSERT INTO ledger (bill_no,customers_name,customers_address,total_amount,remarks) VALUES (:bill_no,:customers_name,:customers_address,:total_amount,:remarks)");
$pdo_add->bindparam(':bill_no',$bill_no);
$pdo_add->bindparam(':customers_name',$customers_name[0]);
$pdo_add->bindparam(':customers_address',$customers_address[0]);
$pdo_add->bindparam(':total_amount',$grand_total);
$pdo_add->bindparam(':remarks',$remarks[0]);
$pdo_add->execute();

echo "<tr align='center'>"."<td colspan='3'>"."</td>"."<td>";echo "<b>"."$TA";echo"</td>"."<td>"."</td>";

echo "<tr align='center'>"."<td colspan='3'>"."<b>"."Discount Percentage(Discount Amount)"."</td>"."<td>"."<b>"."$discount_percentage[0]"."%"."( $DA)"."</td>"."<td>"."</td>"."</td>"."</tr>";

echo "<tr align='center'>"."<td colspan='3'>"."<b>"."Grand Total"."</td>"."<td>";echo "<b>"."$grand_total";echo"</td>"."<td>"."Cash"."</td>"."</tr>";
}//main if

?>


<?php
  include("practise6.php");
  if (isset($_POST["credit_sales"]))
  {
    for ($a = 0; $a < count($_POST["product_name"]); $a++)
    {
      $customers_name[$a] = $_POST["customers_name"][0];
      $customers_address[$a] = $_POST["customers_address"][0];
      $product_name[$a] = $_POST["product_name"][$a];
      $quantity[$a] = $_POST["quantity"][$a];
      $discount_percentage[$a] = $_POST["discount_percentage"][0];
     
    
            $conn = mysqli_connect("localhost", "root", "");
            $db = mysqli_select_db($conn, "mrp");
            $query = mysqli_query($conn, "SELECT * FROM store WHERE product_name='$product_name[$a]'");$rows = mysqli_num_rows($query);
            if($rows == 1){ //matched start

            $pdoQuery = "SELECT store_quantity FROM store WHERE product_name=:product_name";
            $pdoResult = $con->prepare($pdoQuery);
            $pdoExec = $pdoResult->execute(array(":product_name"=>$product_name[$a]));
            if($pdoExec)
               {
                  foreach($pdoResult as $row)
               {     
              $store_quantity[$a] = $row['store_quantity'];
               }}

           if ($store_quantity[$a] < $quantity[$a])
{           
echo "<tr align='center'>"."<td>"; echo "$product_name[$a]"."</td>"."<td>";
echo ""."</td>"."<td>";echo ""."</td>"."<td>";
echo ""."</td>"."<td>";echo "out of stock"."</td>"."</tr>";
}
            else{
              $store_quantity[$a] = $store_quantity[$a] - $quantity[$a];
              
              $pdoQuery = "DELETE  FROM store WHERE product_name=:product_name";
              $pdoResult = $con->prepare($pdoQuery);
              $pdoExec = $pdoResult->execute(array(":product_name"=>$product_name[$a]));
              if($pdoExec)
               {
$pdo_add = $con->prepare("INSERT INTO store (product_name,store_quantity) VALUES (:product_name,:store_quantity)");
$pdo_add->bindparam(':product_name',$product_name[$a]);
$pdo_add->bindparam(':store_quantity',$store_quantity[$a]);
$pdo_add->execute();}

            $pdoQuery = "SELECT * FROM pricing_details WHERE product_name=:product_name";
            $pdoResult = $con->prepare($pdoQuery);
            $pdoExec = $pdoResult->execute(array(":product_name"=>$product_name[$a]));
            if($pdoExec)
            {
            foreach($pdoResult as $row)
            {
              $cost_price[$a] = $row['cost_price'];
              $selling_price[$a] = $row['selling_price'];
              $total_price[$a] = $selling_price[$a] * $quantity[$a];
              $discount_amount[$a] = $selling_price[$a]/100*$discount_percentage[0];
              $after_discount[$a] = $selling_price[$a] - $discount_amount[$a];//new sp
              $total_price1[$a] = $quantity[$a] * $after_discount[$a];
              $TA = array_sum($total_price);
              $DA = $TA/100*$discount_percentage[0];
              $grand_total = $TA - $DA;
              $unit_profit[$a] = $after_discount[$a] - $cost_price[$a];
              $total_profit[$a] = $unit_profit[$a] * $quantity[$a];
              
             }}
$remarks[$a] = "credit";
$pdo_add = $con->prepare("INSERT INTO sales (bill_no,product_name,quantity,customers_name,customers_address,cost_price, selling_price,after_discount,total_price,total_price1,discount_percentage,remarks) VALUES (:bill_no,:product_name,:quantity,:customers_name,:customers_address,:cost_price,:selling_price,:after_discount,:total_price,:total_price1,:discount_percentage,:remarks)");
$pdo_add->bindparam(':bill_no',$bill_no);
$pdo_add->bindparam(':product_name',$product_name[$a]);
$pdo_add->bindparam(':quantity',$quantity[$a]);
$pdo_add->bindparam(':customers_name',$customers_name[$a]);
$pdo_add->bindparam(':customers_address',$customers_address[$a]);
$pdo_add->bindparam(':cost_price',$cost_price[$a]);
$pdo_add->bindparam(':selling_price',$selling_price[$a]);
$pdo_add->bindparam(':after_discount',$after_discount[$a]);
$pdo_add->bindparam(':total_price',$total_price[$a]);
$pdo_add->bindparam(':total_price1',$total_price1[$a]);
$pdo_add->bindparam(':discount_percentage',$discount_percentage[$a]);
$pdo_add->bindparam(':remarks',$remarks[$a]);
$pdo_add->execute();

$pdo_add = $con->prepare("INSERT INTO profit_loss (product_name,quantity,unit_profit,total_profit) VALUES (:product_name,:quantity,:unit_profit,:total_profit)");
$pdo_add->bindparam(':product_name',$product_name[$a]);
$pdo_add->bindparam(':quantity',$quantity[$a]);
$pdo_add->bindparam(':unit_profit',$unit_profit[$a]);
$pdo_add->bindparam(':total_profit',$total_profit[$a]);
$pdo_add->execute();

echo "<tr align='center'>"."<td>";
echo "$product_name[$a]"."</td>"."<td>";
echo "$quantity[$a]"."</td>"."<td>";echo "$selling_price[$a]"."</td>"."<td>";
echo "$total_price[$a]"."</td>"."<td>";echo ""."</td>"."</tr>";

}//else quantity wala
           
        }// matched end
        else{ //not matched start
echo "<tr align='center'>"."<td>"; echo "$product_name[$a]"."</td>"."<td>";
echo ""."</td>"."<td>";echo ""."</td>"."<td>";
echo ""."</td>"."<td>";echo "unavailable "."</td>"."</tr>";
        }//not matched end
      } //for

echo "<tr align='center'>"."<td colspan='3'>"."</td>"."<td>";echo "<b>"."$TA";echo"</td>"."<td>"."</td>";

echo "<tr align='center'>"."<td colspan='3'>"."<b>"."Discount Percentage(Discount Amount)"."</td>"."<td>"."<b>"."$discount_percentage[0]"."%"."( $DA)"."</td>"."<td>"."</td>"."</td>"."</tr>";

echo "<tr align='center'>"."<td colspan='3'>"."<b>"."Grand Total"."</td>"."<td>";echo "<b>"."$grand_total";echo"</td>"."<td>"."credit"."</td>"."</tr>";


$pdo_add = $con->prepare("INSERT INTO ledger (bill_no,customers_name,customers_address,total_amount,remarks) VALUES (:bill_no,:customers_name,:customers_address,:total_amount,:remarks)");
$pdo_add->bindparam(':bill_no',$bill_no);
$pdo_add->bindparam(':customers_name',$customers_name[0]);
$pdo_add->bindparam(':customers_address',$customers_address[0]);
$pdo_add->bindparam(':total_amount',$grand_total);
$pdo_add->bindparam(':remarks',$remarks[0]);
$pdo_add->execute();

$customers_name = $customers_name[0];
$customers_address = $customers_address[0];
$query = mysqli_query($conn, "SELECT * FROM credit_sales WHERE customers_name='$customers_name' AND customers_address='$customers_address'");
 $rows = mysqli_num_rows($query);
 if($rows == 1){
  
$pdoQuery = "SELECT credit_amount FROM credit_sales WHERE customers_name=:customers_name AND customers_address=:customers_address";
$pdoResult = $con->prepare($pdoQuery);
$pdoExec = $pdoResult->execute(array(":customers_name"=>$customers_name, ":customers_address"=>$customers_address ));
if($pdoExec)
    {
foreach($pdoResult as $row)
            {     
              $credit_amount = $row['credit_amount'];
              echo "$credit_amount";
              echo "$grand_total";
              $credit_amount1 = $credit_amount + $grand_total;
              echo "$credit_amount1";
              $pdoQuery = "DELETE  FROM credit_sales WHERE customers_name=:customers_name AND customers_address=:customers_address";
              $pdoResult = $con->prepare($pdoQuery);
              $pdoExec = $pdoResult->execute(array(":customers_name"=>$customers_name,":customers_address"=>$customers_address ));
              if($pdoExec)
    {
$pdo_add = $con->prepare("INSERT INTO credit_sales (customers_name,customers_address,credit_amount) VALUES (:customers_name,:customers_address,:credit_amount)");
$pdo_add->bindparam(':customers_name',$customers_name);
$pdo_add->bindparam(':customers_address',$customers_address);
$pdo_add->bindparam(':credit_amount',$credit_amount1);
$pdo_add->execute();  
             
            }}}
}//match end
else
{//not matched start
 $pdo_add = $con->prepare("INSERT INTO credit_sales (customers_name,customers_address,credit_amount) VALUES (:customers_name,:customers_address,:credit_amount)");
$pdo_add->bindparam(':customers_name',$customers_name);
$pdo_add->bindparam(':customers_address',$customers_address);
$pdo_add->bindparam(':credit_amount',$grand_total);
$pdo_add->execute();
}//not matched end
}//main if
?>

</table></td></tr></table></div>
<table border="0" align="center" width="1340">
<tr><td height="20"></td></tr>
<tr><td align="right">
<button onclick="printDiv('printMe')" class="printbtn">Print</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td></tr></table>

<script>
    function printDiv(divName){
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
    }
  </script>