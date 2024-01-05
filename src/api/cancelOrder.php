<?php
session_start();
include(__DIR__ . "/config.php");

$data = json_decode(file_get_contents("php://input"));

if ($data->action == 'cancel') {
    $orderId = $data->orderId;


    $query1 = "DELETE FROM donhang WHERE madh = :orderId";
    $query2 = "DELETE FROM chitietdonhang WHERE madh = :orderId";

    $stmt1 = $pdo->prepare($query1);
    $stmt2 = $pdo->prepare($query2);

    $stmt1->bindParam(':orderId', $orderId);
    $stmt2->bindParam(':orderId', $orderId);

    if ($stmt1->execute() && $stmt2->execute()) {
        echo json_encode(['message' => 'Order canceled successfully.']);
    } else {
        echo json_encode(['message' => 'Failed to cancel order.']);
    }
}
?>
