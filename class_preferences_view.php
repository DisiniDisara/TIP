<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style/class_sessions.css">

    <title>Class Preferences View</title>
    <?php
        session_start();
        require_once('utilities.php');
        isLoggedIn();
    ?>
</head>
<body>
    <?php
    include 'generateNav.php';
    $nav = generateNav();
    echo $nav;
    ?>
<div class="container my-5">
        <div class="d-flex align-items-center align-self-center">
            <div class="container-fluid d-flex justify-content-center">
                <div class="card p-4 border-light">
    <?php
        require 'connections.php';
        require_once('generateTimeTable.php');
        // Get the unit code and applicant ID from the URL parameters
        $unitCode = $_GET['unitCode'];
        $applicantID = ($_SESSION['userRole']=='applicant') ? $_SESSION['userID']:$_GET['applicantID'];

        $sql = "SELECT givenName, familyName FROM systemUser WHERE userID='$applicantID'";
        $object = $mysqli->query($sql);
        $result = $object->fetch_object();
        $givenName = $result->givenName;
        $familyName = $result->familyName;

        // Creating timetable view of class sessions
        $query = "SELECT * FROM class WHERE unitCode='$unitCode'";
        $result = $mysqli->query($query);

        $query2 = "SELECT classCode as class FROM class";

        $result2 = $mysqli->query($query2);

        $preferencesTable = generatePrefClassTable($applicantID, $result, $result2, $edit=false, $mainColor='lightblue');

        echo "<h3>{$unitCode} Class Preferences View</h3>";

        echo <<<TABLE
            <p>Class preferences for applicant {$givenName} {$familyName} {$applicantID} in unit {$unitCode}:</p>
            {$preferencesTable}
TABLE;

        if ($_SESSION['userRole']=='applicant'){
            echo <<<HTML
            <div class='buttons container-fluid d-flex justify-content-center'>
                <form action="class_preferences_edit.php?applicantID={$applicantID}&unitCode={$unitCode}&edit=1" method="post">
                    <button class="btn butt_out m-2" type="submit">Edit</button>
                </form>
                <form action="units.php" method="">
                    <button class="btn butt_out m-2" type="submit">Units</button>
                </form>
            </div>
HTML;
        }
        // End of card divs below
    ?>
                </div>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script> 
</body>
</html>
