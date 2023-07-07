<?php
session_start();

// Include the database connection file
require_once 'db_connect.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Perform the database query
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login successful, store user information in session
        $row = $result->fetch_assoc();
        $_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['name'] = $row['name'];

        header("Location: resumePage.php");
        exit();
    } else {
        // Login failed
        //$error = "Invalid email or password.";
        //echo $error;
        header("Location: login.html");
    }
}

$conn->close();
?>
