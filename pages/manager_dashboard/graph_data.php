<?php

include '../../config/db.php'; 
session_start();

if($_SESSION['type'] != 'manager'){
    header('Location: ../../welcome_page.php');
}   

$transactions = [];

#

$sql = "SELECT 
        YEAR(transaction_date) AS year,
        MONTH(transaction_date) AS month,
        SUM(p.price) AS total_sales
    FROM Transactions t 
    JOIN Product p ON p.product_id = t.product_id
    WHERE YEAR(transaction_date) = 2024 #put in the current year
    GROUP BY year, month
    ORDER BY month ASC";

$result = mysqli_query($conn, $sql); 

if($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $transactions[] = [
            "year" => $row['year'],
            "month" => $row['month'],
            "total" => $row['total_sales'],
        ];
    }
}

header('Content-Type: application/json');
if (empty($transactions)) {
    echo json_encode(['message' => 'No transaction data found']);
} else {
    echo json_encode($transactions);
}

?>

