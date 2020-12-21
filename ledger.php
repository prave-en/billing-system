<?php error_reporting(0); ?>

<?php
include('admin_session.php');
if(!isset($_SESSION['admin_login_session'])){
header("location: admin.php"); // Redirecting To Home Page
}
?>

<!DOCTYPE html>
<html>
<head>
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="mrp_css1.css">  
  <title>ledger</title>
</head>
<style>
    body{
        margin: 0;
    }
   
    tr tr:hover {
      background-color: #494848;
    }
    tr tr th{
      position: sticky;
      top: 0;
      background-color: #494848;
    }
    .button3
     {
      background-color: #696969;
      border: 1px solid black;
      border-radius: 3px;
      display: inline-block;
      width: 30%;
      text-align: center;
      padding-top: 5px;
      padding-bottom: 5px;
      color: white;
      font-size: 15px;
      text-decoration: none;
      margin-top: 5px;
      margin-bottom: 5px; 

    }
    .button3:hover{
      background-color: #494848;
  }

</style>

<script>
    function printDiv(divName){
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
    }
  </script>

<?php
        
if(isset($_POST['ledger']))
{
        
    try {
        $pdoConnect = new PDO("mysql:host=localhost;dbname=mrp","root","");
    } catch (PDOException $exc) {
        echo $exc->getMessage();
        exit();
    }
    
   
    $customers_name = $_POST['customers_name'];
    $customers_address = $_POST['customers_address'];
     $pdoQuery = "SELECT * FROM credit_sales WHERE customers_name='$customers_name' AND customers_address='$customers_address'" ;
    
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    
    
    $pdoExec = $pdoResult->execute(array(":customers_name"=>$customers_name, ":customers_address"=>$customers_address ));
    
    if($pdoExec)
    {

          if($pdoResult->rowCount()>0)
        {

            foreach($pdoResult as $row)
            {        
              $credit_amount = $row['credit_amount'];                
                     }}}}?>

<?php
        
if(isset($_POST['ledger']))
{
        
    try {
        $pdoConnect = new PDO("mysql:host=localhost;dbname=mrp","root","");
    } catch (PDOException $exc) {
        echo $exc->getMessage();
        exit();
    }
    
   
    $customers_name = $_POST['customers_name'];
    $customers_address = $_POST['customers_address']; ?>
    

<body>
    <div id="printMe">
<table align="center" border="0" width="100%" bgcolor="#696969">
  <tr><td width="450"><img src="logo.png"></td><td><b><h2>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspMRP DEPARTMENTAL STORE<br><h4>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspBIRENDRANAGAR,SURKHET</h4></b></td></tr>
    <tr><td align="center" colspan="2" height="20"></td></tr>
    <tr><td align="center" colspan="2" height="30" bgcolor="#494848"><b>Ledger</b></td></tr>
    <tr><td colspan="2" height="20"><?php echo "<b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspCustomers Name:</b>&nbsp"; echo "$customers_name"."&nbsp&nbsp&nbsp"; echo "<b>Address:</b>&nbsp"; echo "$customers_address"; ?></td></tr>

    <tr><td colspan="2" align="center"><table align="center" border="1" width="100%">
      <tr align="center"><th>Bill no.</th><th>Date</th><th>Ammount</th><th>Remarks</th></tr>
   

<?php
    $pdoQuery = "SELECT * FROM ledger WHERE customers_name='$customers_name' AND customers_address='$customers_address' order by id desc";
    
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    
    
    $pdoExec = $pdoResult->execute(array(":customers_name"=>$customers_name, ":customers_address"=>$customers_address ));
    
    if($pdoExec)
    {

          if($pdoResult->rowCount()>0)
        {

            foreach($pdoResult as $row)
            {        
              //$id = $row['id'];
              $bill_no = $row['bill_no']; 
              $date = $row['date'];
              $customers_name = $row['customers_name'];
              $customers_address = $row['customers_address'];
              $total_amount = $row['total_amount']; 
              $remarks = $row['remarks'];

                echo "<td>$bill_no</td>";
                echo "<td>$date</td>";
                echo "<td>$total_amount</td>";
                echo "<td>$remarks</td></tr>";
                 
                
                     }

                }

            else{
               echo "<tr><td align='center'colspan='10'><br><br><br><br><br><br><br><br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i>Sorry there is no data with this customers name Please check and re-enter the customers name correctly <br><br><br><br><br><br><br><br><br></td></tr>";
                }
    }
}


?>



      </table></td></tr>
      <tr><td align="right" colspan="2" height="20"><b>Credit Amount: <?php echo "$credit_amount"; ?></b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td></tr>
      <tr><td colspan="2" height="20"></td></tr></table></div>
      <table width="100%" bgcolor="#696969"><tr><td align="center"><a href="admin_home.php" class="button3">Back</a>&nbsp&nbsp&nbsp<button onclick="printDiv('printMe')" class="button3">Print</button></td></tr></table>
    