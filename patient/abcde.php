<?php
if (isset($_POST ['r11']));
{
    $fname=$_POST['r1'];
    $fathername=$_POST['r2'];
    $email=$_POST['r3'];
    $phone=$_POST['r4'];
    $dob=$_POST['r5'];
    $address=$_POST['r6'];
    $gender=$_POST['r7'];
    $user=$_POST['r8'];
    $pass=$_POST['r9'];
    $cpass=$_POST['r10'];

    if(!preg_match('/^[A-Za-z0-9]{1,30}$/', $fname))
    {
        echo "Your name is inavalid ";
    }
    else if(!preg_match('/^[A-Z]+[0-9]+) \@[a-z]+\ [a-z]+{1,3}$/', $email))
    {
        echo "Invalid Email ";
    else if(!preg_match('/^[0-9]{10}$/', $phone))
    {
        echo "Phone number must be 10 digit";
    }
    else if(!preg_match('/^[0-9]{8}$/', $dob))
    {
        echo "Must be in number ";
    }
    
    else if(!preg_match('/^[A-Za-z0-9]{8,16}$/', $user))
    {
        echo "Your User Name must be strong with Character and Number ";
    }
    else if(!preg_match('/^[A-Za-z0-9]{1,8}+\@ #\ +[A-Z]{1,3}$/', $pass))
    {
        echo "Invalid Password";
    }

       else if($pass!=$cpass)
       {
        echo "Password is not match"
       }

    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <script src="login.js"></script>
</head>
<body>

    <form id="loginForm" onsubmit="return login()">
        <h1>Welcome to Login Page</h1>
        <hr>
        <!-- Username input -->
        User Name: <input type="text" id="r1" required><br><br>
        
        <!-- Password input -->
        Password: <input type="password" id="r2" required><br><br>
        
        <!-- Login button -->
        <button type="submit">Login</button>

        <!-- Signup link -->
        <button id="r3"><a href="signup.html">Signup</a></button><br><br>

        <!-- Forget Password link -->
        <p><i><a href="forget.html">Forget Password?</a></i></p>
    </form>

    <script>
        // Login function to validate and redirect
        function login() {
            // Get user input values
            const username = document.getElementById('r1').value;
            const password = document.getElementById('r2').value;

            // Basic validation (this can be expanded based on requirements)
            if (username === "" || password === "") {
                alert("Both fields are required.");
                return false;
            }
            
            // If login is successful, redirect to appointment page
            // This is just a basic example, you may want to implement real authentication
            alert("Login Successful! Redirecting to appointment page...");
            window.location.href = "appointment.html"; // Redirect to appointment page

            return false; // Prevent default form submission
        }
    </script>

</body>
</html>
