<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
    <?php session_start(); 
    require_once('utilities.php');
    isLoggedIn();
    echo "<title>{$_SESSION['givenName']}'s Timetable</title>"; 
    ?>
</head>
<body>
    <?php
    include 'generateNav.php';
    $nav = generateNav();
    echo $nav;
    ?>

    <h3>Your Time Table</h3>

    <?php
        require 'connections.php';
        require_once('utilities.php');
        require_once('generateTimeTable.php');

        $query = "SELECT * FROM sessionsTest";
        $result = $mysqli->query($query);

        $query2 = "SELECT DISTINCT `class_name` as class FROM sessionsTest";

        $result2 = $mysqli->query($query2);

        $TIMETABLE = generateTimeTable($result, $result2);

        echo $TIMETABLE;
    ?>
</body>
</html>
