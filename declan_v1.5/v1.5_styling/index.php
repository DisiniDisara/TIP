<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>CorpU Job Board</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
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
        <header class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Welcome to CorpU, <strong>{$_SESSION['givenName']}</strong> (<strong>{$_SESSION['applicantID']}</strong>) </h1>
        </div>
        </header>
HTML;
    } else {
        echo<<<HTML
        <header class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Welcome to CorpU</h1>
        </div>
        </header>
HTML;  
    }
?>
<div class="container"> 
    <h2>We are looking for sessional staffs!</h2>
    <p>Click <a href="units2.php">here</a> to see available units to teach.</p>
</div>
<?php include "footer.inc"?>
</body>
</html>
