<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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


    <?php
        echo "<h3>$unitCode Applicant Class Preferences</h3>";

        require 'connections.php';

        // Get the unit code and applicant ID from the URL parameters
        $unitCode = $_GET['unitCode'];
        
        // Query the database to get the preferences for the applicant and unit
        $sql = "SELECT DISTINCT applicantID FROM preferences WHERE unitCode = '$unitCode'";
        $applicants = $mysqli->query($sql);
        $num_applicants = $applicants->num_rows;

        $preferencesTable = '';

        while ($data = $applicants->fetch_object()) {
            $applicantID = $data->applicantID;

            $sql = "SELECT givenName, familyName, applicantID FROM applicant where applicantID='$applicantID'";
            $applicantObject = $mysqli->query($sql); 
            $applicantResult = $applicantObject->fetch_object();

            $applicantGivenName = $applicantResult->givenName;
            $applicantFamilyName = $applicantResult->familyName;
            $applicantID = $applicantResult->applicantID;

            $preferencesTable .= <<<TABLE
                <tr>
                    <td><a href="profile.php?givenName={$applicantGivenName}&applicantID={$applicantID}&unitCode={$unitCode}">{$applicantGivenName}&nbsp{$applicantFamilyName}</a></td>
                    <td><a href="class_preferences_view.php?givenName={$applicantGivenName}&applicantID={$applicantID}&unitCode={$unitCode}">preference</a></td>

                </tr>
TABLE;  
        }

        $tableHeader = '<tr>
        <th>Applicant</th>
        <th>Preferences</th>
        </tr>';

        if ($num_applicants==0) {
            echo '<p>There are no applications<p>';
            echo "<button><a href='units_staff_view.php?unitCode={$unitCode}'>back<a/></button>";
        

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
</body>
</html>
