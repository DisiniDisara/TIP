<?php
session_start();
require_once('utilities.php');
isLoggedIn();
require 'connections.php';

$applicantID = $_GET['applicantID'];
$unitCode = $_GET['unitCode'];

$query = "SELECT COUNT(*) AS num_rows FROM preferences WHERE userID = '$applicantID' AND unitCode = '$unitCode'";
$stmt = $mysqli->query($query);

$count = 0;
if ($stmt) {
    $row = $stmt->fetch_assoc();
    $count = $row['num_rows'];
} 

if ($count>0) {
    $query = "DELETE FROM preferences WHERE userID = '$applicantID' and unitCode = '$unitCode'";
    $stmt = $mysqli->query($query);
}

header("Location:class_preferences_edit.php?applicantID={$applicantID}&unitCode={$unitCode}&edit=1");
?>