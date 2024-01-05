<?php
session_start();


if (isset($_SESSION['user'])) {
    $loggedIn = true;
    $user = $_SESSION['user'];
} else {
    $loggedIn = false;
    $user = null;
}

echo json_encode(array("loggedIn" => $loggedIn, "user" => $user));
?>
