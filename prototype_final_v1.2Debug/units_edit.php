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
        require_once('utilities.php');
        isStaff();
    ?>
</head>
<body>
<?php
    include 'generateNav.php';
    // Generate the navigation menu
    $nav = generateNav();
    echo $nav;
?>
<?php
    require 'connections.php';

    $sql = "SELECT * FROM unit WHERE vacancyStatus='true' ";
    
    // grab all units available

    $results = $mysqli->query($sql);
    // Checks if results is empty
    if (!$results) {
        echo "Error: Our query failed to execute and here is why: " . PHP_EOL;
        echo "Query: " . $sql . PHP_EOL;
        echo "Errno: " . $mysqli->errno . PHP_EOL;
        echo "Error: " . $mysqli->error . PHP_EOL;
        exit;
    } else { // Have results to show...

        $availableUnits = '';

        while ($data = $results->fetch_object()) {
            if (isLoggedIn() and isStaff()) { 

                $availableUnits .= <<<EOD
                <div class="col-md-12">
                <div class="card myCard">
                <div class="card-body">
                    <h5 class="card-title"><a href="class_sessions.php?unitCode={$data->unitCode}">{$data->unitName}</a></h5>
                    <p class="card-text">{$data->unit_description}</p>
                    <a href="class_sessions_staff_edit.php?unitCode={$data->unitCode}" class="btn butt_out">Edit Classes</a>
                </div>
                </div>
            </div>
EOD;
            }
        };
    }
        
    // PHP dynamically generate table of available units 
    echo <<<EOD
    <div class="container mt-5">
    <div class="container-fluid d-flex justify-content-center">
    <h3 class="text-center mb-5">Available Units</h3>
    </div>
            {$availableUnits}
    </div>
EOD;
        
    // Clear resuls and close database
    $results->free();
    $mysqli->close();

?>
    
</body>
</html>
