<?php

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
    header("Location: signup.php?error=1");
    exit();
}

// To-Do: Implement password hashing
// $hash = password_hash($password, PASSWORD_DEFAULT);

// Check if username already exists
$sql_check = "SELECT username FROM login WHERE username = '$username'";

// Can either insert new row or update old preferences.
$result_check = $mysqli->query($sql_check);
if ($result_check->num_rows > 0) { 
    echo "Username already exist " . PHP_EOL;

    // // Redirect to signup page with error
    header("Location: signup.php?error=2");

} else {

    header("Location: create_account.php?username=$username&password=$password");

}


?>
