

<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("dbconn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['useremail'];
    $password = $_POST['userpassword'];

    $stmt = $database->prepare("SELECT usertype FROM webuser WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $usertype = $row['usertype'];

        if ($usertype == 'p') {
            $stmt = $database->prepare("SELECT ppassword FROM patient WHERE pemail=?");
        } elseif ($usertype == 'd') {
            $stmt = $database->prepare("SELECT docpassword FROM doctor WHERE docemail=?");
        } else {
            die("Invalid user type.");
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hashed_password = $row[array_keys($row)[0]];

            if (password_verify($password, $hashed_password)) {
                $_SESSION['user'] = $email;
                $_SESSION['usertype'] = $usertype;

                if ($usertype == 'p') {
                    header("Location: patient.php");
                } else {
                    header("Location: doctor.php");
                }
                exit();
            } else {
                echo "<script>alert('Invalid email or password.'); window.location='login.php';</script>";
            }
        }
    } else {
        echo "<script>alert('Email not found.'); window.location='login.php';</script>";
    }
}
?>
