<?php
    function generateNav() {
        require_once('utilities.php');
        
        $navbar = '<nav class="navbar navbar-default">' .
            '<a href="index.php">Home</a>' . PHP_EOL .
            '<a href="units.php">Units</a>';

        if (isset($_SESSION['isLoggedIn']) and $_SESSION['isLoggedIn'] === true) {
        //if (isLoggedIn()) {
            if (isset($_SESSION['userRole']) and $_SESSION['userRole'] === 'applicant'){
                $navbar .= <<<HTML
                <a href="profile.php">profile</a>
HTML;
            }

            $navbar .= <<<HTML
                <!-- <a href="profile.php">profile</a> -->
                <a href="sign_out.php">sign out</a>
                og Hi, {$_SESSION['givenName']}!
HTML;
            if (isset($_SESSION['userRole']) and $_SESSION['userRole'] === 'staff') {
                $navbar .= <<<HTML
                STAFF
HTML;
            }
        }

        if (!isset($_SESSION['isLoggedIn']) or $_SESSION['isLoggedIn'] === false) {
            $navbar .= <<<HTML
                <a href="login.php">login</a>
HTML;
        }

        $navbar .= '</nav>';

        return $navbar;
    }
?>