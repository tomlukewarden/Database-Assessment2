<?php
include '../../config/db.php'; 
session_start();

// Limits access unless a manager is logged in.
if($_SESSION['type'] != 'manager'){
    header('Location: ../../welcome_page.php');
} 

// Loop through each month of the year 2024
for ($month = 1; $month <= 11; $month++) {
    for ($i = 1; $i <= 10; $i++) {
        $transactionId = (($month - 1) * 10) + $i; 
        $purchaseDate = "2024-" . str_pad($month, 2, "0", STR_PAD_LEFT) . "-01"; //se purchase date for the first of the month the transaction has been made

        $sql = "UPDATE transactions
                SET transaction_date = '$purchaseDate'
                WHERE transaction_id = $transactionId";
        
        if (!mysqli_query($conn, $sql)) {
            echo "Error updating transaction ID $transactionId: " . mysqli_error($conn);
        }
    }
}

//we are now on transaction number 110 - we did 11 months of 2024
//Loop through each month of 2023
for ($month = 1; $month <= 4; $month++) {
    for ($i = 1; $i <= 10; $i++) {
        $transactionId = 110 + (($month - 1) * 10) + $i; 
        $purchaseDate = "2023-" . str_pad($month, 2, "0", STR_PAD_LEFT) . "-01"; //se purchase date for the first of the month the transaction has been made

        $sql = "UPDATE transactions
                SET transaction_date = '$purchaseDate'
                WHERE transaction_id = $transactionId";
        
        if (!mysqli_query($conn, $sql)) {
            echo "Error updating transaction ID $transactionId: " . mysqli_error($conn);
        }
    }
}

echo "Purchase dates updated successfully.";
?>