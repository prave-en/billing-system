	<?php
session_start(['admin_login_session']);
unset($_SESSION["admin_login_session"]);
header("Location: admin.php");
?>