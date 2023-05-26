<!-- HTML to show avaialble units, to view and edit preferences -->
<?php
    // For adding/removing units to be available
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require 'connections.php';
        require_once('utilities.php');

        $addUnit = $_POST['addUnit'];
        $sql = "UPDATE unit SET vacancyStatus='true' WHERE unitCode='$addUnit' ";  
        $stmt = $mysqli->prepare($sql);
        $stmt->execute();
        header( "Location: units_staff_view.php");
    }

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
                <td><a href="unit_details.php?unitCode={$unitCode}">{$unitName}</a></td>
                <td style='text-align: center;'><a href="class_sessions_staff_edit.php?unitCode={$unitCode}">Edit</a></td>
                <td style='text-align: center;'><a href="remove_unit.php?unitCode={$unitCode}">Remove</a></td>
                <td style='text-align: right;'><a href="class_preferences_staff_view.php?unitCode={$unitCode}"><strong>  $n_applicants</strong></a></td>
                <td style='text-align: right;'><a href="class_allocation.php?unitCode={$unitCode}">Allocate</a></td>
            </tr>
TABLE;
        };        
    };

    // For adding/removing units
    $queryNotVacant = "SELECT * FROM unit WHERE vacancyStatus !='true' ";
    $results = $mysqli->query($queryNotVacant);
    $newUnitAvailableTable = <<<HTML
        <label for="addUnit">Add Unit:</label>
        <select id="addUnit" name="addUnit" required>
        <option value="">--Please select--</option>
HTML;

    // Goes through each row from query results and append to TABLE
    while ($data = $results->fetch_object()) {
        // Get number of applicants applied to this unit
        $unitCode = $data->unitCode;
        $unitName = $data->unitName;

        // Adding class info to each row of table
        $newUnitAvailableTable .= <<<HTML
        <option value='{$unitCode}'>{$unitCode}</option>
HTML;
    };        

    $newUnitAvailableTable .= <<<html
    </select>
html;
    // Clear resuls and close database
    $results->free();
    $mysqli->close();

?>

<h3>Available Units</h3>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Edit</th>
                <th>Remove</th>
                <th>Applications</th>
                <th>Allocate</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $table;?>
        </tbody>
    </table>

    <form action= '<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method="post">    
    <?php echo $newUnitAvailableTable; ?>
    <input type="submit" value="Add Unit">
    </form>  

</body>
</html>
