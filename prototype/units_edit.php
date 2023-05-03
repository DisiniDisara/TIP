<!-- HTML to show avaialble units, to view and edit preferences -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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

                $availableUnits .= <<<TABLE
                <tr class="availableClass">
                    <td>{$data->unitCode}</td>
                    <td><a href="class_sessions.php?unitCode={$data->unitCode}">{$data->unitName}</a></td>
                    <td><a href="class_sessions_staff_edit.php?unitCode={$data->unitCode}">Edit Classes</a></td>
                </tr>
TABLE;
            }
        };
    }
        
    // PHP dynamically generate table of available units 
    echo <<<EOD
    <h3>Available Units</h3>
    <p>Add, edit, remove available units</p>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            {$availableUnits}
        </tbody>
    </table>
EOD;
        
    // Clear resuls and close database
    $results->free();
    $mysqli->close();

?>
    
</body>
</html>
