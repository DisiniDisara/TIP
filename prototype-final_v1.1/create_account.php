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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="style/signup.css">
<title>Details</title>
</head>
<body>
    <?php
    // Include the file containing the generateNav() function
    include 'generateNav.php';

    // Generate the navigation menu
    $nav = generateNav();
    // echo $nav;   Not required for this page?
    ?>

    <div class="myCard" style=" top: 50.5%;">
        <div class="row">
            <div class="col-md-6">
                <div class="myLeftCtn">
                    <form class="myForm text-center" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <header>Create new account</header>
                        <?php
                        $username = $_GET['username'];
                        $password = $_GET['password'];
                        echo <<<HTML
                        <p>Username: <strong>{$username}</strong><p>
HTML;        
                        ?>
                        <input type="hidden" name="username" value=<?php echo $username;?> >
                        <input type="hidden" name="password" value=<?php echo $password;?> >
                        
                        <div class="form-group">
                            <i class="fas fa-user"></i>
                            <select class="myInput" id="title" name="title" required>
                                <option value="">Please Select</option>
                                <option value="Mr">Mr</option>
                                <option value="Mrs">Mrs</option>
                                <option value="Ms">Ms</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <i class="fas fa-user"></i>
                            <input class="myInput" type="text" placeholder="Given Name" id="givenName" name="givenName" required maxlength="255">
                        </div>

                        <div class="form-group">
                            <i class="fas fa-user"></i>
                            <input class="myInput" type="text" placeholder="Last Name" id="familyName" name="familyName" required maxlength="255">
                        </div>

                        <div class="form-group">
                            <i class="fas fa-envelope"></i>
                            <input class="myInput" placeholder="Email" type="email" id="email" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="255">
                        </div>

                        <div class="form-group">
                            <i class="fas fa-mobile"></i>
                            <input class="myInput" placeholder="Contact Number" type="tel" id="contactNo" name="contactNo" required maxlength="10">
                        </div>


                        <div class="form-group">
                            <i class="fas fa-flag"></i>
                            <select class="myInput" id="citizenship" name="citizenship" required>
                                <option value="">Please Select</option>
                                <option value="Australian">Australian</option>
                                <option value="Non-Australian with working visa">Non-Australian with working visa</option>
                                <option value="Student visa with approved working permits">Student visa with approved working permits</option>
                                <option value="Temporary Skill Shortage (TSS) Visa">Temporary Skill Shortage (TSS) Visa</option>
                                <option value="Working Holiday Visa">Working Holiday Visa</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <i class="fas fa-user"></i>
                            <select class="myInput" id="indigenousStatus" name="indigenousStatus" required>
                                <option value="">Please Select</option>
                                <option value="Indigenous">Indigenous</option>
                                <option value="Non-Indigenous">Non-Indigenous</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <i class="fas fa-book"></i>
                            <input class="myInput" type="number" id="hoursAvailable" name="hoursAvailable" placeholder="Hours Available" required>
                        </div>

                        <div class="form-group">
                            <label>
                                <input id="check_1" name="check_1" type="checkbox" required><small> I read and agree to
                                    Terms & Conditions</small></input>
                                <div class="invalid-feedback">You must check the box.</div>
                            </label>
                        </div>

                        <input type="submit" class="butt" value="CREATE ACCOUNT">

                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="myRightCtn">
                    <div class="box">
                        <header class="text-center" style="font-size: 50px; font-style: bold; color: white;">JOIN CORPU
                        </header>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

</body>
</html>
