<?php
session_start();

// Include the database connection file
require_once 'db_connect.php';

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.html");
    exit();
}

// Retrieve user information from the database
$id = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE id = '$id'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $email = $row['email'];
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $country = $row['country'];
    $password = $row['password'];
    $profile = $row['profile'];
    $education = $row['education'];
    $contactNo = $row['contactNo'];
    $otp = $row['otp'];
    $skills = $row['skills'];
    $workExperience = $row['workExperience'];
} else {
    // If user information not found, redirect to login page
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Resume Page</title>
    <style>
        /* CSS styling for resume page */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-transform: uppercase;
            margin-bottom: 30px;
            text-align: center;
            font-size: 32px;
        }

        .resume-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            padding: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 13px;
            font-size: 18px;
            word-wrap: break-word;
        }

        .btn-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }

        .btn {
            display: inline-block;
            padding: 13px 26px;
            margin: 0 8px;
            font-size: 18px;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>RESUME</h1>

    <div class="resume-container">
        <table>
            <tr>
                <th>Email</th>
                <td><?php echo formatText($email, 5); ?></td>
            </tr>
            <tr>
                <th>First Name</th>
                <td><?php echo formatText($firstname, 5); ?></td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td><?php echo formatText($lastname, 5); ?></td>
            </tr>
            <tr>
                <th>Country</th>
                <td><?php echo formatText($country, 5); ?></td>
            </tr>
            <tr>
                <th>Profile</th>
                <td><?php echo formatText($profile, 5); ?></td>
            </tr>
            <tr>
                <th>Education</th>
                <td><?php echo formatText($education, 5); ?></td>
            </tr>
            <tr>
                <th>Contact No</th>
                <td><?php echo formatText($contactNo, 5); ?></td>
            </tr>
            <tr>
                <th>Skills</th>
                <td><?php echo formatText($skills, 5); ?></td>
            </tr>
            <tr>
                <th>Work Experience</th>
                <td><?php echo formatText($workExperience, 5); ?></td>
            </tr>
        </table>
    </div>

    <div class="btn-container">
        <a class="btn" href="login.html">Logout</a>
        <button class="btn" onclick="window.print()">Print</button>
    </div>

    <?php
    function formatText($text, $wordsPerLine) {
        $words = explode(' ', $text);
        $formattedText = '';
        $count = 0;

        foreach ($words as $word) {
            $formattedText .= $word . ' ';
            $count++;

            if ($count % $wordsPerLine == 0) {
                $formattedText .= '<br>';
            }
        }

        return trim($formattedText);
    }
    ?>
</body>
</html>
