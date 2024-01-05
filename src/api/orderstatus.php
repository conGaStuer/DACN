<?php

$conn = new mysqli("localhost", "username", "password", "database");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$query = "SELECT madh, order_status FROM chitietdonhang";


$result = $conn->query($query);


if ($result->num_rows > 0) {
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo "No data found.";
}


$conn->close();
?>
