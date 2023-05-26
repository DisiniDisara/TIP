<?php
    require 'connections.php';
    require_once('generateTimeTable.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the form data
        $allocation = $_POST['allocation'];
        $class_codes = $_POST['classCode'];

        $idx = 0;
        foreach ($allocation as $value) {
            $classCode = $class_codes[$idx];
            if ($value=='NULL') {
                $sql = "UPDATE class SET userID=NULL WHERE classCode='$classCode' ";
            } else {
                $sql = "UPDATE class SET userID='$value' WHERE classCode='$classCode' ";
            }

            $result = $mysqli->prepare($sql);
            $result->execute();    
            $idx += 1;
        }
    }

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
        session_start();
        require_once('utilities.php');
        isLoggedIn();
        $unitCode = $_GET['unitCode'];
        echo "<title>$unitCode Allocate Classes</title>";

    ?>
</head>
<body>
    <?php
    include 'generateNav.php';
    $nav = generateNav();
    echo $nav;
    ?>
    <?php
        // Get the unit code and applicant ID from the URL parameters
        $unitCode = $_GET['unitCode'];
        
        // Query the database to get the preferences for the applicant and unit
        $sql = "SELECT * FROM class WHERE unitCode = '$unitCode'";
        $classes_details = $mysqli->query($sql);

        $sql = "SELECT classCode as class FROM class WHERE unitCode = '$unitCode'";
        $classCodes = $mysqli->query($sql);

        $allocationTable = generateAllocationTable($unitCode, $classes_details, $classCodes, $edit=true, $mainColor='lightblue');

        echo <<<HTML
        <div class="container my-5">
            <div class="d-flex align-items-center align-self-center">
                <div class="container-fluid d-flex justify-content-center">
                    <div class="card p-4 border-light">
                        <h3 class="text-center">Allocate applicants to $unitCode</h3>
                        <form action='{$_SERVER["PHP_SELF"]}?unitCode={$unitCode}' method='post'>
                            $allocationTable
                            <button class="btn butt_out m-2" type='submit'>Submit</button>
                            <a class="btn butt_out m-2" href='units_staff_view.php'>Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
HTML;

    ?>




</body>
</html>
