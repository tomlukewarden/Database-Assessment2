<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tickets</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="tickets.css">
</head>

<body>
<?php 
include '../db.php'; 
?>

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
                        <li class="nav-item"><a class="nav-link active" href="../dash.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="../../login/profile.php">Profile</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Admin Tools</a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="./requests.php">Requests <span class="badge text-bg-secondary">4</span></a></li>
                                <li><a class="dropdown-item" href="./users.php">Users</a></li>
                                <li><a class="dropdown-item" href="./transactions.php">Transactions</a></li>
                                <li><a class="dropdown-item" href="#">Products</a></li>
                                <li><a class="dropdown-item" href="../../Products/Products-staffView.php">Stock</a></li>
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

    <main class="mt-5 pt-4">
        <div class="container-fluid">
            <header class="d-flex align-items-center mb-4">
                <h1 class="h2">Tickets</h1>
                <p class="ms-3 text-muted">Overview of tickets and their statuses.</p>
            </header>

            <?php
            
            // Fetch tickets
            $ticketQuery = "SELECT * FROM tickets";
            $ticketResult = $conn->query($ticketQuery);
            ?>

            <div class="card col">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <span>Ticket Management</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Ticket ID</th>
                                    <th scope="col">Issue</th>
                                    <th scope="col">Staff Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Time Raised</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($ticketResult->num_rows > 0) {
                                    while ($row = $ticketResult->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>{$row['ticket_id']}</td>";
                                        echo "<td>{$row['issue']}</td>";
                                        echo "<td>{$row['staff_name']}</td>";

                                        // Handle status badge
                                        $status = htmlspecialchars($row['status']);
                                        if ($status == 'Open') {
                                            echo '<td><span class="badge bg-warning text-dark">' . $status . '</span></td>';
                                        } elseif ($status == 'Closed') {
                                            echo '<td><span class="badge bg-info text-dark">' . $status . '</span></td>';
                                        } else {
                                            echo '<td><span class="badge bg-secondary text-light">' . $status . '</span></td>';
                                        }

                                        echo "<td>{$row['time_raised']}</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>No tickets found</td></tr>";
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
