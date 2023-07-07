<?php
session_start();

// Include the database connection file
require_once 'db_connect.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $country = $_POST['country'];
    $password = $_POST['password'];
    $profile = $_POST['profile'];
    $education = $_POST['education'];
    $contactNo = $_POST['contactNo'];
    $otp= $_POST['otp'];
    $skills = $_POST['skills'];
    $workExperience = $_POST['workExperience'];

    // Perform the database query
   $sql = "INSERT INTO users (email, firstname, lastname, country, password, profile, education, contactNo, otp, skills, workExperience)
            VALUES ('$email', '$firstname', '$lastname', '$country', '$password', '$profile', '$education', '$contactNo', '$otp', '$skills', '$workExperience')";

    if ($conn->query($sql) === TRUE) {
        // Registration successful
        header("Location: welcome.php");
        exit();
    } else {
        // Registration failed
        $error = "Error: " . $sql . "<br>" . $conn->error;
        echo $error;
    }
}

$conn->close();
?>
