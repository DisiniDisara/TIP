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
        <title>Class Sessions for {$unitCode}</title>             
EOD;
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

        // Get the unit code from the URL parameters
        $unitCode = $_GET['unitCode'];

        // Query the database to get the class sessions for the unit
        $sql = "SELECT * FROM class WHERE unitCode = '$unitCode'";

        $results = $mysqli->query($sql);

        if (!$results) {
            echo "Error: Our query failed to execute and here is why: " . PHP_EOL;
            echo "Query: " . $sql . PHP_EOL;
            echo "Errno: " . $mysqli->errno . PHP_EOL;
            echo "Error: " . $mysqli->error . PHP_EOL;
            exit;
        } else {
            $row = 0;
            $classSessions = '';

            while ($data = $results->fetch_object()) {
                // For table positioning
                $classes = ($row++ % 2 == 0) ? 'even' : 'odd';

                $classSessions .= <<<TABLE
                    <tr class="{$classes}">
                        <td>{$data->unitCode}</td>
                        <td>{$data->classCode}</td>
                        <td>{$data->classTimeslot}</td>
                    </tr>
TABLE;
            }

            echo <<<EOD
                <h3>Class Sessions for Unit {$unitCode}</h3>
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
