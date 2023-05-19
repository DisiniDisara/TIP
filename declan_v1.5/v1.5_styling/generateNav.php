<?php
    function generateNav() {
        $navbar = '<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
                        <div class="container-fluid">
                        <a href="index.php" class="navbar-brand">CorpU</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="collapseNav">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="units2.php">Available Units</a>
                                </li>
                                ';

        if (isset($_SESSION['isLoggedIn']) and $_SESSION['isLoggedIn'] === true) {
            $navbar .= <<<HTML
                <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sign_out.php">Sign Out</a>
                </li>
                <li class="nav-item">
                <a class="nav-link"> Hi, {$_SESSION['givenName']}!</a>
                </li>
    HTML;
        }

        if (!isset($_SESSION['isLoggedIn']) or $_SESSION['isLoggedIn'] === false) {
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