<?php
include(__DIR__ . "/config.php");


if ($_SERVER["REQUEST_METHOD"] === 'GET') {

    $query = "SELECT * FROM khachhang";
    $result = $conn->query($query);

    if ($result) {

        $users = array();
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }


        header('Content-Type: application/json');


        echo json_encode($users);
    } else {

        echo json_encode(array("message" => "Error retrieving users."));
    }
} else {
    echo json_encode(array("message" => "Invalid request method."));
}

$conn->close();
?>
