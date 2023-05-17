<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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
            <div class='buttons'>
                <form action="class_preferences_edit.php?applicantID={$applicantID}&unitCode={$unitCode}&edit=1" method="post">
                    <button type="submit">Edit Preferences</button>
                </form>
                <form action="units.php" method="">
                    <button type="submit">Units</button>
                </form>
            </div>
HTML;
        }
    ?>
</body>
</html>
