<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Transactions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

<?php 
include '../components/navbar.php';
include '../db.php'; 
?>

<main class="mt-5 pt-4">
    <div class="container-fluid">
        <header class="d-flex align-items-center mb-4">
            <h1 class="h2">Transactions</h1>
            <p class="ms-3 text-muted">Overview of recent transactions and sales.</p>
        </header>

        <?php
        
        // Fetch shop transactions
        $transactionQuery = "SELECT * FROM Transactions";
        $transactionResult = $conn->query($transactionQuery);
        ?>

        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <span>Shop Transactions</span>
                <button class="btn btn-sm btn-success">Add New Transaction</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Transaction ID</th>
                                <th scope="col">Customer ID</th>
                                <th scope="col">Product ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($transactionResult->num_rows > 0) {
                                while ($row = $transactionResult->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>{$row['transaction_id']}</td>";
                                    echo "<td>{$row['customer_id']}</td>";
                                    echo "<td>{$row['product_id']}</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3' class='text-center'>No shop transactions found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php
        // Close the database connection
        $conn->close();
        ?>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
