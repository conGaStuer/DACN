<?php
include(__DIR__ . "/config.php");


if ($_SERVER["REQUEST_METHOD"] === 'GET') {

    $query = "SELECT * FROM sanpham";
    $result = $conn->query($query);

    if ($result) {

        $products = array();
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }


        header('Content-Type: application/json');


        echo json_encode($products);
    } else {

        echo json_encode(array("message" => "Error retrieving products."));
    }
} else {

    echo json_encode(array("message" => "Invalid request method."));
}


$conn->close();
?>
