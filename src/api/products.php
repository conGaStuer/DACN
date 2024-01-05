<?php
include(__DIR__ . "/config.php");


if (isset($_SERVER["PATH_INFO"])) {

    $masp = substr($_SERVER["PATH_INFO"], 1);


    $result = $conn->query("SELECT * FROM sanpham WHERE masp = '$masp'");


    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        header("Content-type: application/json");
        echo json_encode($data);
    } else {
        http_response_code(404); // Not Found
        echo json_encode(array("message" => "Sản phẩm không tồn tại"));
    }
} else {

    $result = $conn->query("SELECT * FROM sanpham");
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    header("Content-type: application/json");
    echo json_encode($data);
}

$conn->close();
?>
