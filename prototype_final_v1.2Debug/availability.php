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
    $userID = $_SESSION['userID'];
    
    echo <<<EOD
        <title>{$userID} Availability Submission & Details</title>             
EOD;
    ?>
</head>

<body>
    <?php
    // Include the file containing the generateNav() function
    include 'generateNav.php';
    require 'generateTimeTable.php';
    require 'utilities.php';
    require_once 'connections.php';
    // Generate the navigation menu
    $nav = generateNav();
    echo $nav;
    //echo $userID;

    // Variables for Form
    $mon = "Monday";
    $tues = "Tuesday";
    $wed = "Wednesday";
    $thurs = "Thursday";
    $fri = "Friday";
    $start = "Start";
    $end = "End";
    $avail = "Avail";

    if (isset($_POST["submit"])) {
        if (isset($_POST["MondayStart"])) {
            $monStart = $_POST["MondayStart"];
            if (isset($_POST["MondayEnd"])) {
                $monEnd = $_POST["MondayEnd"];
                if (isset($_POST["MondayAvail"])) {
                    $monAvail = $_POST["MondayAvail"];
                    $insert = "INSERT INTO availability (userID, a_day, a_startTime, a_endTime, availabilityType) VALUES ('$userID', '$mon', '$monStart', '$monEnd', '$monAvail')";
                    $update = "UPDATE availability SET userID = '$userID', a_day ='$mon', a_startTime = '$monStart', a_endTime = '$monEnd', availabilityType = '$monAvail' WHERE userID = '$userID' AND a_day = '$mon'";
                    $check = "SELECT userID, a_day FROM availability WHERE userID='$userID' AND a_day ='$mon'";
                    $result = $mysqli->query($check);
                    if ($result->num_rows == 1) {
                        $mysqli->query($update);
                    }
                    if ($result->num_rows == 0) {
                        $mysqli->query($insert);
                    }
                }
            }
        }
        if (isset($_POST["TuesdayStart"])) {
            $tuesStart = $_POST["TuesdayStart"];
            if (isset($_POST["TuesdayEnd"])) {
                $tuesEnd = $_POST["TuesdayEnd"];
                if (isset($_POST["TuesdayAvail"])) {
                    $tuesAvail = $_POST["TuesdayAvail"];
                    $insert = "INSERT INTO availability (userID, a_day, a_startTime, a_endTime, availabilityType) VALUES ('$userID', '$tues', '$tuesStart', '$tuesEnd', '$tuesAvail')";
                    $update = "UPDATE availability SET userID = '$userID', a_day ='$tues', a_startTime = '$tuesStart', a_endTime = '$tuesEnd', availabilityType = '$tuesAvail' WHERE userID = '$userID' AND a_day = '$tues'";
                    $check = "SELECT userID, a_day FROM availability WHERE userID='$userID' AND a_day ='$tues'";
                    $result = $mysqli->query($check);
                    if ($result->num_rows == 1) {
                        $mysqli->query($update);
                    }
                    if ($result->num_rows == 0) {
                        $mysqli->query($insert);
                    }
                }
            }
        }
        if (isset($_POST["WednesdayStart"])) {
            $wedStart = $_POST["WednesdayStart"];
            if (isset($_POST["WednesdayEnd"])) {
                $wedEnd = $_POST["WednesdayEnd"];
                if (isset($_POST["WednesdayAvail"])) {
                    $wedAvail = $_POST["WednesdayAvail"];
                    $insert = "INSERT INTO availability (userID, a_day, a_startTime, a_endTime, availabilityType) VALUES ('$userID', '$wed', '$monStart', '$wedEnd', '$wedAvail')";
                    $update = "UPDATE availability SET userID = '$userID', a_day ='$wed', a_startTime = '$wedStart', a_endTime = '$wedEnd', availabilityType = '$wedAvail' WHERE userID = '$userID' AND a_day = '$wed'";
                    $check = "SELECT userID, a_day FROM availability WHERE userID='$userID' AND a_day ='$wed'";
                    $result = $mysqli->query($check);
                    if ($result->num_rows == 1) {
                        $mysqli->query($update);
                    }
                    if ($result->num_rows == 0) {
                        $mysqli->query($insert);
                    }
                }
            }
        }
        if (isset($_POST["ThursdayStart"])) {
            $thursStart = $_POST["ThursdayStart"];
            if (isset($_POST["ThursdayEnd"])) {
                $thursEnd = $_POST["ThursdayEnd"];
                if (isset($_POST["ThursdayAvail"])) {
                    $thursAvail = $_POST["ThursdayAvail"];
                    $insert = "INSERT INTO availability (userID, a_day, a_startTime, a_endTime, availabilityType) VALUES ('$userID', '$thurs', '$thursStart', '$thursEnd', '$thursAvail')";
                    $update = "UPDATE availability SET userID = '$userID', a_day ='$thurs', a_startTime = '$thursStart', a_endTime = '$thursEnd', availabilityType = '$thursAvail' WHERE userID = '$userID' AND a_day = '$thurs'";
                    $check = "SELECT userID, a_day FROM availability WHERE userID='$userID' AND a_day ='$thurs'";
                    $result = $mysqli->query($check);
                    if ($result->num_rows == 1) {
                        $mysqli->query($update);
                    }
                    if ($result->num_rows == 0) {
                        $mysqli->query($insert);
                    }
                }
            }
        }
        if (isset($_POST["FridayStart"])) {
            $friStart = $_POST["FridayStart"];
            if (isset($_POST["FridayEnd"])) {
                $friEnd = $_POST["FridayEnd"];
                if (isset($_POST["FridayAvail"])) {
                    $friAvail = $_POST["FridayAvail"];
                    $insert = "INSERT INTO availability (userID, a_day, a_startTime, a_endTime, availabilityType) VALUES ('$userID', '$fri', '$friStart', '$friEnd', '$friAvail')";
                    $update = "UPDATE availability SET userID = '$userID', a_day ='$fri', a_startTime = '$friStart', a_endTime = '$friEnd', availabilityType = '$friAvail' WHERE userID = '$userID' AND a_day = '$fri'";
                    $check = "SELECT userID, a_day FROM availability WHERE userID='$userID' AND a_day ='$fri'";
                    $result = $mysqli->query($check);
                    if ($result->num_rows == 1) {
                        $mysqli->query($update);
                    }
                    if ($result->num_rows == 0) {
                        $mysqli->query($insert);
                    }
                }
            }
        }
    }

    // Availability Query
    $userAvailQuery = "SELECT * FROM availability WHERE userID = '$userID'";
    $userAvailType = "SELECT availabilityType FROM availability WHERE userID='$userID'";
    
    $result1 = $mysqli->query($userAvailQuery);
    $result2 = $mysqli->query($userAvailType);
    if ($result1->num_rows > 0) {
        $timetable = generateAvailabilityTable($userID, $result1, $result2);
        echo <<< EOD
        <div class="container my-5">
            <div class="d-flex align-items-center align-self-center">
                <div class="container-fluid d-flex justify-content-center">
                    <div class="card p-4 border-light">
                    $timetable
                    </div>
                </div>
            </div>
        </div>
            
EOD;
    }
    ?>

