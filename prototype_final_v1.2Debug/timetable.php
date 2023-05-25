<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style/class_sessions.css">    
    <?php session_start(); 
    require_once('utilities.php');
    isLoggedIn();
    echo "<title>{$_SESSION['givenName']}'s Timetable</title>"; 
    ?>
</head>
<body>
    <?php
    include 'generateNav.php';
    $nav = generateNav();
    echo $nav;
    ?>

    <?php
        require 'connections.php';
        require_once('utilities.php');
        require_once('generateTimeTable.php');
        $applicantID=$_SESSION['userID'];

        $query = "SELECT * FROM class WHERE userID='$applicantID'";
        $result = $mysqli->query($query);

        if ($result->num_rows>0){
            $query2 = "SELECT unitCode, className FROM class WHERE userID='$applicantID'";
            $result2 = $mysqli->query($query2);
    
            $TIMETABLE = generateTimeTable($result, $result2);
    
            echo <<<HTML
            <div class="container my-5">
                <div class="d-flex align-items-center align-self-center">
                    <div class="container-fluid d-flex justify-content-center">
                        <div class="card p-4 border-light">
                            <h3 class="text-center">Your Allocated Timetable</h3>
                            $TIMETABLE
                        </div>
                    </div>
                </div>
            </div>
HTML;

        } else {
            echo <<<HTML
            <div class="container my-5">
                <div class="d-flex align-items-center align-self-center">
                    <div class="container-fluid d-flex justify-content-center">
                        <div class="card p-4 border-light">
                            <h3 class="text-center">You have no allocations.</h3>
                        </div>
                    </div>
                </div>
            </div>
HTML;
        }
        
    ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script> 
</body>
</html>

