
<?php 
include '../../../config/db.php'; 
session_start();

// Limits access unless an assistant manager is logged in.
if($_SESSION['type'] != 'assistant' $_SESSION['type'] != 'manager'){
    header('Location: ../../welcome_page.php');
}

?>


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

<header>
        <nav class="navbar navbar-dark bg-dark p-3">
            <div class="container-fluid">
                <?php
                    if($_SESSION['type'] == 'manager'){
                        echo '<a class="navbar-brand" href="#">Espresso Express Manager</a>';
                    }elseif($_SESSION['type'] == 'assistant'){
                        echo '<a class="navbar-brand" href="#">Espresso Express Assistant Manager</a>';
                    }elseif($_SESSION['type'] == 'admin'){
                        echo '<a class="navbar-brand" href="#">Espresso Admin</a>';
                    }elseif($_SESSION['type'] == 'loyal'){
                        echo '<a class="navbar-brand" href="#">Espresso Express Customer</a>';
                    }elseif($_SESSION['type'] == 'barista'){
                        echo '<a class="navbar-brand" href="#">Espresso Express Staff</a>';
                    }

                    if($_SESSION['type'] != 'loyal'){
                        echo'<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
                        aria-labelledby="offcanvasDarkNavbarLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Menu</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">';
                    }
                ?>

                                <?php
                                    if($_SESSION['type'] == 'manager'){
                                        echo'<li class="nav-item"><a class="nav-link" href="/espresso-express/Database-Assessment2/pages/manager_dashboard/manager_dashboard.php">Manager Dashboard</a></li>';
                                    }elseif($_SESSION['type'] == 'assistant'){
                                        echo'<li class="nav-item"><a class="nav-link" href="/espresso-express/Database-Assessment2/pages/assistant-manager-view/Assistant-managers-dashboard/assistant_manager_dashboard.php">Assistant Manager Dashboard</a></li>';
                                    }elseif($_SESSION['type'] == 'admin'){
                                        echo '<li class="nav-item"><a class="nav-link" href="/espresso-express/Database-Assessment2/pages/db-admin/dash.php">Admin Dashboard</a></li>';
                                    }
                                    if($_SESSION['type'] != 'loyal' && $_SESSION['type'] != 'admin' ){
                                        echo '<li class="nav-item"><a class="nav-link" href="/espresso-express/Database-Assessment2/pages/staff/staff_dashboard.php">Staff Dashboard</a></li>';
                                    }
                                    
                                    if($_SESSION['type'] == 'barista'){
                                        echo '<li class="nav-item"><a class="dropdown-item" href="/espresso-express/Database-Assessment2/pages/assistant-manager-view/Assistant-managers-dashboard/products_AS_view.php">Product</a></li>';
                                    }

                                ?>
                                <?php
                                    if($_SESSION['type'] != 'loyal' and $_SESSION['type'] != 'barista'){
                                        echo'<li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown">Tools</a>
                                    <ul class="dropdown-menu dropdown-menu-dark">
                                        <li>
                                            <a class="dropdown-item" href="/espresso-express/Database-Assessment2/pages/assistant-manager-view/Assistant-managers-dashboard/users_AS_view.php">All Staff</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="/espresso-express/Database-Assessment2/pages/assistant-manager-view/Assistant-managers-dashboard/transactions_AS_view.php">Transactions</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="/espresso-express/Database-Assessment2/pages/assistant-manager-view/Assistant-managers-dashboard/products_AS_view.php">Product</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="/espresso-express/Database-Assessment2/pages/assistant-manager-view/Assistant-managers-dashboard/suppliers_AS_view.php">Suppliers</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>';
                                    }
                                ?>
                
</div>
</nav>
    </header>

<main class="mt-5 pt-4">
    <div class="container-fluid">
        <header class="d-flex align-items-center mb-4">
            <h1 class="h2">Transactions</h1>
        </header>

        <?php
        
        // Fetch shop transactions
        $transactionQuery = "SELECT * FROM Transactions";
        $transactionResult = $conn->query($transactionQuery);
        ?>

        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <span>Shop Transactions</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Transaction ID</th>
                                <th scope="col">Customer ID</th>
                                <th scope="col">Product ID</th>
                                <th scope="col">Transaction Date</th>
                                <th scope="col">Name</th>
                                <th scope="col">Address</th>
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
                                    echo "<td>{$row['transaction_date']}</td>";
                                    echo "<td>{$row['name']}</td>";
                                    echo "<td>{$row['address']}</td>";
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
