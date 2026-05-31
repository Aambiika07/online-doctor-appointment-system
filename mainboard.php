<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
echo "Welcome to your dashboard, " . $_SESSION['username'];
?>
