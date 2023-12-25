<?php
session_start();
include(__DIR__ . "/config.php");

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    if (isset($data->masp) && isset($data->soluong)) {
        $stmt = $conn->prepare("UPDATE giohang SET soluong = ? WHERE masp = ?");
        $stmt->bind_param("ss", $data->soluong, $data->masp);
        $stmt->execute();
        $stmt->close();
        echo json_encode(array("message" => "Quantity updated successfully."));
    } else {
        echo json_encode(array("message" => "Invalid data provided."));
    }
}

$conn->close();
?>
