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
        session_start();
        $unitCode = $_GET['unitCode'];
        echo <<<EOD
        <title>{$unitCode} Details</title>             
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
        $unitCode = $_GET['unitCode'];

        // Query the database to get the class sessions for the unit
        $sql = "SELECT * FROM class WHERE unitCode = '$unitCode'";

        $results = $mysqli->query($sql);
        // $row = $results->fetch_object();

        $sqlUnitName = "SELECT * FROM unit WHERE unitCode = '$unitCode'";
        
        $resultsUnitName = $mysqli->query($sqlUnitName);
        $row = $resultsUnitName->fetch_object();
        $unitName = $row->unitName;

        if (!$results) {
            echo "Error: Our query failed to execute and here is why: " . PHP_EOL;
            echo "Query: " . $sql . PHP_EOL;
            echo "Errno: " . $mysqli->errno . PHP_EOL;
            echo "Error: " . $mysqli->error . PHP_EOL;
            exit;
        } else {
            $classSessions = '';

            while ($data = $results->fetch_object()) {
        
                $classSessions .= <<<TABLE
                    <tr class="classes_row">
                        <td>{$data->unitCode}</td>
                        <td>&nbsp{$data->classCode}</td>
                        <td>&nbsp{$data->classDay}_{$data->classStartTime}-{$data->classEndTime}</td>
                    </tr>
TABLE;
            }
        
        //To-DO: Add time table for class sessions view for a unit
        $query = "SELECT * FROM class WHERE unitCode='$unitCode'";
        $result = $mysqli->query($query);

        $query2 = "SELECT classCode as class FROM class WHERE unitCode='$unitCode'";

        $result2 = $mysqli->query($query2);

        $TIMETABLE = generateTimeTable($result, $result2);
        
        $unitDetails = <<<HTML
        <div>
            <p>
            Unit details placement is simply dummy text of the printing and typesetting industry. <br>
            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley <br>
            of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap <br>
            into electronic typesetting, remaining essentially un
            </p>
        </div>
        
HTML;

//////////// Show classes with only time table
//         echo <<<EOD
//             <h3>Unit {$unitCode} Details</h3>
//             {$unitDetails}
//             <h3>Class Sessions</h3>
//             {$TIMETABLE}
//             <form action="units.php" method="">
//                 <button type="submit">back</button>
//             </form>
// EOD;

///////////// Show timetable and list of times
echo <<<EOD
            <h3>{$unitCode}: &nbsp {$unitName} Details</h3>
            {$unitDetails}
            <h3>Class Sessions</h3>
            <table>
                <thead>
                    <tr>
                        <th>Unit</th>
                        <th>Class Code</th>
                        <th>Timeslot</th>
                    </tr>
                </thead>
                <tbody>
                    {$classSessions}
                </tbody>
            </table>
            <br>
            {$TIMETABLE}
            <br>
            <form action="units.php" method="">
                <button type="submit">back</button>
            </form>
EOD;

            $results->free();
            $mysqli->close();
        }

    ?>
    
</body>
</html>
