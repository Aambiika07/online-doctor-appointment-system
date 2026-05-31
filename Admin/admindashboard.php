<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: adminlogin.php'); 
    exit;

$users_count = 150; 
$appointments_count = 30; 
$active_users = 120;
}
?>

