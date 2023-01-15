<?php 
if (session_status() === PHP_SESSION_ACTIVE) {
    session_destroy();
}
echo $_SESSION['loggedin'];
echo "/";
echo $_SESSION['fullname'];
header("location:index.php");
?>
