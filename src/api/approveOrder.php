<?php
session_start();
include(__DIR__ . "/config.php");


if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $requestData = json_decode(file_get_contents("php://input"), true);


  if ($requestData["action"] === "approve") {

    $orderId = $requestData["orderId"];


    $success = updateOrderStatus($conn, $orderId, "Delivering");

    if ($success) {

      echo json_encode(["success" => true, "message" => "Order approved successfully"]);
    } else {

      echo json_encode(["success" => false, "error" => "Failed to approve order"]);
    }
  } else {

    echo json_encode(["success" => false, "error" => "Invalid action"]);
  }
} else {

  echo json_encode(["success" => false, "error" => "Invalid request method"]);
}


function updateOrderStatus($conn, $orderId, $newStatus)
{

  if (!isset($conn) || !($conn instanceof mysqli)) {

    return false;
  }


  $sql = "UPDATE orders SET order_status = ? WHERE order_id = ?";
  $stmt = $conn->prepare($sql);

  if (!$stmt) {

    return false;
  }

  $stmt->bind_param("si", $newStatus, $orderId);
  $result = $stmt->execute();


  $stmt->close();
  return $result;
}
?>