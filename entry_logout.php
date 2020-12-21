<?php
session_start(['entry_login_session']);
unset($_SESSION["entry_login_session"]); // Destroying All Sessions {
header("Location: entry_login.php"); // Redirecting To Home Page
?>