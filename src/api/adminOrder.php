<?php
session_start();
include(__DIR__ . "/config.php");


$ordersQuery = "SELECT * FROM donhang";
$ordersResult = $conn->query($ordersQuery);

$orders = array();

if ($ordersResult->num_rows > 0) {
    while ($row = $ordersResult->fetch_assoc()) {
        $orderId = $row['madh'];


        $orderDetailsQuery = "SELECT * FROM chiteitdonhang WHERE madh = $orderId";
        $orderDetailsResult = $conn->query($orderDetailsQuery);

        $orderDetails = array();
        while ($orderDetailRow = $orderDetailsResult->fetch_assoc()) {
            $orderDetails[] = $orderDetailRow;
        }

        $row['orderDetails'] = $orderDetails;
        $orders[] = $row;
    }
}


echo json_encode($orders);

$conn->close();
?>
