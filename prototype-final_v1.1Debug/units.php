<!-- HTML to show avaialble units, to view and edit preferences -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="style/unit.css">

    <title>Available Units</title>
    <?php
        session_start();
    ?>
</head>
<body>
<?php
    // Include the file containing the generateNav() function
    include 'generateNav.php';

    // Generate the navigation menu
    $nav = generateNav();
    echo $nav;
?>
<?php
    require 'connections.php';
    require_once('utilities.php');

    // Get units available
    $sql = "SELECT * FROM unit WHERE vacancyStatus='true' ";

    $results = $mysqli->query($sql);
    // Checks if results is empty
    if (!$results) {
        echo "Error: Our query failed to execute and here is why: " . PHP_EOL;
        echo "Query: " . $sql . PHP_EOL;
        echo "Errno: " . $mysqli->errno . PHP_EOL;
        echo "Error: " . $mysqli->error . PHP_EOL;
        exit;
    } else { // Have results to show...
        $row = 0;
        $availableUnits = '';
        
        // Goes through each row from query results and append to TABLE
        while ($data = $results->fetch_object()) {
            // Adding class to each row
            $classes = ($row++ % 2 == 0) ? 'even' : 'odd';
            
            // Store table of results as Table that gets appended one row at a time through the loop
            if (isset($_SESSION['isLoggedIn']) and $_SESSION['isLoggedIn']===true) { 
                // Show Add, View, Edit preference option only if user is loggedin
                $applicantID = $_SESSION['userID'];
                $unitCode = $data->unitCode;
                $sql = "SELECT * FROM preferences WHERE unitCode='$unitCode' and userID='$applicantID' ";
    
                $classResults = $mysqli->query($sql);

                if ($classResults->num_rows == 0){
                    $availableUnits .= <<<EOD
                    
                    <div class="col-md-12">
                        <div class="card myCard">
                        <div class="card-body">
                            <h5 class="card-title"><a href="unit_details.php?unitCode={$data->unitCode}">{$data->unitName}</a></h5>
                            <p class="card-text">{$data->unit_description}</p>
                            <a href="class_preferences_edit.php?applicantID={$applicantID}&unitCode={$data->unitCode}&edit=0" class="btn butt_out">Select Unit</a>
                        </div>
                        </div>
                    </div>
                    
EOD;
                } else {
                    $availableUnits .= <<<EOD
                    
                    <div class="col-md-12 {$classes}">
                        <div class="card myCard">
                        <div class="card-body">

                        <h5 class="card-title"><a href="unit_details.php?unitCode={$data->unitCode}">{$data->unitName}</a></h5>
                            <p class="card-text">{$data->unit_description}</p>
                            <a href="class_preferences_view.php?applicantID={$applicantID}&unitCode={$unitCode}&view=1" class="btn butt_out">View</a>
                        </div>
                        </div>
                    </div>
EOD;
                };
                
            } else {
                // Show only list of units available for public
                $availableUnits .= <<<EOD
                <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><a href="unit_details.php?unitCode={$data->unitCode}">{$data->unitName}</a></h5>
                        <p class="card-text">{$data->unit_description}</p>
                    </div>
                    </div>
                </div>
                </div>
EOD;
            };
            
        };
        
        if (isset($_SESSION['isLoggedIn']) and $_SESSION['isLoggedIn']===true) { 
            // PHP dynamically generate table of available units with preferences for logged in user
            if (isset($_SESSION['userRole']) and $_SESSION['userRole']==='staff'){
                // Display edit unit buttons to staffs only
                $staffEdit .= <<<EOD
            <button class="btn butt_out" onclick="window.location.href='units_edit.php' ">Edit Units</button>
EOD;
            }
            echo <<<EOD
            <div class="container mt-5">
            <div class="container-fluid d-flex justify-content-center">
            <h3 class="text-center mb-5">Available Units</h3>
            </div>

                {$availableUnits}
                <div class="container-fluid d-flex justify-content-center">
                {$staffEdit}
                </div>
            </div>
EOD;


        } else {
            // PHP dynamically generate table of available units without preferences for public users
            echo <<<EOD
            <div class="container mt-auto">
            <div class="container-fluid d-flex justify-content-center">
            <h3 class="text-center mb-5">Available Units</h3>
            </div>
                    {$availableUnits}
                </div>
    EOD;
        }

        // Clear resuls and close database
        $results->free();
        $mysqli->close();
    }
    
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script> 

</body>
</html>
