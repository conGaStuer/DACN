<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['user'])) {
    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    echo json_encode(array("message" => "Logout successful"));
} else {
    echo json_encode(array("message" => "No user to logout"));
}
?>
