<!--Edit Class Preference -->
<?php
session_start();
require_once('utilities.php');
isLoggedIn();
require 'connections.php';

// Insert submitted preference form to db.
process_applicant_preferences();
?>

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
        $unitCode = $_REQUEST['unitCode'];
        $applicantID = $_SESSION['userID'];
        echo <<<EOD
        <title>Class Preferences for {$unitCode}</title>             
EOD;
    ?>
</head>
<body>
    <?php
    // Include the file containing the generateNav() function
    include 'generateNav.php';
    require_once('generateTimeTable.php');
    
    // Generate the navigation menu
    $nav = generateNav();
    echo $nav;
    ?>

    <?php
        require 'connections.php';

        // Get the unit code from the URL parameters
        $unitCode = $_REQUEST['unitCode'];
        $applicantID = $_SESSION['userID'];

        // Query the database to get the class sessions for the unit
        $sql = "SELECT * FROM class WHERE unitCode = '$unitCode' ";
        $class_sessions_results = $mysqli->query($sql);

        if (!$class_sessions_results) {
            echo "Error: Our query failed to execute and here is why: " . PHP_EOL;
            echo "Query: " . $sql . PHP_EOL;
            echo "Errno: " . $mysqli->errno . PHP_EOL;
            echo "Error: " . $mysqli->error . PHP_EOL;
            exit;
        } else {
            $classPreferences = '';

            // To-Do: Check if user has preference and fill in form, else show empty form
                $idx = 0;
                while ($data = $class_sessions_results->fetch_object()) {
                    // For table positioning
                    $classCode = $data->classCode;

                    // Get the preference for this class session
                    $sql = "SELECT * FROM preferences WHERE preferences.classCode = '$classCode' and preferences.userID = '$applicantID' ";
                    $preferences_results = $mysqli->query($sql);
                    $prefLevel = '';
                    if ($preferences_results->num_rows > 0) {
                        $prefLevel = $preferences_results->fetch_object()->prefLevel;
                    }
                    
                    $idx++;
                    $classPreferences .= <<<TABLE
                        <tr class="preferences">
                            <td>{$data->classCode}</td>
                            <td><input type="number" name="preferences[]" value="{$prefLevel}"/></td>
                            <td>
                                <input type="hidden" name="unitCode" value="{$unitCode}" />
                                <input type="hidden" name="classCode[]" value="{$classCode}" />
                            </td>
                        </tr>
TABLE;

                }
        } 
    
        // Creating timetable view of class sessions
        $query = "SELECT * FROM class WHERE unitCode='$unitCode'";
        $result = $mysqli->query($query);

        $query2 = "SELECT classCode as class FROM class";
        $result2 = $mysqli->query($query2);

        $TIMETABLE = generatePrefClassTable($applicantID, $result, $result2, $edit=true, $mainColor='lightblue');

    ?>
    <?php
    // Display message if passwords entered dont match
    if (isset($_GET['error']) && $_GET['error'] == 1) {
        echo '<p style="color:red;">Invalid preferences. Try again.</p>';
    }

    if (isset($_GET['empty']) && $_GET['empty'] == 1) {
        echo '<p style="color:red;">No preferences added.</p>';
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?submit=1&applicantID=<?php echo $applicantID;?>&edit=0" method="post">
        <h3>Add Class Preferences for <?php echo $unitCode;?></h3>
        <?php echo $TIMETABLE;?>
            <button type="submit">Submit</button>
            <input type="hidden" name="unitCode" value="<?php echo $unitCode; ?>" />
    </form>
    <button onclick="window.location.href='units.php' ">Cancel</button>
    <button onclick="window.location.href='clear_preferences.php?applicantID=<?php echo $applicantID;?>&unitCode=<?php echo $unitCode;?>' ">Clear All</button>
</body>
</html>
