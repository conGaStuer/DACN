<?php
session_start();
include(__DIR__ . "/config.php");

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    if (isset($data->masp)) {
        $stmt = $conn->prepare("DELETE FROM giohang WHERE masp = ?");
        $stmt->bind_param("s", $data->masp);
        $stmt->execute();
        $stmt->close();
        echo json_encode(array("message" => "Item deleted successfully."));
    } else {
        echo json_encode(array("message" => "Invalid data provided."));
    }
}

$conn->close();
?>
