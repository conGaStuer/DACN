<?php
session_start();
include(__DIR__ . "/config.php");

if ($_SERVER["REQUEST_METHOD"] == 'POST') { 
    $data = json_decode(file_get_contents("php://input"));

    if (isset($data->masp) && isset($data->tensp) && isset($data->hinhanh) && isset($data->gia)) {
        // Check if the product is already in the cart
        $stmt = $conn->prepare("SELECT * FROM giohang WHERE masp = ?");
        $stmt->bind_param("s", $data->masp);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            // Product already exists in the cart, update the quantity and total price
            $stmt = $conn->prepare("UPDATE giohang SET soluong = soluong + 1, tongtien = gia * (soluong + 1) WHERE masp = ?");
            $stmt->bind_param("s", $data->masp);
            $stmt->execute();
            $stmt->close();
            echo json_encode(array("message" => "Item quantity updated in cart."));
        } else {
            // Product doesn't exist in the cart, insert a new row
            $stmt = $conn->prepare("INSERT INTO giohang (masp, tensp, hinhanh, gia, soluong, tongtien) VALUES (?, ?, ?, ?, 1, ?)");
            $stmt->bind_param("ssssd", $data->masp, $data->tensp, $data->hinhanh, $data->gia, $data->gia);
            $stmt->execute();
            $stmt->close();
            echo json_encode(array("message" => "Item added to cart successfully."));
        }
    } else {
        echo json_encode(array("message" => "Invalid data provided."));
    }
}

$conn->close();
?>
