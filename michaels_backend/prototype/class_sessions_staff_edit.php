<!--Edit Class Preference -->
<?php
session_start();
require_once('utilities.php');
isStaff();

// Insert submitted preference form to db.
process_class_sessions_staff_edit();
?>

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
        $unitCode = $_REQUEST['unitCode'];
        echo <<<EOD
        <title>Edit Class Sessions for {$unitCode}</title>             
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
        $unitCode = $_REQUEST['unitCode'];

        // Query the database to get the class sessions for the unit
        $sql = "SELECT * FROM class WHERE unitCode = '$unitCode' ";
        $class_sessions_results = $mysqli->query($sql);

        if (!$class_sessions_results) {
            echo "Error: Our query failed to execute and here is why: " . PHP_EOL;
            echo "Query: " . $sql . PHP_EOL;
            echo "Errno: " . $mysqli->errno . PHP_EOL;
            echo "Error: " . $mysqli->error . PHP_EOL;
            exit;
        } else {
            $classesTable = '';

                $idx = 0;
                while ($data = $class_sessions_results->fetch_object()) {
                    // For table positioning
                    $classCode = $data->classCode;
                    
                    $classesTable .= <<<TABLE
                        <tr class="preferences">
                            <td>{$data->unitCode}</td>
                            <td>{$data->classCode}</td>
                            <td>{$data->classTimeslot}</td>
                            <td>
                                <select id="title" name="title" required>
                                    <option value="Add" >Add</option>
                                    <option value="Remove" >Remove</option>
                                </select>
                            </td>
                            
                        </tr>
TABLE;

                }
        } 
    

    ?>
    <?php
    
    if (isset($_GET['empty']) && $_GET['empty'] == 1) {
        echo '<p style="color:red;">No preferences added.</p>';
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?edit=0" method="post">
        <h1>Edit Class Sessions for <?php echo $unitCode;?></h1>
            <table>
                <thead>
                    <tr>
                        <th>Unit</th>
                        <th>Class Code</th>
                        <th>Time slot</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $classesTable;?>
                </tbody>
            </table>
            <button type="submit">Submit</button>
            <input type="hidden" name="unitCode" value="<?php echo $unitCode; ?>" />
            <!-- To do - implement clear all -->
    </form>
    <button onclick="window.location.href='units_edit.php' ">Cancel</button>
</body>
</html>
