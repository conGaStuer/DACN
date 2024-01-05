<?php
session_start();
include(__DIR__ . "/config.php");

// Lấy thông tin từ request
$data = json_decode(file_get_contents("php://input"), true); // Decode as associative array

if (isset($data['action'], $data['orderId']) && $data['action'] === "approve") {
  try {
    $orderId = $data['orderId'];

    // Kiểm tra và thực hiện cập nhật trạng thái
    $updateStatusQuery = "UPDATE chiteitdonhang SET order_status = 'Delivering' WHERE madh = ?";
    $stmtUpdateStatus = $conn->prepare($updateStatusQuery);
    $stmtUpdateStatus->bind_param('i', $orderId);

    if ($stmtUpdateStatus->execute()) {
      echo json_encode(array("success" => true, "message" => "Order approved successfully"));
    } else {
      throw new Exception("Failed to update order status");
    }
  } catch (Exception $e) {
    error_log($e->getMessage());
    echo json_encode(array("success" => false, "error" => $e->getMessage()));
  } finally {
    // Đảm bảo đóng kết nối dù có lỗi hay không
    if ($stmtUpdateStatus) {
      $stmtUpdateStatus->close();
    }
    $conn->close();
  }
} else {
  echo json_encode(array("success" => false, "error" => "Invalid request"));
}
?>