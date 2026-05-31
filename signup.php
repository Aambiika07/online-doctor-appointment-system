<?php
session_start();

$_SESSION["user"] = "";
$_SESSION["usertype"] = "";
$date = date('Y-m-d');
$_SESSION["date"] = $date;

if ($_POST) {

    $_SESSION["personal"] = array(
        'fname' => htmlspecialchars($_POST['fname']),
        'lname' => htmlspecialchars($_POST['lname']),
        'address' => htmlspecialchars($_POST['address']),
        'phone' => htmlspecialchars($_POST['phone']),
        'dob' => $_POST['dob']
    );


    print_r($_SESSION["personal"]);
    header("Location: createaccount.php"); 
    exit(); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="animations.css">  
    <link rel="stylesheet" href="main.css">  
    <link rel="stylesheet" href="signup.css">
    <title>Sign Up</title>
</head>
<body>
    <center>
        <div class="container">
            <form action="" method="POST">
                <table border="0">
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="fname" class="form-label">First Name:</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td">
                            <input type="text" name="fname" class="input-text" placeholder="First Name" required>
                        </td>
                        <td class="label-td">
                            <input type="text" name="lname" class="input-text" placeholder="Last Name" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="address" class="form-label">Address:</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <input type="text" name="address" class="input-text" placeholder="Address" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="phone" class="form-label">Phone:</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <input type="tel" name="phone" class="input-text" placeholder="Phone Number" required pattern="[0-9]{10}" maxlength="10">
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="dob" class="form-label">Date of Birth:</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <input type="date" name="dob" class="input-text" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="reset" value="Reset" class="login-btn btn-primary-soft btn">
                        </td>
                        <td>
                            <input type="submit" value="Next" class="login-btn btn-primary btn">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <br>
                            <label for="" class="sub-text" style="font-weight: 280;">Already have an account? </label>
                            <a href="login.php" class="hover-link1 non-style-link">Login</a>
                            <br><br><br>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </center>
</body>
</html>
