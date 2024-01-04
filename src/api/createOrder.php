<?php
session_start();
include(__DIR__ . "/config.php");

// Get cart items from the request
$data = json_decode(file_get_contents("php://input"));

if (isset($data->cartItems) && is_array($data->cartItems)) {
    // Insert new order into the donhang table
    $insertOrderQuery = "INSERT INTO donhang (tongtien, maKH) VALUES (?, ?)";
    
    // You may need to get the total amount and customer ID from your logic
    $totalAmount = 0;
    $customerId = 1; // Replace with actual customer ID
    
    $stmt = $conn->prepare($insertOrderQuery);
    $stmt->bind_param('ii', $totalAmount, $customerId);
    
    if ($stmt->execute()) {
        $orderId = $conn->insert_id;
        
        // Insert order items into the chiteitdonhang table
        $insertOrderItemsQuery = "INSERT INTO chiteitdonhang (madh, masp, soluong, gia, tensp, hinhanh) VALUES (?, ?, ?, ?, ?, ?)";
$stmtOrderItems = $conn->prepare($insertOrderItemsQuery);
        
        foreach ($data->cartItems as $cartItem) {
            $stmtOrderItems->bind_param('idisss', $orderId, $cartItem->masp, $cartItem->soluong, $cartItem->gia, $cartItem->tensp, $cartItem->hinhanh);
            
            $stmtOrderItems->execute();
        }
        
        echo json_encode(array("message" => "Order placed successfully"));
    } else {
        echo json_encode(array("message" => "Failed to create order"));
    }
} else {
    echo json_encode(array("message" => "Invalid request"));
}
?>