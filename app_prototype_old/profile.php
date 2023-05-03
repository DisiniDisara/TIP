<!-- New user detail input page -->

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <?php session_start(); 
  require_once('utilities.php');
  isLoggedIn();
  echo "<title>{$_SESSION['givenName']} Profile</title>" ?>
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
    <table>
        <?php
            require 'connections.php';
            $applicantID= $_SESSION['userID'];
            $query = "SELECT * FROM applicant WHERE applicantID = '$applicantID' ";
            $result = $mysqli->query($query);

            while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td>
                <b>Username:</b> <?= "{$row['username']}" ?><br>
                <b>Applicant ID:</b> <?= "{$row['applicantID']}" ?><br>
                <b>Title:</b> <?= "{$row['title']}" ?><br>
                <b>Given Name:</b> <?= "{$row['givenName']}" ?><br>
                <b>Family Name:</b> <?= "{$row['familyName']}" ?><br>
                <b>Email:</b> <?= "{$row['email']}" ?><br>
                <b>Contact No:</b> <?= "{$row['contactNo']}" ?><br>
                <b>Employment Status:</b> <?= "{$row['employmentStatus']}" ?><br>
                <b>Citizenship:</b> <?= "{$row['citizenship']}" ?><br>
                <b>Indigenous Status:</b> <?= "{$row['indigenousStatus']}" ?><br>
                <b>Hours Available:</b> <?= "{$row['hoursAvailable']}" ?><br>
            </td>
        </tr>
        <tr>
            <td><a href="details.php?applicantID=<?php echo $applicantID; ?>&edit=1">Edit Details</a></td>
        </tr>
        <?php } ?>
    </table>

</body>
</html>
