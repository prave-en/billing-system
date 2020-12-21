<?php
include('practise6.php');
$customers_name=$_POST['customers_name'];
$customers_address=$_POST['customers_address'];
$ammount_received=$_POST['ammount_received'];

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
             
              $credit_amount = $credit_amount - $ammount_received;
          
               $pdoQuery = "DELETE  FROM credit_sales WHERE customers_name=:customers_name AND customers_address=:customers_address";
               $pdoResult = $con->prepare($pdoQuery);
               $pdoExec = $pdoResult->execute(array(":customers_name"=>$customers_name, ":customers_address"=>$customers_address ));

     if($pdoExec)
    {
     
$pdo_add = $con->prepare("INSERT INTO credit_sales (customers_name,customers_address,credit_amount) VALUES (:customers_name,:customers_address,:credit_amount)");
$pdo_add->bindparam(':customers_name',$customers_name);
$pdo_add->bindparam(':customers_address',$customers_address);
$pdo_add->bindparam(':credit_amount',$credit_amount);
$pdo_add->execute();

$remarks = "cash received";
$pdo_add = $con->prepare("INSERT INTO ledger (customers_name,customers_address,total_amount,remarks) VALUES (:customers_name,:customers_address,:total_amount,:remarks)");
$pdo_add->bindparam(':customers_name',$customers_name);
$pdo_add->bindparam(':customers_address',$customers_address);
$pdo_add->bindparam(':total_amount',$ammount_received);
$pdo_add->bindparam(':remarks',$remarks);
if($pdo_add->execute()){
  ?>
  <script >
    alert("Done");
  location= "creditors.php";
  </script>
  <?php
} //pdo add
         } //delete pdo exec
       }// foreach
   }//if
 }//matched end
   else{
     ?>
  <script >
    alert("customers name and customers address did not match");
  location= "creditors.php";
  </script>
  <?php
} //not matched end

if ($credit_amount == 0) {
  $pdoQuery = "DELETE  FROM credit_sales WHERE customers_name=:customers_name AND customers_address=:customers_address";
               $pdoResult = $con->prepare($pdoQuery);
               $pdoExec = $pdoResult->execute(array(":customers_name"=>$customers_name, ":customers_address"=>$customers_address ));
}
?> 