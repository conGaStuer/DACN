<?php
include(__DIR__ . "/config.php");

// Check if the request method is GET
if ($_SERVER["REQUEST_METHOD"] === 'GET') {
    // Fetch all products from the database
    $query = "SELECT * FROM sanpham";
    $result = $conn->query($query);

    if ($result) {
        // Convert the result set into an associative array
        $products = array();
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }

        // Set the content type header to application/json
        header('Content-Type: application/json');

        // Encode the products as JSON and output it
        echo json_encode($products);
    } else {
        // Handle the case where the query fails
        echo json_encode(array("message" => "Error retrieving products."));
    }
} else {
    // Handle the case where the request method is not GET
    echo json_encode(array("message" => "Invalid request method."));
}

// Close the database connection
$conn->close();
?>
