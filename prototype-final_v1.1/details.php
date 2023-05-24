<!-- Detail Page seen by logged in user -->
<?php 
    session_start();
    //To read detail_form and insert new user detail into applicant table
    require_once('utilities.php');
    isLoggedIn();
    
    require 'connections.php';
    // check if form is submitted and call the function
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        process_applicant_details($first_detail=false);
        $_SESSION['isLoggedIn'] = true;
        header("Location: profile.php");
    }   
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link rel="stylesheet" href="style/details.css">          
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
    
<div class="container" >
        <div class="d-flex align-items-center align-self-center">
            <div class="container-fluid d-flex justify-content-center">
                <div class="card p-4 border-light">
    <h1 class="text-center mb-5">User Details</h1>

    <?php
        echo <<<HTML
        <p>Username <strong>{$_SESSION['username']}</strong><p>
        <p>Applicant ID <strong>{$_SESSION['userID']}</strong><p>
HTML;        
    ?>
    <?php
        $applicantID = $_SESSION['userID'];
        $query = "SELECT * FROM systemUser WHERE userID = '$applicantID' ";
        $result = $mysqli->query($query);
        $row = $result->fetch_assoc();
    ?>
   
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="title">Title:</label>
        <select style="margin-left:107px;" id="title" name="title" required>
            <option value="">--Please select--</option>
            <option value="Mr" <?php if ($row['title'] === 'Mr') {echo 'selected';}?>>Mr</option>
            <option value="Mrs" <?php if ($row['title'] === 'Mrs') {echo 'selected';}?>>Mrs</option>
            <option value="Ms" <?php if ($row['title'] === 'Ms') {echo 'selected';}?>>Ms</option>
        </select><br>

        <label for="givenName">Given Name:</label>
        <input style="margin-left:50px;" type="text" id="givenName" name="givenName" required maxlength="255" value="<?= "{$row['givenName']}" ?>"><br>

        <label for="familyName">Family Name:</label>
        <input style="margin-left:45px;" type="text" id="familyName" name="familyName" required maxlength="255" value="<?= "{$row['familyName']}" ?>"><br>

        <label for="email">Email:</label>
        <input style="margin-left:100px;" type="email" id="email" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="255" value="<?= "{$row['username']}" ?>"><br>

        <label for="contactNo">Contact Number:</label>
        <input style="margin-left:20px;" type="tel" id="contactNo" name="contactNo" required maxlength="10" value="<?= "{$row['contactNo']}" ?>"><br>

        <label for="employmentStatus">Employment Status:</label>
        <input style="margin-left:0px;" type="text" id="employmentStatus" name="employmentStatus" required maxlength="255" value="<?= "{$row['employmentStatus']}" ?>"><br>

        <label for="citizenship">Citizenship:</label>
        <input style="margin-left:60px;" type="text" id="citizenship" name="citizenship" required maxlength="255" value="<?= "{$row['citizenship']}" ?>"><br>

        <label for="indigenousStatus">Indigenous Status:</label>
        <input style="margin-left:10px;" type="text" id="indigenousStatus" name="indigenousStatus" required maxlength="255" value="<?= "{$row['indigenousStatus']}" ?>"><br>

        <label for="hoursAvailable">Hours Available:</label>
        <input style="margin-left:25px;" type="number" id="hoursAvailable" name="hoursAvailable" required value="<?= "{$row['hoursAvailable']}" ?>"><br>

        <input class="button" type="submit" value="Submit">
    </form>
    <button class="button" onclick="window.location.href='profile.php'">Cancel</button>

</body>
</html>
