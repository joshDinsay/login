<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pos_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$cartData = json_decode($_POST['cart'], true);
$totalAmount = $_POST['total'];

$receipt_number = rand(1000, 9999);

foreach ($cartData as $item) {
    $product_name = $item['product_name'];
    $quantity = $item['quantity'];
    $price = $item['price'];
    $total = $item['total'];

    $sql = "INSERT INTO sales (product_name, quantity, price, total, receipt_number, created_at) 
            VALUES ('$product_name', $quantity, $price, $total, $receipt_number, NOW())";

    if (!$conn->query($sql)) {
        echo "Error: " . $sql . "<br>" . $conn->error;
        exit;
    }
}

$conn->close();

$receiptContent = '';
foreach ($cartData as $item) {
    $receiptContent .= '<p>' . $item['product_name'] . ' (' . $item['quantity'] . '): ₱' . number_format($item['total'], 2) . '</p>';
}

$receiptContent .= '<hr><p><strong>Total: ₱' . number_format($totalAmount, 2) . '</strong></p>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout - POS System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .receipt {
      width: 60%;
      margin: 0 auto;
      font-family: Arial, sans-serif;
      border: 1px solid #000;
      padding: 20px;
      background-color: #f9f9f9;
    }
    .receipt-header {
      text-align: center;
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 20px;
    }
    .receipt-item {
      display: flex;
      justify-content: space-between;
      padding: 5px 0;
    }
    .total {
      font-weight: bold;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <h2 class="text-center">Checkout Summary</h2>

  <div class="receipt">
    <div class="receipt-header">
      <h4>Lechon POS System</h4>
      <p>Receipt Number: <?php echo $receipt_number; ?></p>
      <p>Date: <?php echo date("Y-m-d H:i:s"); ?></p>
    </div>

    <div class="receipt-body">
      <?php echo $receiptContent; ?>
    </div>

    <div class="text-center mt-4">
      <button class="btn btn-primary" onclick="window.print()">Print Receipt</button>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
