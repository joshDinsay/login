<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pos_system";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true); 

foreach ($data as $item) {
    $user_id = $_SESSION['user_id'];
    $product_name = $item['product_name'];
    $quantity = $item['quantity'];
    $price = $item['price'];
    $total = $item['total'];
    $created_at = date("Y-m-d H:i:s");

    $sql = "INSERT INTO sales (user_id, product_name, quantity, price, total, created_at) 
            VALUES ('$user_id', '$product_name', '$quantity', '$price', '$total', '$created_at')";

    if (!$conn->query($sql)) {
        echo json_encode(["status" => "error", "message" => "Failed to insert record"]);
        exit();
    }
}

echo json_encode(["status" => "success", "message" => "Checkout successful"]);
$conn->close();
?>
