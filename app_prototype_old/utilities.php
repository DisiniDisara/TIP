<?php
// Contains utility functions for the entire app

function check_stmt_status($stmt) {
    // Checks the status of sql query stmt
    if ($stmt->execute() === TRUE) {
        echo "New user detail record submitted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
}

function isLoggedIn(){
    if (isset($_SESSION['isLoggedIn']) and $_SESSION['isLoggedIn']===true){
        return true;
    } else {
        header ("Location: access_denied.html");
    }
}

function isStaff(){
    if (isset($_SESSION['userRole']) and $_SESSION['userRole']==='staff' and isLoggedIn()) {
        return true;
    } else {
        header ("Location: access_denied.html");
    }
}

function generate_ID($length = 10) {
    $chars = "0123456789";
    $random_string = '';
    while(strlen($random_string) < $length) {
        if (strlen($random_string) == 0) {
            // Add a random character for the first character in the string
            $random_string .= 'S';
        } else {
            // Add a random digit for the remaining 9 characters in the string
            $random_string .= $chars[mt_rand(0,9)];
        }
    }
    return $random_string;
}

function generate_applicantID(){
    // Generate unique applicantID bu checking db
    require 'connections.php';

    // Initial 
    $count = 9999;
    $applicantID = 'INITIAL'; 
    while ($count > 0){         
        // Generate different applicantID until $count is 0
        $applicantID = generate_ID();
        // Check if applicantID already exists in dB
        $check_applicantID_query = "SELECT * FROM applicant WHERE applicantID = '$applicantID' ";
        $result = $mysqli->query($check_applicantID_query);
        $count = $result->num_rows; 
    }
    // close db connection
    $mysqli->close();
    return $applicantID;
}

function process_applicant_details($first_detail=false) {

    $title = $_POST['title'];
    $email = $_POST['email'];
    $givenName = $_POST['givenName'];
    $familyName = $_POST['familyName'];
    $employmentStatus = $_POST['employmentStatus'];
    $contactNo = $_POST['contactNo'];
    $citizenship = $_POST['citizenship'];
    $indigenousStatus = $_POST['indigenousStatus'];
    $hoursAvailable = $_POST['hoursAvailable'];
  
    if ($first_detail===true) {
        // Connect to db
        require 'connections.php';

        $username = $_POST['username'];
        $password = $_POST['password'];
        // Generate unique applicantID bu checking db
        $applicantID = generate_applicantID();

        $insert = "INSERT INTO login (username, sPassword) VALUES ('$username', '$password')";
        // Insert username and password
        mysqli_query($mysqli, $insert);

        

        // Insertion query
        $sql_query = "INSERT INTO applicant(applicantID, title, email, givenName, familyName, employmentStatus, 
            contactNo, citizenship, indigenousStatus, hoursAvailable, username) 
            VALUES ('$applicantID', '$title', '$email', '$givenName', '$familyName', '$employmentStatus', 
            '$contactNo', '$citizenship', '$indigenousStatus', '$hoursAvailable', '$username')";
            // Query the daabase
        $stmt = $mysqli->prepare($sql_query);
        
        check_stmt_status($stmt);
        // Store new user details as global variable
        $_SESSION['userID'] = $applicantID;
        $_SESSION['applicantID'] = $applicantID;
        $_SESSION['username'] = $username;

    } else {

        $applicantID = $_SESSION['userID'];
        $username = $_SESSION['username'];
        // Connect to db
        require 'connections.php';

        // If applicantID is set, update existing record
        $sql_query = "UPDATE applicant SET 
            title = '$title', 
            email = '$email', 
            givenName = '$givenName', 
            familyName = '$familyName', 
            employmentStatus = '$employmentStatus', 
            contactNo = '$contactNo', 
            citizenship = '$citizenship', 
            indigenousStatus = '$indigenousStatus', 
            hoursAvailable = '$hoursAvailable', 
            username = '$username' 
            WHERE applicantID = '$applicantID'";

        $stmt = $mysqli->prepare($sql_query);
        check_stmt_status($stmt);        
    }

  // close connection and statement
  $stmt->close();
  $mysqli->close();

  $_SESSION['givenName'] = $givenName;
  
  }

