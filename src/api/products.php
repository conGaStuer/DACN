<?php
include(__DIR__ . "/config.php");

// Kiểm tra nếu có tham số trong đường dẫn
if (isset($_SERVER["PATH_INFO"])) {
    // Lấy mã sản phẩm từ đường dẫn
    $masp = substr($_SERVER["PATH_INFO"], 1);

    // Truy vấn sản phẩm theo mã sản phẩm
    $result = $conn->query("SELECT * FROM sanpham WHERE masp = '$masp'");

    // Kiểm tra xem có sản phẩm nào được tìm thấy hay không
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        header("Content-type: application/json");
        echo json_encode($data);
    } else {
        http_response_code(404); // Not Found
        echo json_encode(array("message" => "Sản phẩm không tồn tại"));
    }
} else {
    // Nếu không có tham số, trả về toàn bộ danh sách sản phẩm
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
