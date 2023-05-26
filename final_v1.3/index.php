<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>CorpU Job Board</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="style/home.css" />
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
        <div class="container-fluid banner">
		    <div class="row">
        <div class="col-md-8 offset-md-2 info">
				<h1 class="text-center">Welcome to CorpU</h1><br><br>
                <a href="units.php" class="btn btn-md text-center p-3">Available Units</a>
			</div>
            </div>
        </div>
HTML;
    } else {
        echo<<<HTML
        <div class="container-fluid banner">
		    <div class="row">
                <div class="col-md-8 offset-md-2 info">
				    <h1 class="text-center">Start Your Teaching Career With CorpU</h1><br><br>
				    <a href="signup.php" class="btn btn-md text-center p-3">Get Started</a><br>
			    </div>
            </div>
        </div>
HTML;  
    }
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script> 

</body>
</html>
