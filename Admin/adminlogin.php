<?php
session_start();

include("dbconn.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $database->prepare("SELECT aemail, password FROM admin WHERE aemail = ?"); 
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $stored_password_hash = $row['password']; 
        $admin_id = $row['id']; 

        if (password_verify($password, $stored_password_hash)) {
            $_SESSION['admin_id'] = $admin_id;
            $_SESSION['admin_username'] = $username; 
            header("Location: admin.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Invalid username.";
    }

    $_SESSION['login_error'] = $error; 
    header("Location: adminlogin.php"); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 2px;
        }
        .login-container {
            background: white;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 300px;
        }
        h2 {
            text-align: center;
            margin-bottom: 40px;
            color: #fe0c0c;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #0158b5;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #0356af;
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="login-container">
        <h2>Admin Login</h2>
        <?php 
        if (isset($_SESSION['login_error'])) { 
            echo "<p class='error'>".$_SESSION['login_error']."</p>"; 
            unset($_SESSION['login_error']);
        } 
        ?>
        <form action="admin.php" method="POST">  
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>