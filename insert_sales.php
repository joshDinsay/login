<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "pos_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$product_name = $_POST['product_name'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
$total = $_POST['total'];
$receipt_number = $_POST['receipt_number'];

$sql = "INSERT INTO sales (product_name, quantity, price, total, receipt_number) 
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("siddi", $product_name, $quantity, $price, $total, $receipt_number);

if ($stmt->execute()) {
    echo json_encode(["success" => "Sales data inserted successfully."]);
} else {
    echo json_encode(["error" => "Failed to insert sales data."]);
}

$stmt->close();
$conn->close();
?>
