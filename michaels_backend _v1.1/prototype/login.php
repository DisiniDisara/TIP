<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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

    <h1>Login</h1>

    <?php
    // Display message if username/password dont match in db
    if (isset($_GET['error']) && $_GET['error'] == 1) {
        echo '<p style="color:red;">Incorrect username or password</p>';
    }
    ?>

    <form action="authenticate.php" method="post">
        <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        </div>
        <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        </div>
        <div>
        <input type="submit" value="Login">
        </div>
    </form>
    <p>New? <a href="signup.php">Sign up</a></p>
</body>
</html>
