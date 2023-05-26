<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style/class_sessions.css">
    <?php
        session_start();
        require_once('utilities.php');
        isLoggedIn();
        $unitCode = $_GET['unitCode'];
        echo "<title>$unitCode Applicant Class Preferences </title>";

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
        echo "<h3 class=\"text-center mb-3\">$unitCode Applicant Class Preferences</h3>";

        require 'connections.php';

        // Get the unit code and applicant ID from the URL parameters
        $unitCode = $_GET['unitCode'];
        
        // Query the database to get the preferences for the applicant and unit
        $sql = "SELECT DISTINCT userID FROM preferences WHERE unitCode = '$unitCode'";
        $applicants = $mysqli->query($sql);
        $num_applicants = $applicants->num_rows;

        $preferencesTable = '';

        while ($data = $applicants->fetch_object()) {
            $applicantID = $data->userID;

            $sql = "SELECT givenName, familyName, userID FROM systemuser WHERE userID='$applicantID' ";
            $applicantObject = $mysqli->query($sql); 
            $applicantResult = $applicantObject->fetch_object();

            $applicantGivenName = $applicantResult->givenName;
            $applicantFamilyName = $applicantResult->familyName;
            $applicantID = $applicantResult->userID;

            $preferencesTable .= <<<TABLE
                <tr>
                    <td><a href="profile.php?givenName={$applicantGivenName}&applicantID={$applicantID}&unitCode={$unitCode}">{$applicantGivenName}&nbsp{$applicantFamilyName}</a></td>
                    <td><a href="class_preferences_view.php?givenName={$applicantGivenName}&applicantID={$applicantID}&unitCode={$unitCode}">Preference</a></td>

                </tr>
TABLE;  
        }

        $tableHeader = '<tr>
        <th>Applicant</th>
        <th>Preferences</th>
        </tr>';

        if ($num_applicants==0) {
            echo '<p>There are no applications<p>';
            echo "<button class='btn butt_out' href='units_staff_view.php?unitCode={$unitCode}'>Back</button>";
        

        } else {
            echo <<<TABLE
            <table>
                <thead>
                    {$tableHeader}
                </thead>
                <tbody>
                    {$preferencesTable}
                </tbody>
            </table>
TABLE;
        }    
        
    ?>
                </div>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script> 
</body>
</html>
