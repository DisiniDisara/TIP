<?php
    function generateNav() {
        require_once('utilities.php');
        
        $navbar = '<nav class="navbar navbar-default">' .
            '<div class="container-fluid">' . PHP_EOL .
            '<div class="navbar-header">
                <a class="navbar-brand" href="#">CorpU</a>
            </div>' . PHP_EOL .
            '<ul class="nav navbar-nav" style="float:right;">' . PHP_EOL . 
                '<li class="active"><a href="index.php">Home</a></li>' . PHP_EOL .
                '<li><a href="units.php">Units</a></li>' . PHP_EOL ;

        if (isset($_SESSION['isLoggedIn']) and $_SESSION['isLoggedIn'] === true) {
        //if (isLoggedIn()) {
            if (isset($_SESSION['userRole']) and $_SESSION['userRole'] === 'applicant'){
                $navbar .= <<<HTML
                <li><a href="profile.php">Profile</a></li>
HTML;
            }

            $navbar .= <<<HTML
                <!-- <a href="profile.php">profile</a> -->
                <li><a href="sign_out.php">sign out</a></li>
                <li><p>og Hi, {$_SESSION['givenName']}!</p></li>
HTML;
            if (isset($_SESSION['userRole']) and $_SESSION['userRole'] === 'staff') {
                $navbar .= <<<HTML
                <li><p>STAFF</p></li>
HTML;
            }
        }

        if (!isset($_SESSION['isLoggedIn']) or $_SESSION['isLoggedIn'] === false) {
            $navbar .= <<<HTML
                <li><a href="login.php">login</a></li>
HTML;
        }
        $navbar .= '</ul>';
        $navbar .= '</div>';
        $navbar .= '</nav>';
        return $navbar;
    }
?>