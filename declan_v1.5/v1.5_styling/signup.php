
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Sign Up</title>
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

    <h1>Sign Up</h1>
    <?php
    // Display message if passwords entered dont match
    if (isset($_GET['error']) && $_GET['error'] == 1) {
        echo '<p style="color:red;">passwords need to match.</p>';
    }
    ?>
    <?php
    // Display message if username is taken
    if (isset($_GET['error']) && $_GET['error'] == 2) {
        echo '<p style="color:red;">username is taken.</p>';
    }
    ?>
    <?php
    // Display message if error in db
    if (isset($_GET['error']) && $_GET['error'] == 3) {
        echo '<p style="color:red;">insertion error.</p>';
    }
    ?>
    <form action="register.php" method="post">
        <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        </div>
        <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        </div>
        <div>
        <label for="password">Repeat the Password:</label>
        <input type="password" id="password2" name="password2" required>
        </div>
        <div>
        <input type="submit" value="Sign Up">
        </div>
    </form>
</body>
</html>
