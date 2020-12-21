<?php
// mysqli_connect() function opens a new connection to the MySQL server.
$conn = mysqli_connect("localhost", "root", "", "mrp");
session_start();// Starting Session
// Storing Session
$user_check = $_SESSION['admin_login_session'];
// SQL Query To Fetch Complete Information Of User
$query = "SELECT username from admin_login where username = '$user_check'";
$ses_sql = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($ses_sql);
$login_session = $row['username'];
?>














<table border="0" class="login" align="center">
	<tr height="400px">
			<td width="400px" align="center">
				<form action="index.php" method="post" autocomplete="off">
			<b>LOGIN</b><br><br><br>
			Username<br>
			<input type="text" name="main_username" required=""><br><br>
			Password<br>
			<input type="password" name="main_password" required=""><br><br><br>
			<input type="submit" name="main_loginbtn" value="LOGIN" class="lnbtn">
			</form>
		    </td></tr>
	</table>
