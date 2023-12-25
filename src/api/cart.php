<?php
session_start();
include(__DIR__ . "/config.php");

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    $stmt = $conn->prepare("SELECT * FROM giohang");
    $stmt->execute();
    $result = $stmt->get_result();
    $cartItems = [];

    while ($row = $result->fetch_assoc()) {
        $cartItems[] = $row;
    }

    $stmt->close();
    echo json_encode($cartItems);
}

$conn->close();
?>
