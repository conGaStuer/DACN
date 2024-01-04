<?php
session_start();
include(__DIR__ . "/config.php");

// Get orders and order details from the database
$ordersQuery = "SELECT * FROM donhang";
$ordersResult = $conn->query($ordersQuery);

$orders = array();

if ($ordersResult->num_rows > 0) {
    while ($row = $ordersResult->fetch_assoc()) {
        $orderId = $row['madh'];

        // Get order details for each order
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

// Return the orders and order details as JSON
echo json_encode($orders);

$conn->close();
?>