<div class="container my-5">
    <div class="d-flex align-items-center align-self-center">
        <div class="container-fluid d-flex justify-content-center">
            <div class="card p-4 border-light">
                <h3 class="text-center mb-3">Please Enter Your Availability</h3>    
                    <form method="post" action="availability.php">
                    <table class="table">
                        <tbody>

                        <tr scope="row">
                            <td>Monday Start Time:
                            <?php generateDropDownTimes($mon, $start) ?>
                            <td>End Time:
                            <?php generateDropDownTimes($mon, $end) ?></td>
                            <td>Type:
                            <?php generateAvailType($mon, $avail) ?></td>
                        </tr>
                        <tr scope="row">
                            <td>Tuesday Start Time:
                            <?php generateDropDownTimes($tues, $start) ?></td>
                            <td>End Time:
                            <?php generateDropDownTimes($tues, $end) ?></td>
                            <td>Type:
                            <?php generateAvailType($tues, $avail) ?></td>
                        </tr>
                        <tr scope="row">
                            <td>Wednesday Start Time:
                            <?php generateDropDownTimes($wed, $start) ?></td>
                            <td>End Time:
                            <?php generateDropDownTimes($wed, $end) ?></td>
                            <td>Type:
                            <?php generateAvailType($wed, $avail) ?></td>                        
                        </tr>
                        <tr scope="row">
                            <td>Thursday Start Time:
                            <?php generateDropDownTimes($thurs, $start) ?></td>
                            <td>End Time:
                            <?php generateDropDownTimes($thurs, $end) ?></td>
                            <td>Type:
                            <?php generateAvailType($thurs, $avail) ?></td>
                        </tr>
                        <tr scope="row">
                            <td>Friday Start Time:
                            <?php generateDropDownTimes($fri, $start) ?></td>
                            <td>End Time:
                            <?php generateDropDownTimes($fri, $end) ?></td>
                            <td>Type:
                            <?php generateAvailType($fri, $avail) ?></td>
                        </tr>
                        </tbody>
                    </table>
                        <input type="submit"  name="submit" value="Submit"></input>
                    </form>
            </div>
        </div>
    </div>
</div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script> 

</body>

</html>