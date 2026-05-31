<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Fullname = $_POST['Fullname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $host = "localhost";
    $user = "root"; 
    $passwordDB = ""; 
    $database = "doctorappointment"; 

    $conn = new mysqli($host, $user, $passwordDB, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check role and prepare query
    if ($role === 'doctor') {
        $stmt = $conn->prepare("INSERT INTO doctor (Fullname, email, password) VALUES (?, ?, ?)");
    } elseif ($role === 'patient') {
        $stmt = $conn->prepare("INSERT INTO patient (Fullname, email, password) VALUES (?, ?, ?)");
    } else {
        die("Invalid role selected.");
    }

    if ($stmt === false) {
        die("Error in statement preparation: " . $conn->error);
    }

    $stmt->bind_param("sss", $Fullname, $email, $password);

    if ($stmt->execute()) {
        // Redirect based on role
        if ($role === 'doctor') {
            header("Location: doctors.php"); // Redirect to doctor dashboard
        } elseif ($role === 'patient') {
            header("Location: patient.php"); // Redirect to patient dashboard
        }
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
