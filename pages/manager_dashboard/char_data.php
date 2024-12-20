<?php

include '../../config/db.php'; 
session_start();

if($_SESSION['type'] != 'manager'){
    header('Location: ../../welcome_page.php');
}   

$productNames = [];
$productTotalSalesPrice = [];

$sql = "SELECT p.product_name, p.price, COUNT(p.product_id) AS quantity FROM Transactions t JOIN Product p ON p.product_id = t.product_id GROUP BY p.product_id";
$result = mysqli_query($conn, $sql); 

if($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $productNames[] = $row['product_name'];
        $productTotalSalesPrice[] = $row['price'] * $row['quantity'];
    }
}

$data = [
    "product_name" => $productNames,
    "price" => $productTotalSalesPrice,

];

header('Content-Type: application/json');
if (empty($data)) {
    echo json_encode(['message' => 'No Product data found']);
} else {
    echo json_encode($data);
}
?>

