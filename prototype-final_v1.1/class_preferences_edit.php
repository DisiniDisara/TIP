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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style/class_sessions.css">

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
                        <tr class="preferences table">
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

    <div class="container my-5">
        <div class="d-flex align-items-center align-self-center">
            <div class="container-fluid d-flex justify-content-center">
                <div class="card p-4 border-light">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?submit=1&applicantID=<?php echo $applicantID;?>&edit=0" method="post">
                            <h3 class="text-center mb-5">Add Class Preferences for <?php echo $unitCode;?></h3>
                            <?php echo $TIMETABLE;?>

                            <div class="container-fluid d-flex justify-content-center">                                
                                <button class="btn butt_out m-2" type="submit">Submit</button>
                                <input type="hidden" name="unitCode" value="<?php echo $unitCode; ?>" />
                                <button class="btn butt_out m-2" onclick="window.location.href='units.php' ">Cancel</button>
                                <button class="btn butt_out m-2" onclick="window.location.href='clear_preferences.php?applicantID=<?php echo $applicantID;?>&unitCode=<?php echo $unitCode;?>' ">Clear All</button>
                            </div>
                        </form>
                        <?php
    // Display message if passwords entered dont match
    if (isset($_GET['error']) && $_GET['error'] == 1) {
        echo '<p style="color:red;">Invalid preferences. Try again.</p>';
    }

    if (isset($_GET['empty']) && $_GET['empty'] == 1) {
        echo '<p style="color:red;">No preferences added.</p>';
    }
    ?>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script> 
</body>
</html>
