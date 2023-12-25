<?php
session_start();
include(__DIR__ . "/config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $data = json_decode(file_get_contents("php://input"));

  if (!empty($data->cartItems)) {
    $cartItems = $data->cartItems;
    $totalPrice = 0;

    foreach ($cartItems as $item) {
      $totalPrice += ($item->gia * $item->soluong);
    }

    $stmt = $conn->prepare("INSERT INTO donhang (masp, tensp, maloai, tongtien) VALUES (?, ?, ?, ?)");
    foreach ($cartItems as $item) {
      $stmt->bind_param("sssi", $item->masp, $item->tensp, $item->maloai, $totalPrice);
      $stmt->execute();
    }
    $stmt->close();

    $stmt = $conn->prepare("DELETE FROM giohang");
    $stmt->execute();
    $stmt->close();

    echo json_encode(array("message" => "Order placed successfully"));
  } else {
    echo json_encode(array("message" => "Invalid data provided"));
  }
}

$conn->close();
?>
