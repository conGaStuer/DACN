<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['user'])) {
    $loggedIn = true;
    $user = $_SESSION['user'];
} else {
    $loggedIn = false;
    $user = null;
}

echo json_encode(array("loggedIn" => $loggedIn, "user" => $user));
?>
