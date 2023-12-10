<?php

include(__DIR__ . "/config.php");
include(__DIR__ . "/api.php");

print_r($_SESSION);
function checkLogin() {
    if(isset($_SESSION['user'])) {
        return $_SESSION['user'] ;
    } else {
        return null;
    }
}



if($_SERVER["REQUEST_METHOD"] == "GET") {
    $loggedUser = checkLogin();
    if ($loggedUser) {
        echo json_encode(array("user" => $loggedUser));
    } else {
        echo json_encode(array("user" => null));
    }
} 

