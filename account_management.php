<html>  
    <head>  
        <title>account management</title>
           
    </head>  
    <style>
        body{
            margin:0;
        }
        .lnbtn{
      background-color: #696969;
      border: 1px solid black;
      border-radius: 5px;
      width: 70%;
      padding-top: 5px;
      padding-bottom: 5px;
      color: white;
      margin-top: 2px;
    }
    .lnbtn:hover{
      background-color: #494848;
    }

    input[type=text],input[type=password],input[type=number]{
    width: 70%;
    height: 20px;
    border: 1px solid black;
    border-radius: 5px;
    text-align: center;
    outline: none;
    margin-top: 2px;
    margin-bottom: 2px;
  }
   input[type=text]:focus,input[type=password]:focus,input[type=number]:focus{
   background-color: #cccccc;
  }
  .back{
    border-radius: 3px;
    border:1px solid black;
    display: inline-block;
    width: 70%;
    padding-top: 3px;
    padding-bottom: 3px;
    background-color: #696969;
  }
  .back:hover{
    background-color: #484848;
  }
</style>
    <body> 
        <table border="0" width="100%" bgcolor="#696969">
            <tr><td height="50" ><img src="logo.png"></td></tr>
            <tr><td height="40" bgcolor="#484848" align="center"><b>ACCOUNT MANAGEMENT<b></td></tr>
                <tr><td height="20"></td></tr>
                <tr><td>
                    <table border="0" width="100%">
                        <tr><td align="center" colspan="3" bgcolor="#484848" height="30"><b>Entry Account</b></td></tr>
                        <tr>
                            <td align="center"><b>Add Account</b><br><br>
                                <form action="accountmanagementdb.php" method="post"><input type="text" name="username" placeholder="username"><br><input type="password" name="password" placeholder="password"><br><input type="submit" name="entry_add" value="Add Account" class="lnbtn">
                                </form></td>
                            <td align="center">
                                <b> Available Account</b><br><br>
                                <table border="1" width="100%">
                                    <tr><th>id</th><th>Username</th><th>Password</th></tr>
                                        <?php
  $servername="localhost";
  $username="root";
$password="";
$dbname="mrp";
$con=mysqli_connect($servername,$username,$password,$dbname);

$sql = "SELECT * FROM entry_login";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
  
    while($row = mysqli_fetch_assoc($result)) {

        echo "<tr align='center'>"."<td>";      
        echo  $row["id"]."</td>"."<td>";
        echo  $row["username"]."</td>"."<td>";
        echo "*********"."</td>"."</tr>";
    }
}
mysqli_close($con);
?>

                                </table>
                            </td>

                            <td align="center">
                                <b>Delete Account</b><br><br>
                                <form action="accountmanagementdb.php" method="post">
                                    <input type="number" name="id" placeholder="id"><br>
                                    <input type="submit" name="entry_delete" value="Delete" class="lnbtn">
                                </form>
                            </td>
                        </tr>
                    </table></td></tr>
                    <tr><td height="40"></td></tr>
                    <tr><td>

                    <table border="0" width="100%">
                        <tr><td align="center" colspan="3" bgcolor="#484848" height="30"><b>Sales Account</b></td></tr>
                        <tr>
                            <td align="center"><b>Add Account</b><br><br>
                                <form action="accountmanagementdb.php" method="post"><input type="text" name="username" placeholder="username"><br><input type="password" name="password" placeholder="password"><br><input type="submit" name="sales_add" value="Add Account" class="lnbtn">
                                </form></td>
                            <td align="center">
                                <b> Available Account</b><br><br>
                                <table border="1" width="100%">
                                    <tr><th>id</th><th>Username</th><th>Password</th></tr>
                                        <?php
  $servername="localhost";
  $username="root";
$password="";
$dbname="mrp";
$con=mysqli_connect($servername,$username,$password,$dbname);

$sql = "SELECT * FROM sales_login";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
  
    while($row = mysqli_fetch_assoc($result)) {
      
         echo "<tr align='center'>"."<td>";      
        echo  $row["id"]."</td>"."<td>";
        echo  $row["username"]."</td>"."<td>";
        echo "*********"."</td>"."</tr>";
    }
}
mysqli_close($con);
?>

                                </table>
                            </td>

                            <td align="center">
                                <b>Delete Account</b><br><br>
                                <form  action="accountmanagementdb.php" method="post">
                                    <input type="number" name="id" placeholder="id"><br>
                                    <input type="submit" name="sales_delete" value="Delete" class="lnbtn">
                                </form>
                            </td>
                        </tr>
        </table></td></tr>
        <tr><td height="30"></td></tr>
        <tr><td colspan="2" align="center" height="53">
                         <button onclick="goBack()" class="back" >Back</button>
      <script>
function goBack() {
 location= "admin_home.php";
}
</script>
                    </td></tr>


  
