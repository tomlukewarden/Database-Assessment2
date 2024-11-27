<?php 
include '../../config/db.php';

session_start();

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: /espresso-express/Database-Assessment2/pages/login/login.php');
}

if($_SESSION['type'] != 'admin' or is_null($_SESSION['type'])){
    header('Location: /espresso-express/Database-Assessment2/pages/welcome_page.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Database Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!-- Navbar -->
    
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
                                        echo '<li class="nav-item"><a class="nav-link" href="/espresso-express/Database-Assessment2/pages/assistant-manager-view/Assistant-managers-dashboard/products_AS_view.php">Product</a></li>';
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
                            </ul>';
                        }

                        echo '<form action="" method="post">
                                        <button class="btn btn-primary m-3" type="submit" name="logout">Logout</button>
                                        </form>
                        </div>
                    </div>';
                                ?>
                
</div>
</nav>
    </header>

    <main class="container-fluid my-5 pt-5">
        <!-- Page Title -->
        <div class="row">
            <h1 class="text-center">Admin Dashboard</h1>
        </div>
                    <!-- Alerts Section -->
                    <?php
// Query to fetch only 'Open' or 'Acknowledged' alerts
$query = "SELECT alert_id, alert_type, alert_message FROM Alerts WHERE status IN ('Open', 'Acknowledged')";
$result = $conn->query($query);

// Count the alerts to display on the badge
$alert_count = $result->num_rows;
?>


        <!-- Tickets and Requests Section -->
        <div class="row my-4">
            <!-- Active Tickets -->
            <div class="col-lg-6">
                <div class="card shadow-md bg-light ">
                    <div class="card-body">
                        <?php

                        // Fetch open tickets
                        $query = "SELECT ticket_id, issue, staff_name, status, time_raised 
                                FROM tickets 
                                WHERE status = 'Open' 
                                ORDER BY time_raised DESC
                                LIMIT 5";
                        $result = $conn->query($query);
                        ?>
                        <h5 class="card-title">Active Tickets</h5>
                        <p class="card-text">Most recent tickets:</p>
                        <table class="table table-striped table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Ticket ID</th>
                                    <th scope="col">Staff Name</th>
                                    <th scope="col">Issue</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Time Raised</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result && $result->num_rows > 0) {
                                    // Display each open ticket
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<tr>';
                                        echo '<td>' . htmlspecialchars($row['ticket_id']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['staff_name']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['issue']) . '</td>';
                                        echo '<td><span class="badge bg-warning text-dark">' . htmlspecialchars($row['status']) . '</span></td>';
                                        echo '<td>' . htmlspecialchars($row['time_raised']) . '</td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="5" class="text-center">No open tickets found</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                        <a href="pages/tickets.php" class="btn btn-primary">View All Tickets</a>
                    </div>
                </div>
            </div>

            <!-- Requests from Management Staff -->
            <div class="col-sm-6">
                <div class="card shadow-md bg-light">
                    <div class="card-body">
                        <?php

                        // Fetch recent requests from the database
                        $query = "SELECT request_id, manager_name, request_details, status, time_requested 
          FROM requests 
          WHERE status = 'Pending' OR status = 'In Progress' 
          ORDER BY time_requested DESC 
          LIMIT 5";
                        $result = $conn->query($query);
                        ?>


                        <h5 class="card-title">Requests from Management Staff</h5>
                        <p class="card-text">Most recent requests:</p>
                        <table class="table table-striped table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Request</th>
                                    <th scope="col">Manager</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result && $result->num_rows > 0) {
                                    // Loop through and display each request
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<tr>';
                                        echo '<td>' . htmlspecialchars($row['request_details']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['manager_name']) . '</td>';

                                        // Display the status with appropriate badge class
                                        $status = htmlspecialchars($row['status']);
                                        if ($status == 'Pending') {
                                            echo '<td><span class="badge bg-warning text-dark">' . $status . '</span></td>';
                                        } elseif ($status == 'In Progress') {
                                            echo '<td><span class="badge bg-info text-dark">' . $status . '</span></td>';
                                        } elseif ($status == 'Complete') {
                                            echo '<td><span class="badge bg-success">' . $status . '</span></td>';
                                        }

                                        // Display time in a user-friendly format
                                        $time_requested = new DateTime($row['time_requested']);
                                        echo '<td>' . $time_requested->format('h:i A') . '</td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="4" class="text-center">No recent requests found</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                        <a href="pages/requests.php" class="btn btn-primary">View All Requests</a>
                    </div>

                </div>
            </div>

        </div>
<div class="container">
        <div class="row my-4">
        <div class="card col">
            <?php

        $query = 'SELECT alert_id, alert_type, alert_message FROM Alerts WHERE status IN ("Open", "Acknowledged")';
        $result = $conn->query($query);
        ?>
            <div class="card-header d-flex justify-content-between">
                <h5 class="mb-0">Alerts <span class="badge bg-danger"><?php echo $alert_count; ?></span></h5>
                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="collapse" data-bs-target="#alertsPanel">Toggle</button>
            </div>
            <div id="alertsPanel" class="collapse show">
                <div class="card-body">
                    <ul id="alertsList" class="list-group">
                        <?php
                        // Check if there are any results and loop through the fetched alerts
                        if ($result->num_rows > 0) {
                            while ($alert = $result->fetch_assoc()) {
                                echo "<li class='list-group-item'>";
                                echo "<strong>" . htmlspecialchars($alert['alert_type']) . ":</strong> ";
                                echo htmlspecialchars($alert['alert_message']);
                                echo "</li>";
                            }
                        } else {
                            echo "<li class='list-group-item'>No alerts</li>";
                        }
                        ?>
                    </ul>
                    <a href="./pages/alerts.php" class="btn btn-danger mt-3">View All Alerts</a>
                </div>
            </div>
    </div>
</div>
</div>
        <?php

$uptimeQuery = "SHOW GLOBAL STATUS LIKE 'Uptime'";
$uptimeResult = mysqli_query($conn, $uptimeQuery);

if ($uptimeResult) {
    $row = mysqli_fetch_assoc($uptimeResult);
    $uptime = $row['Value']; // Uptime in seconds
} else {
    echo "Error executing query: " . mysqli_error($conn);
}
mysqli_close($conn);
?>

<div class=" ml-5 row my-4 text-center ">
    <!-- Manage Section -->
    <div class="col-lg-12">
        <div class="row g-3">
            <div class="col-md-2">
                <div class="card manage shadow-lg">
                    <div class="card-header">Manage Users</div>
                    <div class="card-body">
                        <a href="../assistant-manager-view/Assistant-managers-dashboard/users_AS_view.php" class="btn btn-outline-primary">View All Users</a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card manage shadow-lg">
                    <div class="card-header">Manage Transactions</div>
                    <div class="card-body">
                        <a href="../assistant-manager-view/Assistant-managers-dashboard/transactions_AS_view.php" class="btn btn-outline-primary">View All Transactions</a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card manage shadow-lg">
                    <div class="card-header">Manage Products</div>
                    <div class="card-body">
                        <a href="../assistant-manager-view/Assistant-managers-dashboard/products_AS_view.php" class="btn btn-outline-primary">View All Products</a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card manage shadow-lg">
                    <div class="card-header">Database Uptime (seconds)</div>
                    <div class="card-body">
                        <h5 class="card-title "><?php echo $uptime; ?> seconds</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>


</main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>