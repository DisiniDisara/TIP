<!-- HTML to show avaialble units, to view and edit preferences -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Available Units</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script> 
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
<div class="container mx-auto my-5">
    <h3 class="text-center">Available Units</h3>
    <form>

    </form>
</div>
<?php
    require 'connections.php';
    
    $sql = "SELECT * FROM unit";
    
    $results = $mysqli->query($sql);
    // Checks if results is empty
    if (!$results) {
        echo "Error: Our query failed to execute and here is why: " . PHP_EOL;
        echo "Query: " . $sql . PHP_EOL;
        echo "Errno: " . $mysqli->errno . PHP_EOL;
        echo "Error: " . $mysqli->error . PHP_EOL;
        exit;
    } else { 
        // Have results to show...
        $row = 0;
        $availableUnits = '';
        
        // Goes through each row from query results and append to TABLE
        while ($data = $results->fetch_object()) {
            // Adding class to each row
            $classes = ($row++ % 2 == 0) ? 'even' : 'odd';
            
            // Store table of results as Table that gets appended one row at a time through the loop
            if (isset($_SESSION['isLoggedIn']) and $_SESSION['isLoggedIn']===true) { 
                // Show Add, View, Edit preference option only if user is loggedin
                $applicantID = $_SESSION['applicantID'];
                $unitCode = $data->unitCode;
                $sql = "SELECT * FROM preferences WHERE unitCode='$unitCode' and applicantID='$applicantID' ";
    
                $classResults = $mysqli->query($sql);
                if ($classResults->num_rows == 0){
                    $availableUnits .= <<<EOD
                    <div class="row">
                        <div class="col-md-12 col-lg-12 mb-5">
                            <div class="card">
                                <div class="card-body">
                                <h5 class="card-title">{$data->unitCode}</h5>
                                <h6 class="card-subtitle mb-2 text-muted"> <a href="class_sessions.php?unitCode={$data->unitCode}">{$data->unitName}</a> <br/> 
                                <a href="class_preferences_edit.php?applicantID={$applicantID}&unitCode={$data->unitCode}&edit=0">Add</a></h6>
                                <p class="card-text">Job Description </p>
                                </div>
                            <div class="card-footer">
                                <small class="text-muted"> courseCode </small>
                            </div>
                            </div>
                        </div>
                    </div>
EOD;
                } else {
                    $availableUnits .= <<<EOD
                    <div class="row">
                        <div class="col-md-12 col-lg-12 mb-5">
                            <div class="card">
                                <div class="card-body">
                                <h5 class="card-title">{$data->unitCode}</h5>
                                <h6 class="card-subtitle mb-2 text-muted"> <a href="class_sessions.php?unitCode={$data->unitCode}">{$data->unitName}</a> <br/>
                                <a href="class_preferences_edit.php?applicantID={$applicantID}&unitCode={$data->unitCode}&edit=0">Add</a></h6>
                                <p class="card-text">Job Description </p>
                                </div>
                            <div class="card-footer">
                                <small class="text-muted"> courseCode </small>
                            </div>
                            </div>
                        </div>
                    </div>
EOD;
                };
                
            } else {
                // Show only list of units available for public
                $availableUnits .= <<<EOD
                <div class="row">
                        <div class="col-md-12 col-lg-12 mb-5">
                            <div class="card">
                                <div class="card-body mycard">
                                <h5 class="card-title">{$data->unitCode}</h5>
                                <h6 class="card-subtitle mb-2 text-muted"> <a href="class_sessions.php?unitCode={$data->unitCode}">{$data->unitName}</a> <br/>
                                <a href="class_preferences_edit.php?applicantID={$applicantID}&unitCode={$data->unitCode}&edit=0">Add</a></h6>
                                <p class="card-text">Job Description </p>
                                </div>
                            <div class="card-footer">
                                <small class="text-muted"> Course Code: {$data->courseCode} </small>
                            </div>
                            </div>
                        </div>
                    </div>
EOD;
            };
            
        };
        
        if (isset($_SESSION['isLoggedIn']) and $_SESSION['isLoggedIn']===true) { 
            // PHP dynamically generate table of available units with preferences for logged in user
            echo <<<EOD
            <div class="container">
                {$availableUnits}
            </div>
    EOD;
        } else {
            // PHP dynamically generate table of available units without preferences for public users
            echo <<<EOD
                <div class="container">
                    {$availableUnits}
                </div>
            
    EOD;
        } 

        // Clear resuls and close database
        $results->free();
        $mysqli->close();
    }
include "footer.inc";
?>

</body>
</html>
