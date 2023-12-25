<?php
include(__DIR__ . "/config.php");
// Start the session
session_start();

// Check if a user is logged in
if (isset($_SESSION['user'])) {
    // User is logged in
    $response = array(
        'user' => $_SESSION['user'],
        'loggedIn' => true
    );
} else {
    // User is not logged in
    $response = array(
        'user' => null,
        'loggedIn' => false
    );
}

// Set the content type header to application/json
header('Content-Type: application/json');

// Encode the response as JSON and output it
echo json_encode($response);
?>
