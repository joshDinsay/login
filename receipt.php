<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$receipt_number = $_GET['receipt_number'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pos_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM sales WHERE receipt_number = $receipt_number";
$result = $conn->query($sql);

$salesData = [];
$totalAmount = 0;

while ($row = $result->fetch_assoc()) {
    $salesData[] = $row;
    $totalAmount += $row['total'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Receipt - POS System</title>
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

<div class="receipt">
  <div class="receipt-header">
    <h4>Lechon POS System</h4>
    <p>Receipt Number: <?php echo $receipt_number; ?></p>
    <p>Date: <?php echo date("Y-m-d H:i:s"); ?></p>
  </div>

  <div class="receipt-body">
    <?php foreach ($salesData as $sale): ?>
      <div class="receipt-item">
        <span><?php echo $sale['product_name']; ?> (<?php echo $sale['quantity']; ?>)</span>
        <span>₱<?php echo number_format($sale['total'], 2); ?></span>
      </div>
    <?php endforeach; ?>

    <div class="receipt-item total">
      <span>Total Amount</span>
      <span>₱<?php echo number_format($totalAmount, 2); ?></span>
    </div>
  </div>

  <div class="receipt-footer text-center mt-4">
    <button class="btn btn-primary" onclick="window.print()">Print Receipt</button>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
