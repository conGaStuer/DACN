<?php
session_start();


if (isset($_SESSION['user'])) {

    $_SESSION = array();


    session_destroy();

    echo json_encode(array("message" => "Logout successful"));
} else {
    echo json_encode(array("message" => "No user to logout"));
}
?>
