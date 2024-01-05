<?php
session_start();
include(__DIR__ . "/config.php");


$data = json_decode(file_get_contents("php://input"));

if (isset($data->orderId)) {
    $orderId = $data->orderId;


    $deleteOrderQuery = "DELETE FROM donhang WHERE madh = ?";
    $stmt = $conn->prepare($deleteOrderQuery);
    $stmt->bind_param('i', $orderId);

    if ($stmt->execute()) {

        $deleteOrderDetailsQuery = "DELETE FROM chiteitdonhang WHERE madh = ?";
        $stmtOrderDetails = $conn->prepare($deleteOrderDetailsQuery);
        $stmtOrderDetails->bind_param('i', $orderId);
        $stmtOrderDetails->execute();

        echo json_encode(array("message" => "Order deleted successfully"));
    } else {
        echo json_encode(array("message" => "Failed to delete order"));
    }
} else {
    echo json_encode(array("message" => "Invalid request"));
}
?>
