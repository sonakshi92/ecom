<?php
 if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
 unset($_SESSION['ADMIN_LOGIN']);
 unset($_SESSION['admin_email']);
 session_destroy();
session_unset();
header('Location: login.php');
?>