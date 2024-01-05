<?php
// Kết nối đến cơ sở dữ liệu
session_start();
include(__DIR__ . "/config.php");

// Kiểm tra xem người dùng đã đăng nhập chưa
if (isset($_SESSION["userId"])) {
    $userId = $_SESSION["userId"];

    // Truy vấn để lấy thông tin người dùng từ bảng users
    $query = "SELECT * FROM users WHERE maKH = ?";

    // Thực hiện truy vấn sử dụng prepared statement
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $userId);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $userData = $result->fetch_assoc();

        // Trả về dữ liệu dưới dạng JSON
        echo json_encode($userData);
    } else {
        echo json_encode(array("message" => "Failed to fetch user data."));
    }
} else {
    echo json_encode(array("message" => "User not logged in."));
}

// Đóng kết nối
$conn->close();
?>