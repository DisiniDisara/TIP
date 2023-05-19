<!-- Detail Page seen by logged in user -->
<?php 
    session_start();
    //To read detail_form and insert new user detail into applicant table
    require 'connections.php';
    require_once('utilities.php');

    // check if form is submitted and call the function
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_SESSION['applicantID'] = process_applicant_details($first_detail=false);
        $_SESSION['isLoggedIn'] = true;
        header("Location: profile.php");
    }   
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Details</title>
</head>
<body>
    <?php
    // Include the file containing the generateNav() function
    include 'generateNav.php';

    // Generate the navigation menu
    $nav = generateNav();
    echo $nav;
    ?>

    <h1>User Details</h1>

    <?php
        echo <<<HTML
        <p>Username <strong>{$_SESSION['username']}</strong><p>
        <p>Applicant ID <strong>{$_SESSION['applicantID']}</strong><p>
HTML;        
    ?>
    <?php
        $applicantID = $_SESSION['applicantID'];
        $query = "SELECT * FROM applicant WHERE applicantID = '$applicantID' ";
        $result = $mysqli->query($query);
        $row = $result->fetch_assoc();
    ?>
    <!-- Prefilled user details -->
    <!-- <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?edit=1&applicantID=<?php echo $_SESSION['applicantID'];?>" method="post"> -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="title">Title:</label>
        <select id="title" name="title" required>
            <option value="">--Please select--</option>
            <option value="Mr" <?php if ($row['title'] === 'Mr') {echo 'selected';}?>>Mr</option>
            <option value="Mrs" <?php if ($row['title'] === 'Mrs') {echo 'selected';}?>>Mrs</option>
            <option value="Ms" <?php if ($row['title'] === 'Ms') {echo 'selected';}?>>Ms</option>
        </select><br>

        <label for="givenName">Given Name:</label>
        <input type="text" id="givenName" name="givenName" required maxlength="255" value="<?= "{$row['givenName']}" ?>"><br>

        <label for="familyName">Family Name:</label>
        <input type="text" id="familyName" name="familyName" required maxlength="255" value="<?= "{$row['familyName']}" ?>"><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="255" value="<?= "{$row['email']}" ?>"><br>

        <label for="contactNo">Contact Number:</label>
        <input type="tel" id="contactNo" name="contactNo" required maxlength="10" value="<?= "{$row['contactNo']}" ?>"><br>

        <label for="employmentStatus">Employment Status:</label>
        <input type="text" id="employmentStatus" name="employmentStatus" required maxlength="255" value="<?= "{$row['employmentStatus']}" ?>"><br>

        <label for="citizenship">Citizenship:</label>
        <input type="text" id="citizenship" name="citizenship" required maxlength="255" value="<?= "{$row['citizenship']}" ?>"><br>

        <label for="indigenousStatus">Indigenous Status:</label>
        <input type="text" id="indigenousStatus" name="indigenousStatus" required maxlength="255" value="<?= "{$row['indigenousStatus']}" ?>"><br>

        <label for="hoursAvailable">Hours Available:</label>
        <input type="number" id="hoursAvailable" name="hoursAvailable" required value="<?= "{$row['hoursAvailable']}" ?>"><br>

        <input type="submit" value="Submit">
    </form>
    <button onclick="window.location.href='profile.php'">Cancel</button>

</body>
</html>
