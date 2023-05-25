<?php
    function generateNav() {
        require_once('utilities.php');
        
        $navbar = '<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
                <div class="container-fluid">
                <a href="index.php" class="navbar-brand">CorpU</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapseNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="units.php">Available Units</a>
                        </li>';

        if (isset($_SESSION['isLoggedIn']) and $_SESSION['isLoggedIn'] === true) {
        //if (isLoggedIn()) {
            if (isset($_SESSION['userRole']) and $_SESSION['userRole'] === 'applicant'){
                $navbar .= <<<HTML
                <li class="nav-item">
                    <a class="nav-link" href="timetable.php">Timetable</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
                <li class="nav-item"><a class = "nav-link"href="availability.php">Availability</a></li>

HTML;
            }

            if (isset($_SESSION['userRole']) and $_SESSION['userRole'] === 'staff') {
                $navbar .= <<<HTML
                <li class="nav-item">
                    <a class="nav-link" href="units_staff_view.php">Units</a>
                </li>
HTML;
            }

            $navbar .= <<<HTML
                <!-- <a href="profile.php">profile</a> -->
                <li class="nav-item"><a class="nav-link" href="sign_out.php">Sign Out</a></li>
                <li class="nav-item hidden-xs"><p class="nav-link">Hi, {$_SESSION['givenName']}!</p></li>
HTML;       if (isset($_SESSION['userRole']) and $_SESSION['userRole'] === 'staff') {
                $navbar .= <<<HTML
                <li class="nav-item hidden-xs"><p  class="nav-link">&nbspFT-STAFF</p></li>
HTML;
            }
        } else {
            $navbar .= <<<HTML
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li> 
HTML;
        }

        $navbar .= '</ul>
                    </div>
                    </div>
                    </nav>';
        return $navbar;
    }
?>