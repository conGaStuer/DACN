<?php
include(__DIR__ . "/config.php");

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    if (isset($data->action) && $data->action === 'edit') {
        $productId = $data->productId;
        $newProductName = $data->newProductName;
        $newCategoryId = $data->newCategoryId;
        $newImage = $data->newImage;
        $newManufacturerId = $data->newManufacturerId;
        $newPrice = $data->newPrice;

        // Update the product in the database
        $stmt = $conn->prepare("UPDATE sanpham SET tensp=?, maloai=?, hinhanh=?, mansx=?, gia=? WHERE masp=?");
        $stmt->bind_param("sssisi", $newProductName, $newCategoryId, $newImage, $newManufacturerId, $newPrice, $productId);

        if ($stmt->execute()) {
            echo json_encode(array("message" => "Product updated successfully."));
        } else {
            echo json_encode(array("message" => "Error updating product."));
        }

        $stmt->close();
    }
} else {
    echo json_encode(array("message" => "Invalid request method."));
}

$conn->close();
?>
