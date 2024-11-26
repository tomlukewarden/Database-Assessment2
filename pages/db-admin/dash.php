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
    <?php include 'db.php' ?>
    <nav class="navbar navbar-dark bg-dark fixed-top p-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Espresso Express Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
                aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Dashboard Menu</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item"><a class="nav-link active" href="dash.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="../login/profile.php">Profile</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Admin Tools</a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="pages/requests.php">Requests</a></li>
                                <li><a class="dropdown-item" href="pages/users.php">Users</a></li>
                                <li><a class="dropdown-item" href="pages/transactions.php">Transactions</a></li>
                                <li><a class="dropdown-item" href="#">Products</a></li>
                                <li><a class="dropdown-item" href="../Products/Products-staffView.php">Stock</a></li>
                                <li><a class="dropdown-item" href="#">Orders</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Reports</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex mt-3" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

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

<div class="row my-4">
        <div class="card border-danger">
            <div class="card-header bg-danger text-white d-flex justify-content-between">
                <h5 class="mb-0">Alerts <span class="badge bg-dark"><?php echo $alert_count; ?></span></h5>
                <button class="btn btn-outline-light btn-sm" data-bs-toggle="collapse" data-bs-target="#alertsPanel">Toggle</button>
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
                    <a href="#" class="btn btn-danger mt-3">View All Alerts</a>
                </div>
            </div>
    </div>
</div>


        <!-- Tickets and Requests Section -->
        <div class="row my-4">
            <!-- Active Tickets -->
            <div class="col-lg-6">
                <div class="card shadow-md bg-dark text-light border-secondary">
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
                            <thead class="table-dark">
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
                <div class="card shadow-md bg-dark text-light border-secondary">
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
                            <thead class="table-dark">
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

        <div class="row my-4 text-center">
                <!-- Manage Section -->
                <div class="col-lg-9">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <div class="card manage shadow-lg">
                                <div class="card-body">
                                    <h5 class="card-title">Manage Users</h5>
                                    <a href="../db-admin/pages/users.php" class="btn btn-secondary">View All Users</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card manage shadow-lg">
                                <div class="card-body">
                                    <h5 class="card-title">Manage Transactions</h5>
                                    <a href="../db-admin/pages/transactions.php" class="btn btn-secondary mt-3">View All
                                        Transactions</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card manage shadow-lg">
                                <div class="card-body">
                                    <h5 class="card-title">Manage Products</h5>
                                    <a href="#" class="btn btn-secondary">View All
                                        Products</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card manage shadow-lg">
                                <div class="card-body">
                                    <h5 class="card-title">Manage Orders</h5>
                                    <a href="#" class="btn btn-secondary">View All Orders</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Database Status -->
                <div class="row gap-4 mt-3 db-status shadow-md bg-dark p-3 rounded">
                    <h3 class="text-light">Database Status</h3>
                    <div class="col">
                        <div class="card border-success">
                            <div class="card-header">Database Uptime</div>
                            <div class="card-body">
                                <h5 class="card-title">99.9%</h5>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 99.9%;">99.9%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border-info">
                            <div class="card-header">Response Time</div>
                            <div class="card-body">
                                <h5 class="card-title">120ms</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border-danger">
                            <div class="card-header">Storage Usage</div>
                            <div class="card-body">
                                <h5 class="card-title">75% Full</h5>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 75%;">75%</div>
                                </div>
                            </div>
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