<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Available Units</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script> 
  <title>Login</title>
  <?php
    session_start();
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
    <div class="d-flex align-items-center align-self-center" style="height: 50em;">
    <div class="container-fluid d-flex justify-content-center">
    <div class="card p-4 border-dark">
    <h1>Login</h1>

    <?php
    // Display message if username/password dont match in db
    if (isset($_GET['error']) && $_GET['error'] == 1) {
        echo '<p style="color:red;">Incorrect username or password</p>';
    }
    ?>
    <form action="authenticate.php" method="post">
        <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
        <input type="submit" value="Login">
        </div>
    </form>

    <p>New? <a href="signup.php">Sign up</a></p>
    </div>
    </div>
    </div>

<?php include "footer.inc" ?>
</body>
</html>
