<?php
session_start();
include(__DIR__ . "/config.php");

$query = "SELECT * FROM chiteitdonhang";
$result = $conn->query($query);

$orderDetails = array();
while ($row = $result->fetch_assoc()) {
    $orderDetails[] = $row;
}

echo json_encode($orderDetails);
?>