
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
  <title>Sign Up</title>
  <?php
    session_start();
    ?>
</head>
<body>

<div class="container">
        <div class="myCard">
            <div class="row">
                <div class="col-md-6">
                    <div class="myLeftCtn">
                        <form class="myForm text-center" action="register.php" method="post">
                            <header style="margin-top: 50px;">Create your account</header>
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
                            <div class="form-group">
                                <i class="fas fa-envelope"></i>
                                <input class="myInput" placeholder="Email" type="text" id="username" name="username" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required>
                            </div>

                            <div class="form-group">
                                <i class="fas fa-lock"></i>
                                <input class="myInput" placeholder="Password" type="password" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <i class="fas fa-lock"></i>
                                <input class="myInput" placeholder="Repeat Password" type="password" id="password2" name="password2" required>
                            </div>
                            <input type="submit" class="butt" value="SIGN UP">

                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="myRightCtn">
                        <div class="box">
                            <header class="text-center"
                                style="font-size: 50px; font-style: bold; color: white; margin-top: 50px;">SIGN UP TO
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
