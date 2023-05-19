<!-- New user detail input page -->



<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script> 

  <?php session_start(); 
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
<div class="container mx-auto my-5">
        <h1 class="text-center">User Profile</h1>
</div>

<div> <!---   class="d-flex align-items-center align-self-center" -->
    <div class="container d-flex justify-content-center">
    <table class="table table-striped">
        <?php
            require 'connections.php';
            $applicantID= $_SESSION['applicantID'];
            $query = "SELECT * FROM applicant WHERE applicantID = '$applicantID' ";
            $result = $mysqli->query($query);

            while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <th scope="row">Username:<th>
            <td><?= "{$row['username']}" ?></td>
        </tr>
        <tr>
            <th scope="row">Applicant ID:<th>
            <td><?= "{$row['applicantID']}" ?></td>
        </tr>
        <tr>
            <th scope="row">Title:<th>
            <td><?= "{$row['title']}" ?></td>
        </tr>
        <tr>
            <th scope="row">Given Name:<th>
            <td><?= "{$row['givenName']}" ?></td>
        </tr>
        <tr>
            <th scope="row">Family Name:<th>
            <td><?= "{$row['familyName']}" ?></td>
        </tr>
        <tr>
            <th scope="row">Email:<th>
            <td><?= "{$row['email']}" ?></td>
        </tr>
        <tr>
            <th scope="row">Contact No:<th>
            <td><?= "{$row['contactNo']}" ?></td>
        </tr>
        <tr>
            <th scope="row">Employment Status:<th>
            <td><?= "{$row['employmentStatus']}" ?></td>
        </tr>
        <tr>
            <th scope="row">Citizenship:<th>
            <td><?= "{$row['citizenship']}" ?></td>
        </tr>
        <tr>
            <th scope="row">Indigenous Status:<th>
            <td><?= "{$row['indigenousStatus']}" ?></td>
        </tr>
        <tr>
            <th scope="row">Hours Available:<th>
            <td><?= "{$row['hoursAvailable']}" ?></td>
        </tr>
        <tr>
            <td><a href="details.php?applicantID=<?php echo $_SESSION['applicantID']; ?>&edit=1">Edit Details</a></td>
        </tr>
        <?php } ?>
    </table>
    </div>
</div>
<?php include "footer.inc" ?>

</body>
</html>
