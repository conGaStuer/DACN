<?php
include(__DIR__ . "/config.php");

// Check if the request method is GET
if ($_SERVER["REQUEST_METHOD"] === 'GET') {
    // Fetch all users from the database
    $query = "SELECT * FROM khachhang";
    $result = $conn->query($query);

    if ($result) {
        // Convert the result set into an associative array
        $users = array();
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }

        // Set the content type header to application/json
        header('Content-Type: application/json');

        // Encode the users as JSON and output it
        echo json_encode($users);
    } else {
        // Handle the case where the query fails
        echo json_encode(array("message" => "Error retrieving users."));
    }
} else {
    echo json_encode(array("message" => "Invalid request method."));
}

$conn->close();
?>
