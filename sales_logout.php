<?php
session_start(['sales_login_session']);
unset($_SESSION["sales_login_session"]); // Destroying All Sessions {
header("Location: sales_login.php"); // Redirecting To Home Page
?>