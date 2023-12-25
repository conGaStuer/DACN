<?php
session_start();
include(__DIR__ . "/config.php");

if ($_SERVER["REQUEST_METHOD"] == 'POST') { 
    $data = json_decode(file_get_contents("php://input"));

    if (isset($data->action) && $data->action === 'register') {
        $newUsername = $data->username;
        $newPassword = $data->password;
    
        $stmt = $conn->prepare("INSERT INTO khachhang (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $newUsername, $newPassword);
    
        if ($stmt->execute()) {
            echo json_encode(array("message" => "User added successfully."));
        } else {
            echo json_encode(array("message" => "Error adding user."));
        }
    
        $stmt->close();
    }
    else if (isset($data->action) && $data->action === 'login') {
        $inputUsername  = $data->username;
        $inputPassword = $data->password;
    
        $stmt = $conn->prepare("SELECT * FROM khachhang WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $inputUsername, $inputPassword);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            $_SESSION['user'] = $user;

            echo json_encode(array("message" => "Login successful.", "user" => $_SESSION['user']));
        } else {
            echo json_encode(array("message" => "Invalid username or password."));
        }
        $stmt->close();
    }    
}

$conn->close();
?>
