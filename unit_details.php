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
        
        $query3 = "SELECT unit_description FROM unit WHERE unitCode ='$unitCode'";
        $unitDescription = $mysqli->query($query3);

        if ($row = mysqli_fetch_assoc($unitDescription)){
            $unitDetails = array_key_exists('unit_description', $row) ? $row['unit_description'] : $row['unit_description'];
        } else {
        $unitDetails = <<<HTML
            Unit details placement is simply dummy text of the printing and typesetting industry. <br>
            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley <br>
            of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap <br>
            into electronic typesetting, remaining essentially un        
HTML; } // If this page breaks, it's because of this, added auto set to unitDetails, to undo re-add div and p element back here }

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
            <div class="container my-5">
            
            <div class="d-flex align-items-center align-self-center">
                <div class="container-fluid d-flex justify-content-center">
            <div class="card p-4 border-light">
            <h3 class="text-center mb-5">{$unitCode}: &nbsp {$unitName} Details</h3>
            <div class="d-flex align-items-center align-self-center justify-content-centre" style="height: 50%;">
            <p>{$unitDetails}</p>
            </div>
            <h3>Class Sessions</h3>
            <table  class="table table-sm mt-3">
                <thead>
                    <tr>
                        <th scope="col">Unit</th>
                        <th scope="col">Class Code</th>
                        <th scope="col">Timeslot</th>
                    </tr>
                </thead>
                <tbody>
                    {$classSessions}
                </tbody>
            </table>
            <br>
            <div class="table-responsive-sm">
            <table  class="table table-responsive mt-3">
            <tbody>
            {$TIMETABLE}
            </tbody>
        </table>
        </div

            <br>
                <a class="btn butt_out m-2" href='units.php'>Back</a>
            </div>
            </div>
            </div>

EOD;

            $results->free();
            $mysqli->close();
        }

    ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script> 

</body>
</html>
