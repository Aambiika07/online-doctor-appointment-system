<?php
session_start();
$host="localhost";
$servername = "root";
$password = "";
$dbname = "doctorappointment";
$conn = mysqli_connect($host, $servername, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $useremail = trim($_POST['useremail']);
    $userpassword = trim($_POST['userpassword']);

    if (empty($useremail) || empty($userpassword)) {
        die("Email or password cannot be empty.");
    }
    var_dump($useremail);
    $stmt = $conn->prepare("SELECT id, Fullname, email, password FROM users WHERE email = ?");
    if ($stmt === false) {
             die("Error preparing the statement: " . $conn->error);
    }
    if (!$stmt->bind_param("s", $useremail)) {
        die("Error binding parameters: " . $stmt->error); 
    }
    if (!$stmt->execute()) {
        die("Error executing the statement: " . $stmt->error);
    }
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
     
        if (password_verify($userpassword, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['Fullname'] = $user['Fullname'];
            $_SESSION['email'] = $user['email'];
            header("Location: mainboard.php");
            exit();
        } else {
            $error_message = "Invalid email or password.";
        }
    } else {
        $error_message = "No user found with that email.";
    }
    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to Online Doctor Appointment System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9e9e9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background: #e0dcdc;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #070707;
        }

        .login-container form {
            display: flex;
            flex-direction: column;
        }

        .login-container input {
            margin-bottom: 15px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #fbf0f0;
            border-radius: 5px;
        }

        .login-container button {
            padding: 10px;
            font-size: 16px;
            background-color: #fa33f6;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-container button:hover {
            background-color: #710cdd;
        }

        .login-container .register-link {
            margin-top: 10px;
            font-size: 14px;
        }

        .login-container .register-link a {
            color: #1581f5;
            text-decoration: none;
        }

        .login-container .register-link a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login to HealthCare</h2>

        <?php if (isset($error_message)): ?>
            <div class="error-message">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <label for="useremail" class="form-label">Email:</label>
            <input type="email" name="useremail" class="input-text" placeholder="Email Address" required>

            <label for="userpassword" class="form-label">Password:</label>
            <input type="password" name="userpassword" class="input-text" placeholder="Password" required>

            <button type="submit">Login</button>
        </form>

        <div class="register-link">
            <p>Don't have an account? <a href="signup.php">Register here</a></p>
        </div>
    </div>
</body>
</html>
