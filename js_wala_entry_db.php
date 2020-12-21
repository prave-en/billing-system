<?php
$connect = mysqli_connect("localhost", "root", "", "mrp");
if(isset($_POST["product_name"]))
{
 
 $product_name = $_POST["product_name"];
 $company_name = $_POST["company_name"];
 $quantity = $_POST["quantity"];
 $query = '';
 for($count = 0; $count<count($product_name); $count++)
 {
  
  $product_name_clean = mysqli_real_escape_string($connect, $product_name[$count]);
  $company_name_clean = mysqli_real_escape_string($connect, $company_name[$count]);
  $quantity_clean = mysqli_real_escape_string($connect, $quantity[$count]);
  if($product_name_clean != '' && $company_name_clean != '' && $quantity_clean != '')
  {
   $query .= ' INSERT INTO entry(product_name, company_name, quantity) VALUES("'.$product_name_clean.'", "'.$company_name_clean.'", "'.$quantity_clean.'"); ';
  }
 }
 if($query != '')
 {
  if(mysqli_multi_query($connect, $query))
  {
   echo 'Item Data Inserted';   
  }
  else
  {
   echo "not inserted";
  }
 }
 else
 {
  echo 'All Fields are Required';
 }
}
?>
