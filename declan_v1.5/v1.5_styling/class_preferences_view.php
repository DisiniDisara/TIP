<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script> 
    <title>Class Preferences View</title>
</head>
<body>
    <?php
    session_start();
    // Include the file containing the generateNav() function
    include 'generateNav.php';

    // Generate the navigation menu
    $nav = generateNav();
    echo $nav;
    ?>
<div class="container mx-auto my-5">
    <h3 class="text-center">Class Preferences View</h3>
</div>
<div class="d-flex align-items-center align-self-center" style="height: 20em;">
    <div class="container-fluid d-flex justify-content-center">
<div class="card p-4 border-secondary">
    <?php
        require 'connections.php';

        // Get the unit code and applicant ID from the URL parameters
        $unitCode = $_GET['unitCode'];
        $applicantID = $_SESSION['applicantID'];

        // Query the database to get the preferences for the applicant and unit
        $sql = "SELECT * FROM preferences WHERE unitCode = '$unitCode' AND applicantID = '$applicantID'";
        $preferences_results = $mysqli->query($sql);

        if (!$preferences_results) {
            echo "Error: Our query failed to execute and here is why: " . PHP_EOL;
            echo "Query: " . $sql . PHP_EOL;
            echo "Errno: " . $mysqli->errno . PHP_EOL;
            echo "Error: " . $mysqli->error . PHP_EOL;
            exit;
        } else {
            $preferencesTable = '';

            while ($data = $preferences_results->fetch_object()) {
                $preferencesTable .= <<<TABLE
                    <tr>
                        <td>{$data->unitCode}</td>
                        <td>{$data->classCode}</td>
                        <td>{$data->prefLevel}</td>
                    </tr>
TABLE;
            }

            if ($preferences_results->num_rows > 0) {
                echo <<<EOD
                    <p>Class preferences for applicant {$applicantID} in unit {$unitCode}:</p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Unit</th>
                                <th>Class Code</th>
                                <th>Preference</th>
                            </tr>
                        </thead>
                        <tbody>
                            {$preferencesTable}
                        </tbody>
                    </table>
                    <form action="class_preferences_edit.php?applicantID={$applicantID}&unitCode={$unitCode}&edit=1" method="post">
                        <button type="submit" class="btn btn-secondary">Edit Preferences</button>
                    </form>
                    <form action="units2.php" method="">
                        <button type="submit" class="btn btn-secondary">Units</button>
                    </form>
EOD;
            } else {
                echo "No preferences found for applicant {$applicantID} in unit {$unitCode}.";
            }
        }
    ?>
    </div>
    </div>
    </div>
<?php include "footer.inc"?>
</body>
</html>
