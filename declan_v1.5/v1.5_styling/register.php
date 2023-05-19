<?php
// start the session manager
session_start();

// Include external codes
require_once('utilities.php');

// Connect to database
require 'connections.php';

// Get form data
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$password2 = $_REQUEST['password2'];

// Check if the two passwords match
if ($password != $password2) {
    $_SESSION['message'] = "The two passwords do not match.";
    header("Location: signup.php?error=1");
    exit();
}

// To-Do: Implement password hashing
// $hash = password_hash($password, PASSWORD_DEFAULT);

// Check if username already exists
$sql_check = "SELECT username FROM user WHERE username = '$username'";

// Can either insert new row or update old preferences.
$result_check = $mysqli->query($sql_check);
if ($result_check->num_rows > 0) { 
    echo "Username already exist " . PHP_EOL;

    // // Redirect to signup page with error
    header("Location: signup.php?error=2");

} else {
    // $insert = "INSERT INTO user (username, sPassword) VALUES ('$username', '$password')";
    // $result = mysqli_query($mysqli, $insert);

    // if ($result){
    //     //$_SESSION['username'] = $username;
    //     // After success of account creation, redirect to input details page 
    //     header("Location: first_details.php?username=$username&password=$password");
    //     exit();
        
    // } else {
    //     //I dont know what to do here...
    //     echo "Error in inserting new username and password " . PHP_EOL;
    //     header("Location: signup.php?error=3");

    // }
    header("Location: first_details.php?username=$username&password=$password");

}


?>
