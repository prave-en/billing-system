<?php
include('entry_session.php');
if(!isset($_SESSION['entry_login_session'])){
header("location: entry_login.php"); // Redirecting To Home Page
}
?>


<?php
  try{
  $con=new PDO("mysql:host=localhost;dbname=mrp",'root','');
  $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
 echo"ERROR".$e->getMessage();
}

  if (isset($_POST["addInvoice"]))
  {
    for ($a = 0; $a < count($_POST["product_name"]); $a++)
    {
      $product_name[$a] = $_POST["product_name"][$a];
      $quantity[$a] = $_POST["quantity"][$a];
         
            $conn = mysqli_connect("localhost", "root", "");
            $db = mysqli_select_db($conn, "mrp");
            $query = mysqli_query($conn, "SELECT * FROM store WHERE product_name='$product_name[$a]'");$rows = mysqli_num_rows($query);
            if($rows == 1){ //matched start

          $stmt=$con->prepare('INSERT INTO  entry(product_name,quantity)values(:product_name,:quantity)');
            $stmt->bindparam(':product_name',$product_name[$a]);
            //$stmt->bindparam(':company_name',$company_name[$a]);
            $stmt->bindparam(':quantity',$quantity[$a]);
            $stmt->execute();

            $pdoQuery = "SELECT store_quantity FROM store WHERE product_name=:product_name";
            $pdoResult = $con->prepare($pdoQuery);
            $pdoExec = $pdoResult->execute(array(":product_name"=>$product_name[$a]));
    
            if($pdoExec)
            {
             foreach($pdoResult as $row)
            {     
              $store_quantity[$a] = $row['store_quantity'];
              echo "$store_quantity[$a]";
              $store_quantity[$a] = $store_quantity[$a] + $quantity[$a];
            }//foreach
            }//if
           $pdoQuery = "DELETE  FROM store WHERE product_name=:product_name";
           $pdoResult = $con->prepare($pdoQuery);
           $pdoExec = $pdoResult->execute(array(":product_name"=>$product_name[$a]));

           $stmt = $con->prepare("INSERT INTO store (product_name,store_quantity) VALUES (:product_name,:store_quantity)");
           $stmt->bindparam(':product_name',$product_name[$a]);
           //$stmt->bindparam(':company_name',$company_name[$a]);
           $stmt->bindparam(':store_quantity',$store_quantity[$a]);
           $stmt->execute();
           }//matched end

           else{ //not matched start
           $product_name[$a]=$_POST['product_name'][$a];
           //$company_name[$a]=$_POST['company_name'][$a];
           $quantity[$a]=$_POST['quantity'][$a];

           $stmt=$con->prepare('INSERT INTO  entry(product_name,quantity)values(:product_name,:quantity)');
           $stmt->bindparam(':product_name',$product_name[$a]);
           //$stmt->bindparam(':company_name',$company_name[$a]);
           $stmt->bindparam(':quantity',$quantity[$a]);
           $stmt->execute();

           $cost_price[$a]="0";
           $selling_price[$a]="0";
           $stmt=$con->prepare('INSERT INTO  pricing_details(product_name,cost_price,selling_price)values(:product_name,:cost_price,:selling_price)');
           $stmt->bindparam(':product_name',$product_name[$a]);
           //$stmt->bindparam(':company_name',$company_name[$a]);
           $stmt->bindparam(':cost_price',$cost_price[$a]);
           $stmt->bindparam(':selling_price',$selling_price[$a]);
           $stmt->execute();

           $store_quantity[$a]=$_POST['quantity'][$a];
           $stmt=$con->prepare('INSERT INTO  store(product_name,store_quantity)values(:product_name,:store_quantity)');
           $stmt->bindparam(':product_name',$product_name[$a]);
           //$stmt->bindparam(':company_name',$company_name[$a]);
           $stmt->bindparam(':store_quantity',$store_quantity[$a]); 
           $stmt->execute(); } //not matched end
           }//for
           }//main if

         else{
        echo "not inserted";
             }

  ?>
  <script >
  alert("Data inserted");
  location= "new_entry1.php";
  </script>
  

