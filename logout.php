<?php
session_start();  
if (session_status() === PHP_SESSION_ACTIVE) {  
    session_unset();  
    session_destroy();  
}

header("Location: login.php");  
exit();  
?>
