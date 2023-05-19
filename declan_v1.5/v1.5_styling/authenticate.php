<?php
session_start();

require 'connections.php';
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

$sql_check = "SELECT * FROM user WHERE username='$username' and sPassword='$password' ";

$result = $mysqli->query($sql_check);

// Check if username and password match
if ($result->num_rows == 1) {
    // Retrieve the row of data as an associative array
    $sql_check = "SELECT * FROM user, applicant WHERE user.username='$username' and applicant.username='$username'";
    $result = $mysqli->query($sql_check);

    $row = $result->fetch_assoc();

    // Set the session variables
    $_SESSION['isLoggedIn'] = true;
    $_SESSION['givenName'] = $row['givenName'];
    $_SESSION['applicantID'] = $row['applicantID'];
    $_SESSION['username'] = $username;
    // Redirect to the home page or some other page...
    header('Location: index.php');
    exit();
} else {
    header("Location: login.php?error=1");
}

?>