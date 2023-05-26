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
    $givenName = $_GET['givenName'];
  } else {
    echo "<title>{$_SESSION['givenName']}'s Profile</title>"; 
    $applicantID= $_SESSION['userID'];
    $givenName = $_SESSION['givenName'];

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
    <h1 class="text-center "> <?php echo $givenName; ?>'s Details </h1>
    <table class="table table-responsive-md">
      <?php
        require 'connections.php';

        // Grab qualifications for this applicant
        $queryQual = "SELECT * FROM qualifications WHERE userID = '$applicantID' ";
        $result = $mysqli->query($queryQual);

        // Default qualification
        $qualification = 'Not Submitted';

        // If there is qualification, grab it
        if ($result->num_rows > 0){
        $data = $result->fetch_assoc();
        $qualification = $data['qualification'];
        }

        // Grab applicants details
        $query = "SELECT * FROM systemUser WHERE userID = '$applicantID' ";
        $result2 = $mysqli->query($query);

        // Output applicants deets to HTML
        while ($row = $result2->fetch_assoc()) { ?>

        <!-- Details in HTML  -->
        <table>
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
              <th scope="row">Qualifications:</th>
              <td><?= "{$qualification}" ?></td>
          </tr>
          </table>
         
       <?php }        //Start of new php
       
       //and adding edditing button for applicant
       if ($_SESSION['userRole']==='applicant'){
        echo '<div class="d-flex">
        <a href="details.php?applicantID=<?php echo $applicantID; ?>&edit=1">Edit Details</a>
        </div>
        ';
      }

        
    //  echo 'Now getting availablity table';
      // Code to show timetable of availability
      require_once('generateTimeTable.php') ;
      $userAvailQuery = "SELECT * FROM availability WHERE userID = '$applicantID'";
      $userAvailType = "SELECT availabilityType FROM availability WHERE userID='$applicantID'";
      
      $result1 = $mysqli->query($userAvailQuery);
      $result2 = $mysqli->query($userAvailType);
    //   echo $result1->num_rows;
    //   echo $result2->num_rows;
      if ($result1->num_rows > 0) {
          $timetable = generateAvailabilityTable($applicantID, $result1, $result2);
          echo '<br><strong><p class="text-left mt-2">Availability:</p></strong>';
          echo $timetable;
          if ($_SESSION['userRole']==='applicant'){
            echo '<div class="d-flex">
            <a href="availability.php?applicantID=<?php echo $applicantID; ?>&edit=1">Edit Availability</a>
            </div>';
          }
      } elseif ($result1->num_rows == 0 and $_SESSION['userRole']=='applicant'){
        echo '<p class="text-center mb-3 mt-3">Please provide your <a href="availability.php?applicantID=<?php echo $applicantID; ?>&edit=1"> availability</a></p>';
      }

      
      ?>
        

            </div>
          </div>
      </div>
  </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script> 
</body>
</html>
