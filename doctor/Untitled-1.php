<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="animations.css">  
    <link rel="stylesheet" href="main.css">  
    <link rel="stylesheet" href="login.css">
    <script src="login.js"></script>
        
    <title>Login</title>
</head>
<body>
    <form action="login.php" method="POST">

    <div class="container">
        <table border="0" style="margin: 0;padding: 0;width: 60%;">
            <tr>
                <td>
                    <p class="header-text">Welcome!!!</p>
                </td>
            </tr>
        <div class="form-body">
            <tr>
                <td>
                    <p class="sub-text">Login here...</p>
                </td>
            </tr>
            <tr>
                <form action="" method="POST" >
                <td class="label-td">
                    <label for="useremail" class="form-label">Email: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <input type="email" name="useremail" class="input-text" placeholder="Email Address" required>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <label for="userpassword" class="form-label">Password: </label>
                </td>
            </tr>

            <tr>
                <td class="label-td">
                    <input type="password" name="userpassword" class="input-text" placeholder="Password" required>

                </td>
            </tr>


            <tr>
                <td><br>
             
                </td>
            </tr>

            <tr>
                <td>
                    <input type="submit" value="Login" class="login-btn btn-primary btn">
                </td>
            </tr>
            
        </div>
            <tr>
                <td>
                    <br>
                    <div class="register-link">
                        <p>Don't have an account? <a href="register.html">Register here</a></p>
                    <br><br><br>
                </td>
            </tr>        
                    </form>
        </table>

    </div>
</form>
</body>
</html> 



this is login.html page document.addEventListener("DOMContentLoaded", function () {
    document.querySelector("form").addEventListener("submit", function (event) {
        const email = document.querySelector('input[name="useremail"]').value.trim();
        const password = document.querySelector('input[name="userpassword"]').value.trim();

        if (email === "" || password === "") {
            event.preventDefault();
            alert("Both email and password are required!");
        }
    });
});

function togglePassword(event) {
    event.preventDefault();
    const passwordInput = document.getElementById('userpassword');
    const toggleButton = event.target;

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleButton.textContent = 'Hide';
    } else {
        passwordInput.type = 'password';
        toggleButton.textContent = 'Show';
    }
}  login.js page <?php
session_start();
include('dbconn.php');

$error = ''; 
if (isset($_SESSION['login_error'])) { 
    echo "<p class='error'>".$_SESSION['login_error']."</p>"; 
    unset($_SESSION['login_error']);
} 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $database->real_escape_string($_POST['useremail']);
    $password = $_POST['userpassword'];
    
    $result = $database->query("SELECT * FROM webuser WHERE email='$email'");
    
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $utype = $user['usertype'];

        if ($utype == 'p') {
            $checker = $database->query("SELECT * FROM patient WHERE pemail='$email'");
            if ($checker->num_rows == 1) {
                $patient = $checker->fetch_assoc();
                if (password_verify($password, $patient['ppassword'])) {
                    $_SESSION['user'] = $email;
                    $_SESSION['usertype'] = 'p';
                    header('Location: patient.php');
                    exit();
                } else {
                    $_SESSION['login_error'] = 'Wrong credentials: Invalid email or password';
                    header('Location: login.php');
                    exit();
                }
            }
        } elseif ($utype == 'a') {
            $checker = $database->query("SELECT * FROM admin WHERE aemail='$email'");
            if ($checker->num_rows == 1) {
                $admin = $checker->fetch_assoc();
                if (password_verify($password, $admin['apassword'])) {
                    $_SESSION['user'] = $email;
                    $_SESSION['usertype'] = 'a';
                    header('Location: admin.php');
                    exit();
                } else {
                    $_SESSION['login_error'] = 'Wrong credentials: Invalid email or password';
                    header('Location: login.php');
                    exit();
                }
            }
        } elseif ($utype == 'd') {
            $checker = $database->query("SELECT * FROM doctor WHERE docemail='$email'");
            if ($checker->num_rows == 1) {
                $doctor = $checker->fetch_assoc();
                if (password_verify($password, $doctor['docpassword'])) {
                    $_SESSION['user'] = $email;
                    $_SESSION['usertype'] = 'd';
                    header('Location: doctor.php');
                    exit();
                } else {
                    $_SESSION['login_error'] = 'Wrong credentials: Invalid email or password';
                    header('Location: login.php');
                    exit();
                }
            }
        }
    } else {
        $_SESSION['login_error'] = 'We can\'t find any account for this email.';
        header('Location: login.html');
        exit();
    }
}
?>  