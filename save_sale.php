<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pos_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$inputData = json_decode(file_get_contents('php://input'), true);

$cart = $inputData['cart'];
$receipt_number = $inputData['receipt_number'];

foreach ($cart as $item) {
    $productName = $item['productName'];
    $price = $item['price'];
    $quantity = 1; 
    $total = $item['total'];
    $currentDateTime = date("Y-m-d H:i:s");

    $sql = "INSERT INTO sales (receipt_number, product_name, quantity, price, total, sale_date) 
            VALUES ('$receipt_number', '$productName', '$quantity', '$price', '$total', '$currentDateTime')";

    if (!$conn->query($sql)) {
        echo json_encode(['success' => false]);
        exit;
    }
}

$conn->close();
echo json_encode(['success' => true]);
?>