function process_applicant_preferences(){
    // Insert class preference from class_preferences_edit.php into db.
    require 'connections.php';

    // Insert submitted preference form to db.
    if ($_SERVER["REQUEST_METHOD"] == "POST" and $_GET['edit']==0) {
        $unitCode = $_POST["unitCode"];
        $applicantID = $_SESSION["userID"]; // Use $_SESSION as 
        $preferences = $_POST["preferences"];

        // Checks if array of preferences is valid.
        check_preferences($preferences, $unitCode);

        foreach ($preferences as $index => $prefLevel) {
            $classCode = $_POST["classCode"][$index];
            if ($prefLevel > 0){ // Only add prefLevel to classCdoe with prefLevel to avoid NULL

                // Check if the row already exists
                $sql = "SELECT COUNT(*) FROM preferences WHERE applicantID='$applicantID' AND classCode='$classCode'";
                $result = $mysqli->query($sql);
                $count = $result->fetch_row()[0];
    
                if ($count > 0) {
                    // If the row exists, update the prefLevel
                    $sql = "UPDATE preferences SET prefLevel='$prefLevel' WHERE applicantID='$applicantID' AND prefCode='$classCode'";
                } else {
                    // If the row does not exist, insert a new row
                    $sql = "INSERT INTO preferences (applicantID, unitCode, classCode, prefCode, prefLevel) VALUES ('$applicantID', '$unitCode', '$classCode', '$classCode', '$prefLevel')";
                }
                $result = $mysqli->query($sql);
                if (!$result) {
                    echo "Error: Our query failed to execute and here is why: " . PHP_EOL;
                    echo "Query: " . $sql . PHP_EOL;
                    echo "Errno: " . $mysqli->errno . PHP_EOL;
                    echo "Error: " . $mysqli->error . PHP_EOL;
                    exit;
                } 
            } else { // Handles no preferences or removal of preferences
                // Check if the row already exists
                $sql = "SELECT COUNT(*) FROM preferences WHERE applicantID='$applicantID' AND classCode='$classCode'";
                $result = $mysqli->query($sql);
                $count = $result->fetch_row()[0];
    
                if ($count > 0) {
                    // If the row exists, update the prefLevel
                    $sql = "DELETE FROM preferences WHERE applicantID='$applicantID' AND prefCode='$classCode'";
                } 
                $result = $mysqli->query($sql);
                if (!$result) {
                    echo "Error: Our query failed to execute and here is why: " . PHP_EOL;
                    echo "Query: " . $sql . PHP_EOL;
                    echo "Errno: " . $mysqli->errno . PHP_EOL;
                    echo "Error: " . $mysqli->error . PHP_EOL;
                    exit;
                }

            } //endif
        }
        // Redirect back to the class preferences page
        header("Location: class_preferences_view.php?unitCode=$unitCode&applicantID=$applicantID");
        exit;
    }
}

function check_preferences($preferences, $unitCode) {
    // Length of preferences form
    $n_options = count($preferences);

    $preferences_numeric = array_filter($preferences, 'is_numeric');
    
    sort($preferences_numeric);
    $n_preferences = count($preferences_numeric);

    $preferences_numeric_string = implode("", $preferences_numeric);


    $preferences_set = array_values(array_unique($preferences));

    $valid_integers = range(1, $n_preferences);
    $valid_integers_string = implode("", $valid_integers);

    $same = $preferences_numeric_string === $valid_integers_string;
    
    if ( $n_options === 0 || $same === true) {
        // Handles if preference form is 0 i.e no classes and if 1 or more preferences are valid
        return true;
    } elseif ((!is_numeric($preferences_set[0]) and count($preferences_set)==1)){
        // Handles empty preference form
        header("Location: class_preferences_view.php?empty=1&unitCode={$unitCode}");
        exit;
    } else {
        // All other preferences are invalid
        header("Location: class_preferences_edit.php?error=1&unitCode={$unitCode}");
        exit;
    }
}

function process_class_sessions_staff_edit() {

    // Process class session staff edits.
    return false;
}

?>
