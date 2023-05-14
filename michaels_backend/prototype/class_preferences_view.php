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

    <h3>Class Preferences View</h3>

    <?php
        require 'connections.php';

        // Get the unit code and applicant ID from the URL parameters
        $unitCode = $_GET['unitCode'];
        $applicantID = $_GET['applicantID'];
        
        $sql = "SELECT givenName, familyName FROM systemUser WHERE userID='$applicantID'";
        $object = $mysqli->query($sql);
        $result = $object->fetch_object();
        $givenName = $result->givenName;
        $familyName = $result->familyName;

        // Query the database to get the preferences for the applicant and unit
        $sql = "SELECT * FROM class WHERE unitCode = '$unitCode'";
        $classSessions = $mysqli->query($sql);

        $preferencesTable = '';

        while ($data = $classSessions->fetch_object()) {
            $class = $data->classCode;
            // Query the database to get the preferences for the particular class
            $sql = "SELECT * FROM preferences WHERE classCode = '$class' AND userID = '$applicantID' ";

            $preferences_results = $mysqli->query($sql);
            $prefLevel = "";
            if ($preferences_results->num_rows > 0){
                $preference_row = $preferences_results->fetch_object();
                $prefLevel = $preference_row->prefLevel;  
            }

            $preferencesTable .= <<<HTML
                <tr>
                    <td>{$data->unitCode}</td>
                    <td>{$data->classCode}</td>
                    <td>{$data->classStartTime}-{$data->classEndTime}</td>
                    <td style='text-align: right;'><strong>{$prefLevel}</strong></td>
                </tr>
HTML;
            
        }

        echo <<<TABLE
            <p>Class preferences for applicant {$givenName} {$familyName} {$applicantID} in unit {$unitCode}:</p>
            <table>
                <thead>
                    <tr>
                        <th>Unit</th>
                        <th>Class Code</th>
                        <th>Time slot</th>
                        <th>Preference</th>
                    </tr>
                </thead>
                <tbody>
                    {$preferencesTable}
                </tbody>
            </table>
        <?php?>
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
