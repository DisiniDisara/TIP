<!-- HTML to show avaialble units, to view and edit preferences -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Available Units</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
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
    
    $sql = "SELECT * FROM unit";
    
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
                $applicantID = $_SESSION['applicantID'];
                $unitCode = $data->unitCode;
                $sql = "SELECT * FROM preferences WHERE unitCode='$unitCode' and applicantID='$applicantID' ";
    
                $classResults = $mysqli->query($sql);
                if ($classResults->num_rows == 0){
                    $availableUnits .= <<<TABLE
                    <tr class="{$classes}">
                        <td>{$data->unitCode}</td>
                        <td><a href="class_sessions.php?unitCode={$data->unitCode}">{$data->unitName}</a></td>
                        <td><a href="class_preferences_edit.php?applicantID={$applicantID}&unitCode={$data->unitCode}&edit=0">Add</a></td>
                    </tr>
TABLE;
                } else {
                    $availableUnits .= <<<TABLE
                    <tr class="{$classes}">
                        <td>{$data->unitCode}</td>
                        <td><a href="class_sessions.php?unitCode={$data->unitCode}">{$data->unitName}</a></td>
                        <td><a href="class_preferences_view.php?applicantID={$applicantID}&unitCode={$unitCode}&view=1">View</a></td>
                    </tr>
TABLE;
                };
                
            } else {
                // Show only list of units available for public
                $availableUnits .= <<<TABLE
                <tr class="{$classes}">
                    <td>{$data->unitCode}</td>
                    <td><a href="class_sessions.php?unitCode={$data->unitCode}">{$data->unitName}</a></td>
                </tr>
TABLE;
            };
            
        };
        
        if (isset($_SESSION['isLoggedIn']) and $_SESSION['isLoggedIn']===true) { 
            // PHP dynamically generate table of available units with preferences for logged in user
            echo <<<EOD
            <h3>Available Units</h3>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Preferences</th>
                    </tr>
                </thead>
                <tbody>
                    {$availableUnits}
                </tbody>
            </table>
    EOD;
        } else {
            // PHP dynamically generate table of available units without preferences for public users
            echo <<<EOD
            <h3>Available Units</h3>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    {$availableUnits}
                </tbody>
            </table>
    EOD;
        }

        // Clear resuls and close database
        $results->free();
        $mysqli->close();
    }
    
?>
    
</body>
</html>
