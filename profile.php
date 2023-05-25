<!-- New user detail input page -->

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link rel="stylesheet" href="style/class_sessions.css">    

  <?php session_start(); 
  require_once('utilities.php');
  isLoggedIn();

  if ($_SESSION['userRole']==='staff'){
    echo "<title>{$_GET['givenName']}'s STAFF Profile</title>"; 
    $applicantID= $_GET['applicantID']; //NOT bug, get has applicantID as param

  } else {
    echo "<title>{$_SESSION['givenName']}'s Profile</title>"; 
    $applicantID= $_SESSION['userID'];
  }
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
<div class="container my-5">
        <div class="d-flex align-items-center align-self-center">
            <div class="container-fluid d-flex justify-content-center">
                <div class="card p-4 border-light">
    <h1 class="text-center mb-5">User Details: <?php echo $_SESSION['givenName']; ?> </h1>
    <table class="table">
      <?php
        require 'connections.php';


        $queryQual = "SELECT * FROM qualifications WHERE userID = '$applicantID'";
        $result = $mysqli->query($queryQual);
        if (mysqli_num_rows($result) > 0){;
        $query = "SELECT * FROM systemUser INNER JOIN qualifications ON systemUser.userID = qualifications.userID WHERE userID = '$applicantID'";}
        else {
        $query = "SELECT * FROM systemUser WHERE userID = '$applicantID'";}

        $result = $mysqli->query($query);

        if ($query == "SELECT * FROM systemUser WHERE userID = '$applicantID'"){
        while ($row = $result->fetch_assoc()) {
          ?>
          <tr>
              <th scope="row">Username:</th>
              <td><?= "{$row['username']}" ?></td>
          </tr>
          <tr>
              <th scope="row">Applicant ID:</th>
              <td><?= "{$row['userID']}" ?></td>
          </tr>
          <tr>
              <th scope="row">Title:</th>
              <td><?= "{$row['title']}" ?></td>
          </tr>
          <tr>
              <th scope="row">Given Name:</th>
              <td><?= "{$row['givenName']}" ?></td>
          </tr>
          <tr>
              <th scope="row">Family Name:</th>
              <td><?= "{$row['familyName']}" ?></td>
          </tr>
          <tr>
              <th scope="row">Email:</th>
              <td><?= "{$row['username']}" ?></td>
          </tr>
          <tr>
              <th scope="row">Contact No:</th>
              <td><?= "{$row['contactNo']}" ?></td>
          </tr>
          <tr>
              <th scope="row">Employment Status:</th>
              <td><?= "{$row['employmentStatus']}" ?></td>
          </tr>
          <tr>
              <th scope="row">Citizenship:</th>
              <td><?= "{$row['citizenship']}" ?></td>
          </tr>
          <tr>
              <th scope="row">Indigenous Status:</th>
              <td><?= "{$row['indigenousStatus']}" ?></td>
          </tr>
          <tr>
              <th scope="row">Hours Available:</th>
              <td><?= "{$row['hoursAvailable']}" ?></td>
          </tr>
          </table>
          
      <?php
        }} 
        if ($query = "SELECT * FROM systemUser INNER JOIN qualifications ON systemUser.userID = qualifications.userID WHERE userID = '$applicantID'"){
            while ($row = $result->fetch_assoc()){
              ?>
              <tr>
                  <th scope="row">Username:</th>
                  <td><?= "{$row['username']}" ?></td>
              </tr>
              <tr>
                  <th scope="row">Applicant ID:</th>
                  <td><?= "{$row['userID']}" ?></td>
              </tr>
              <tr>
                  <th scope="row">Title:</th>
                  <td><?= "{$row['title']}" ?></td>
              </tr>
              <tr>
                  <th scope="row">Given Name:</th>
                  <td><?= "{$row['givenName']}" ?></td>
              </tr>
              <tr>
                  <th scope="row">Family Name:</th>
                  <td><?= "{$row['familyName']}" ?></td>
              </tr>
              <tr>
                  <th scope="row">Email:</th>
                  <td><?= "{$row['username']}" ?></td>
              </tr>
              <tr>
                  <th scope="row">Contact No:</th>
                  <td><?= "{$row['contactNo']}" ?></td>
              </tr>
              <tr>
                  <th scope="row">Employment Status:</th>
                  <td><?= "{$row['employmentStatus']}" ?></td>
              </tr>
              <tr>
                  <th scope="row">Citizenship:</th>
                  <td><?= "{$row['citizenship']}" ?></td>
              </tr>
              <tr>
                  <th scope="row">Indigenous Status:</th>
                  <td><?= "{$row['indigenousStatus']}" ?></td>
              </tr>
              <tr>
                  <th scope="row">Hours Available:</th>
                  <td><?= "{$row['hoursAvailable']}" ?></td>
              </tr>
              <tr>
                  <th scope="row">Qualifications:</th>
                  <td><?= "{$row['qualifications']}" ?></td>
              </tr>
              </table>
        <?php }}?>

        <?php
          if ($_SESSION['userRole']==='applicant'){
              echo '<div>
              <a href="details.php?applicantID=<?php echo $applicantID; ?>&edit=1">Edit Details</a>
              </div>';
          }
        
                // Code to show timetable of availability
      require 'generateTimeTable.php';
      $IDforTable = $applicantID;
      $userAvailQuery = "SELECT * FROM availability WHERE userID = '$IDforTable'";
      $userAvailType = "SELECT availabilityType FROM availability WHERE userID='$applicantID'";
      
      $result1 = $mysqli->query($userAvailQuery);
      $result2 = $mysqli->query($userAvailType);
      if ($result1->num_rows > 0) {
          $timetable = generateAvailabilityTable($IDforTable, $result1, $result2);
          echo $timetable;
      }
      ?>
        

            </div>
          </div>
      </div>
  </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script> 
</body>
</html>
