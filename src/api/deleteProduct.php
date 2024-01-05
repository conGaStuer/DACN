<?php
include(__DIR__ . "/config.php");


if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    if (isset($data->action) && $data->action === 'delete') {
        $productId = $data->productId;


        $stmt = $conn->prepare("DELETE FROM sanpham WHERE masp = ?");
        $stmt->bind_param("i", $productId);

        if ($stmt->execute()) {
            echo json_encode(array("message" => "Product deleted successfully."));
        } else {
            echo json_encode(array("message" => "Error deleting product."));
        }

        $stmt->close();
    }
} else {
    echo json_encode(array("message" => "Invalid request method."));
}

$conn->close();
?>
