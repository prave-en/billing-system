<?php

//multiple_update.php

//database_connection.php

$connect = new PDO("mysql:host=localhost;dbname=mrp", "root", "");

if(isset($_POST['hidden_id']))
{
 $product_name = $_POST['product_name'];
 $cost_price = $_POST['cost_price'];
 $selling_price = $_POST['selling_price'];
 $id = $_POST['hidden_id'];
 for($count = 0; $count < count($id); $count++)
 {
  $data = array(
   ':product_name'   => $product_name[$count],
   ':cost_price' => $cost_price[$count],
   ':selling_price'   => $selling_price[$count],
   ':id'   => $id[$count]
  );
  $query = "
  UPDATE pricing_details 
  SET product_name = :product_name,cost_price = :cost_price, selling_price = :selling_price 
  WHERE id = :id
  ";
  $statement = $connect->prepare($query);
  $statement->execute($data);
 }
}

?>