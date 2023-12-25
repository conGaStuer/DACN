<?php
include(__DIR__ . "/config.php");

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    if (isset($data->action) && $data->action === 'delete') {
        $userId = $data->userId;

        // Delete the user from the database
        $stmt = $conn->prepare("DELETE FROM khachhang WHERE maKH = ?");
        $stmt->bind_param("i", $userId);

        if ($stmt->execute()) {
            echo json_encode(array("message" => "User deleted successfully."));
        } else {
            echo json_encode(array("message" => "Error deleting user."));
        }

        $stmt->close();
    }
} else {
    echo json_encode(array("message" => "Invalid request method."));
}

$conn->close();
?>
