<?php
session_start();
include(__DIR__ . "/config.php");
// Truy vấn để lấy trạng thái từ bảng chitietdonhang
$query = "SELECT madh, order_status FROM chiteitdonhang";

// Thực hiện truy vấn
$result = $conn->query($query);

// Kiểm tra và trả về dữ liệu dưới dạng JSON
if ($result->num_rows > 0) {
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode(array("message" => "No data found."));
}

// Đóng kết nối
$conn->close();
?>