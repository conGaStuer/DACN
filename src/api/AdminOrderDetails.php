<?php
include(__DIR__ . "/config.php");


if (isset($_GET['orderId'])) {
    $orderId = $_GET['orderId'];


    $getOrderDetailsQuery = "SELECT * FROM chiteitdonhang WHERE madh = ?";

    $stmt = $conn->prepare($getOrderDetailsQuery);
    $stmt->bind_param('i', $orderId);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $orderDetails = array();

        while ($row = $result->fetch_assoc()) {
            $orderDetails[] = $row;
        }

        echo json_encode($orderDetails);
    } else {
        echo json_encode(array("message" => "Failed to fetch order details"));
    }
} else {
    echo json_encode(array("message" => "Invalid request, orderId not provided"));
}

?>
