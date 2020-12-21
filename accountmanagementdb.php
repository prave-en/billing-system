<?php
try{
  $con=new PDO("mysql:host=localhost;dbname=mrp",'root','');
 /* echo " database connected";
  echo  "<br>";*/
  $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}

     catch (PDOException $e)
     {
      echo"ERROR".$e->getMessage();
     }
$error=''; //Variable to Store error message;
if(isset($_POST['entry_add'])){
if(empty($_POST['username']) || empty($_POST['password'])){
 $error = "Username or Password is Invalid";
 }
 else
 {
 //Define $user and $pass
 $username=$_POST['username'];
 $password=$_POST['password'];
 $password = md5($username.$password);
 
 //Establishing Connection with server by passing server_name, user_id and pass as a patameter
 $conn = mysqli_connect("localhost", "root", "");
 //Selecting Database
 $db = mysqli_select_db($conn, "mrp");
 //sql query to fetch information of registerd user and finds user match.
 $query = mysqli_query($conn, "SELECT * FROM entry_login WHERE username='$username' AND password='$password'");
 
 $rows = mysqli_num_rows($query);
 if($rows == 1){ //matched

  ?>
  <script >
    alert("username and password exist");
  location= "account_management.php";
  </script>
  <?php

 }
 else
 {
     if(isset($_POST['entry_add']))
     {
       $username=$_POST['username'];
       $password=$_POST['password'];
       $password = md5($username.$password);
     }
     $stmt=$con->prepare('INSERT INTO  entry_login(username,password)values(:username,:password)');
     $stmt->bindparam(':username',$username);
     $stmt->bindparam(':password',$password);
     if($stmt->execute())
{

 ?>
  <script >
    alert("username and password successfully inserted");
  location= "account_management.php";
  </script>
  <?php
 

}
else
{
  ?>
  <script >
    alert("ERROR...username and password not inserted");
  location= "account_management.php";
  </script>
  <?php

}
 
 }
 mysqli_close($conn); // Closing connection
 }
}
 ?>



<?php
if(isset($_POST['entry_delete'])){
 if(empty($_POST['id'])){
 
 }
 else
 {
 
 $id=$_POST['id'];
 
  $conn = mysqli_connect("localhost", "root", "");
 
 $db = mysqli_select_db($conn, "mrp");

 $query = mysqli_query($conn, "SELECT * FROM entry_login WHERE id='$id'");
 
 $rows = mysqli_num_rows($query);
 if($rows == 1){
 

if(isset($_POST['entry_delete']))
{
        
    try {
        $pdoConnect = new PDO("mysql:host=localhost;dbname=mrp","root","");
    } catch (PDOException $exc) {
        echo $exc->getMessage();
        exit();
    }
    
   
    $id = $_POST['id'];
    
   
    $pdoQuery = "DELETE FROM entry_login WHERE id = :id";
    
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    
    
    $pdoExec = $pdoResult->execute(array(":id"=>$id));
    
     if($pdoExec)
     {
       ?>
  <script >
    alert("username and password deleted");
  location= "account_management.php";
  </script>
  <?php
     }else{

      ?>
  <script >
    alert("ERROR... username and password not deleted");
  location= "account_management.php";
  </script>
  <?php
     }
 }


 }
 else
 {
 ?>
  <script >
    alert("ERROR...id does not match");
  location= "account_management.php";
  </script>
  <?php
 }
 mysqli_close($conn); // Closing connection
 }
}
 
?>



<?php
try{
  $con=new PDO("mysql:host=localhost;dbname=mrp",'root','');
 /* echo " database connected";
  echo  "<br>";*/
  $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}

     catch (PDOException $e)
     {
      echo"ERROR".$e->getMessage();
     }
$error=''; //Variable to Store error message;
if(isset($_POST['sales_add'])){
if(empty($_POST['username']) || empty($_POST['password'])){
 $error = "Username or Password is Invalid";
 }
 else
 {
 //Define $user and $pass
 $username=$_POST['username'];
 $password=$_POST['password'];
 $password = md5($username.$password);
 //Establishing Connection with server by passing server_name, user_id and pass as a patameter
 $conn = mysqli_connect("localhost", "root", "");
 //Selecting Database
 $db = mysqli_select_db($conn, "mrp");
 //sql query to fetch information of registerd user and finds user match.
 $query = mysqli_query($conn, "SELECT * FROM sales_login WHERE username='$username' AND password='$password'");
 
 $rows = mysqli_num_rows($query);
 if($rows == 1){ 

  ?>
  <script >
    alert("username and password exist");
  location= "account_management.php";
  </script>
  <?php

 }
 else
 {
     if(isset($_POST['sales_add']))
     {
       $username=$_POST['username'];
       $password=$_POST['password'];
       $password = md5($username.$password);
     }
     $stmt=$con->prepare('INSERT INTO  main_login(main_username,main_password)values(:username,:password)');
     $stmt->bindparam(':username',$username);
     $stmt->bindparam(':password',$password);
     if($stmt->execute())
{

 ?>
  <script >
    alert("username and password successfully inserted");
  location= "account_management.php";
  </script>
  <?php
 

}
else
{
  ?>
  <script >
    alert("ERROR...username and password not inserted");
  location= "account_management.php";
  </script>
  <?php

}
 
 }
 mysqli_close($conn); // Closing connection
 }
}
 ?>



 <?php
if(isset($_POST['sales_delete'])){
 if(empty($_POST['id'])){
 
 }
 else
 {
 
 $id=$_POST['id'];
 
  $conn = mysqli_connect("localhost", "root", "");
 
 $db = mysqli_select_db($conn, "mrp");

 $query = mysqli_query($conn, "SELECT * FROM sales_login WHERE id='$id'");
 
 $rows = mysqli_num_rows($query);
 if($rows == 1){
 

if(isset($_POST['sales_delete']))
{
        
    try {
        $pdoConnect = new PDO("mysql:host=localhost;dbname=mrp","root","");
    } catch (PDOException $exc) {
        echo $exc->getMessage();
        exit();
    }
    
   
    $id = $_POST['id'];
    
   
    $pdoQuery = "DELETE FROM sales_login WHERE id = :id";
    
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    
    
    $pdoExec = $pdoResult->execute(array(":id"=>$id));
    
     if($pdoExec)
     {
       ?>
  <script >
    alert("username and password deleted");
  location= "account_management.php";
  </script>
  <?php
     }else{

      ?>
  <script >
    alert("ERROR... username and password not deleted");
  location= "account_management.php";
  </script>
  <?php
     }
 }


 }
 else
 {
 ?>
  <script >
    alert("ERROR...id does not match");
  location= "account_management.php";
  </script>
  <?php
 }
 mysqli_close($conn); // Closing connection
 }
}
 
?>
