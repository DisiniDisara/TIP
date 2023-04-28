<!-- New user detail input page -->

<?php 
    session_start();
    //To read detail_form and insert new user detail into applicant table
    require 'connections.php';
    require_once('utilities.php');

    // check if form is submitted and call the function
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        process_applicant_details($first_detail=true);
        $_SESSION['isLoggedIn'] = true;
        header("Location: index.php");
    }   

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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
        $username = $_GET['username'];
        $password = $_GET['password'];
        echo <<<HTML
        <p>Username <strong>{$username}</strong><p>
HTML;        
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="title">Title:</label>
        <select id="title" name="title" required>
        <option value="">--Please select--</option>
        <option value="Mr">Mr</option>
        <option value="Mrs">Mrs</option>
        <option value="Ms">Ms</option>
        </select><br>

        <label for="givenName">Given Name:</label>
        <input type="text" id="givenName" name="givenName" required maxlength="255" ><br>

        <label for="familyName">Family Name:</label>
        <input type="text" id="familyName" name="familyName" required maxlength="255"><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="255"><br>
        
        <label for="contactNo">Contact Number:</label>
        <input type="tel" id="contactNo" name="contactNo" required maxlength="10"><br>

        <label for="employmentStatus">Employment Status:</label>
        <input type="text" id="employmentStatus" name="employmentStatus" required maxlength="255"><br>
        
        <label for="citizenship">Citizenship:</label>
        <input type="text" id="citizenship" name="citizenship" required maxlength="255"><br>

        <label for="indigenousStatus">Indigenous Status:</label>
        <input type="text" id="indigenousStatus" name="indigenousStatus" required maxlength="255"><br>

        <label for="hoursAvailable">Hours Available:</label>
        <input type="number" id="hoursAvailable" name="hoursAvailable" required><br>

        <input type="submit" value="Create Account">
        <input type="hidden" name="username" value=<?php echo $username;?> >
        <input type="hidden" name="password" value=<?php echo $password;?> >

    </form>

</body>
</html>
