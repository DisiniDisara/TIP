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

    <title>Units</title>
    <?php
        session_start();
        require_once('utilities.php');
        isLoggedIn();
        isStaff();
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
        $table = '';
        
        // Goes through each row from query results and append to TABLE
        while ($data = $results->fetch_object()) {
            // Get number of applicants applied to this unit
            $unitCode = $data->unitCode;
            $unitName = $data->unitName;

            // Grab applicant preference for this unit
            $sql = "SELECT DISTINCT userID, unitCode FROM preferences WHERE unitCode='$unitCode' ";
            $result_object = $mysqli->query($sql);

            // Get num of rows in result object
            $n_applicants= $result_object->num_rows;

            // Adding class info to each row of table
            $table .= <<<TABLE
            <tr class="classes">
                <td>{$unitCode}</td>
                <td><a href="class_sessions.php?unitCode={$unitCode}">{$unitName}</a></td>
                <td style='text-align: center;'><a href="class_sessions_staff_edit.php?unitCode={$unitCode}">Edit</a></td>
                <td style='text-align: center;'><a href="">Remove</a></td>
                <td style='text-align: right;'><a href="class_preferences_staff_view.php?unitCode={$unitCode}"><strong>  $n_applicants</strong></a></td>
            </tr>
TABLE;
        };        
    };
        
    // PHP dynamically generate table of available units 
    echo <<<EOD
    <h3>Available Units</h3>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Edit</th>
                <th>Remove</th>
                <th>Applications</th>
            </tr>
        </thead>
        <tbody>
            {$table}
        </tbody>
    </table>
EOD;
    
    // Clear resuls and close database
    $results->free();
    $mysqli->close();

?>
    
</body>
</html>
