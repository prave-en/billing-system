<?php
// mysqli_connect() function opens a new connection to the MySQL server.
$conn = mysqli_connect("localhost", "root", "", "mrp");
session_start(['entry_login_session']);// Starting Session
// Storing Session
$user_check = $_SESSION['entry_login_session'];
// SQL Query To Fetch Complete Information Of User
$query = "SELECT username from entry_login where username = '$user_check'";
$ses_sql = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($ses_sql);
$login_session = $row['username'];
?>