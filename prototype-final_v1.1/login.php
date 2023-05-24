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
<!---  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
-->
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



    <div class="container">
        <div class="myCard">
            <div class="row">
                <div class="col-md-6">
                    <div class="myLeftCtn">
                        <form class="myForm text-center" action="authenticate.php" method="post">
                            <header style="margin-top: 50px;">Login to your account</header>
                            <?php
                                // Display message if username/password dont match in db
                                if (isset($_GET['error']) && $_GET['error'] == 1) {
                                    echo '<p style="color:red;">Incorrect username or password</p>';
                                }
                            ?>
                            <div class="form-group">
                                <i class="fas fa-envelope"></i>
                                <input class="myInput" placeholder="Username" type="text" id="username" name="username" required>
                            </div>

                            <div class="form-group">
                                <i class="fas fa-lock"></i>
                                <input class="myInput" placeholder="Password" type="password" id="password" name="password" required>
                            </div>
                            <input type="submit" class="butt" value="LOGIN">

                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="myRightCtn">
                        <div class="box">
                            <header class="text-center"
                                style="font-size: 50px; font-style: bold; color: white; margin-top: 50px;">LOGIN TO
                                CORPU
                            </header>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
