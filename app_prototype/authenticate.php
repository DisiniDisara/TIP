<?php
session_start();

require 'connections.php';
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

$sql_check = "SELECT * FROM login WHERE username='$username' and sPassword='$password' ";
$result = $mysqli->query($sql_check);

// Check if username and password pair exist
if ($result->num_rows == 1) {
    // Get row of user details
    $row = $result->fetch_assoc();
    $userRole = $row['userRole'];
    
    if ($userRole=='staff') {
        $sql_check = "SELECT * FROM login, staff WHERE login.username='$username' and staff.username='$username'";
        $result = $mysqli->query($sql_check);
        $row = $result->fetch_assoc();

        $_SESSION['staffID'] = $row['staffID'];
        $_SESSION['userID'] = $row['staffID'];
        $_SESSION['givenName'] = $row['sGivenName'];

    } else { //Default role is applicant

        // Retrieve the row of data as an associative array
        $sql_check = "SELECT * FROM login, applicant WHERE login.username='$username' and applicant.username='$username'";
        $result = $mysqli->query($sql_check);
        $row = $result->fetch_assoc();
        $_SESSION['applicantID'] = $row['applicantID'];
        $_SESSION['userID'] = $row['applicantID'];
        $_SESSION['givenName'] = $row['givenName'];
    }

    // Set the session variables
    $_SESSION['username'] = $username;
    $_SESSION['userRole'] = $userRole;
    $_SESSION['isLoggedIn'] = true;

    // Redirect to the home page or some other page...
    header('Location: index.php');
    exit();

} else { 
    
    $mysqli->close();
    // username and password pair do not exist in database
    header("Location: login.php?error=1");
}


?>