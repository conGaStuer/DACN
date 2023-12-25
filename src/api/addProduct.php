<?php
include(__DIR__ . "/config.php");

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    if (isset($data->action) && $data->action === 'add') {
        $productName = $data->productName;
        $categoryId = $data->categoryId;
        $image = $data->image;
        $manufacturerId = $data->manufacturerId;
        $price = $data->price;

        // Insert the new product into the database
        $stmt = $conn->prepare("INSERT INTO sanpham (tensp, maloai, hinhanh, mansx, gia) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssii", $productName, $categoryId, $image, $manufacturerId, $price);

        if ($stmt->execute()) {
            echo json_encode(array("message" => "Product added successfully."));
        } else {
            echo json_encode(array("message" => "Error adding product."));
        }

        $stmt->close();
    }
} else {
    echo json_encode(array("message" => "Invalid request method."));
}

$conn->close();
?>
