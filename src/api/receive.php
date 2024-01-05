<?php
session_start();
include(__DIR__ . "/config.php");

// Kiểm tra xem có tham số orderId được truyền không
if (isset($_POST['orderId'])) {
    $orderId = $_POST['orderId'];

    // Cập nhật trạng thái đã nhận hàng trong bảng chitietdonhang
    $updateQuery = "UPDATE chitietdonhang SET received_status = 'Received' WHERE madh = ?";
    $stmtUpdate = $conn->prepare($updateQuery);
    $stmtUpdate->bind_param('i', $orderId);

    // Thực hiện cập nhật
    if ($stmtUpdate->execute()) {
        echo json_encode(array("success" => true, "message" => "Order received successfully"));
    } else {
        echo json_encode(array("success" => false, "error" => "Failed to update received status"));
    }

    // Đóng kết nối
    $stmtUpdate->close();
    $conn->close();
} else {
    echo json_encode(array("success" => false, "error" => "Invalid request. Please provide an order ID."));
}
