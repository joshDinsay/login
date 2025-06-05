<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pos_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$selectedMonth = $_GET['month']; 

$monthlySalesQuery = "
    SELECT 
        DATE_FORMAT(created_at, '%Y-%m') AS month,
        SUM(total) AS total_sales
    FROM sales
    WHERE DATE_FORMAT(created_at, '%Y-%m') = ?
    AND product_name NOT IN ('lechon', 'lechon_baboy', 'liempo')
    GROUP BY month
    ORDER BY month DESC";

$stmt = $conn->prepare($monthlySalesQuery);
$stmt->bind_param("s", $selectedMonth);
$stmt->execute();
$result = $stmt->get_result();

$months = [];
$totalMonthlySales = [];

while ($row = $result->fetch_assoc()) {
    $months[] = $row['month'];
    $totalMonthlySales[] = $row['total_sales'];
}

echo json_encode(['months' => $months, 'total_sales' => $totalMonthlySales]);
?>
