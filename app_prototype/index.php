<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>CorpU Job Board</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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

<?php
    if (isset($_SESSION['givenName']) and $_SESSION['isLoggedIn']){
        echo<<<HTML
        <h1>Welcome to CorpU, <strong>{$_SESSION['givenName']}</strong> (<strong>{$_SESSION['userID']}</strong>) </h1>
HTML;
    } else {
        echo<<<HTML
        <h1>Welcome to CorpU</h1>
HTML;  
    }
?>
<h2>We are looking for sessional staffs!</h2>
<p>Click <a href="units.php">here</a> to see available units to teach.</p>
    
</body>
</html>
