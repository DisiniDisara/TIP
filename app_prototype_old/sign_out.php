<!-- Sign out user who have logged in -->

<?php
session_start();

// Clear all session data
$_SESSION = array();

// Delete the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroy the session
session_destroy();

// Set 
$_SESSION['isLoggedIn'] = false;

// Redirect the user to the index page
header("Location: index.php");
exit;
?>
