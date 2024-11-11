
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Database Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="dash.css">
</head>

<body>
    <?php
    include 'db.php';
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
                        <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Profile</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Admin Tools</a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="../requests/requests.html">Requests <span class="badge text-bg-secondary">4</span></a></li>
                                <li><a class="dropdown-item" href="../users/users.html">Users</a></li>
                                <li><a class="dropdown-item" href="../transactions/transactions.html">Transactions</a></li>
                                <li><a class="dropdown-item" href="../../Products/Products.html">Products</a></li>
                                <li><a class="dropdown-item" href="#">Stock</a></li>
                                <li><a class="dropdown-item" href="#">Orders</a></li>
                                <li><a class="dropdown-item" href="../reports/reports.html">Reports</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Preview</a></li>
                                
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
        <div class="row">
            <h1 class="text-center">Admin Dashboard</h1>
        </div>
        <div class="row my-4">
            <div class="col-lg-6">
                <div class="card shadow-md bg-dark text-light border-secondary">
                    <div class="card-body">
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
                                <tr>
                                    <td>Ticket 1</td>
                                    <td>John Doe</td>
                                    <td>Issue 1</td>
                                    <td><span class="badge bg-warning text-dark">Open</span></td>
                                    <td>10:00 AM</td>
                                </tr>
                                <tr>
                                    <td>Ticket 2</td>
                                    <td>James Steward</td>
                                    <td>Issue 2</td>
                                    <td><span class="badge bg-secondary">Closed</span></td>
                                    <td>11:00 AM</td>
                                </tr>
                                <tr>
                                    <td>Ticket 3</td>
                                    <td>Jane Doe</td>
                                    <td>Issue 3</td>
                                    <td><span class="badge bg-warning text-dark">Open</span></td>
                                    <td>12:00 AM</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card shadow-md bg-dark text-light border-secondary">
                    <div class="card-body">
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
                                <tr>
                                    <td>Request 1</td>
                                    <td>John Doe</td>
                                    <td><span class="badge bg-warning text-dark">Pending</span></td>
                                    <td>10:00 AM</td>
                                </tr>
                                <tr>
                                    <td>Request 2</td>
                                    <td>James Steward</td>
                                    <td><span class="badge bg-success">Complete</span></td>
                                    <td>11:00 AM</td>
                                </tr>
                                <tr>
                                    <td>Request 3</td>
                                    <td>Jane Doe</td>
                                    <td><span class="badge bg-warning text-dark">Pending</span></td>
                                    <td>12:00 PM</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row my-4">
            <div class="col-lg-3">
                <div class="card border-danger">
                    <div class="card-header bg-danger text-white d-flex justify-content-between">
                        <h5 class="mb-0">Alerts <span class="badge bg-dark">4</span></h5>
                        <button class="btn btn-outline-light btn-sm" data-bs-toggle="collapse" data-bs-target="#alertsPanel">Toggle</button>
                    </div>
                    <div id="alertsPanel" class="collapse show">
                        <div class="card-body">
                            <ul id="alertsList" class="list-group">
                                <li class="list-group-item">Alert 1</li>
                                <li class="list-group-item">Alert 2</li>
                                <li class="list-group-item">Alert 3</li>
                                <li class="list-group-item">Alert 4</li>
                                <li class="list-group-item">Alert 5</li>
                                <li class="list-group-item">Alert 6</li>
                                <li class="list-group-item">Alert 7</li>
                                <li class="list-group-item">Alert 8</li>
                            </ul>
                            <a href="#" class="btn btn-danger mt-3">View All Alerts</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="card manage shadow-lg">
                            <div class="card-body">
                                <h5 class="card-title">Manage Users</h5>
                                <p class="card-text">List of users</p>
                                <a href="../users/users.html" class="btn btn-secondary">View All Users</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card manage shadow-lg">
                            <div class="card-body">
                                <h5 class="card-title">Today's Transactions</h5>
                                <p class="card-text">List of transactions</p>
                                <a href="#" class="btn btn-secondary">View All Transactions</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card manage shadow-lg">
                            <div class="card-body">
                                <h5 class="card-title">Manage Products</h5>
                                <p class="card-text">List of products</p>
                                <a href="../../Products/Products.html" class="btn btn-secondary">View All Products</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card manage shadow-lg">
                            <div class="card-body">
                                <h5 class="card-title">Manage Orders</h5>
                                <p class="card-text">List of orders</p>
                                <a href="#" class="btn btn-secondary">View All Orders</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row gap-4 mt-3 db-status shadow-md bg-dark p-3 rounded">
                    <h3 class="text-light">Database Status</h3>
                    <!-- Database Uptime -->
                    <div class="card border-success col">
                        <div class="card-header">Database Uptime</div>
                        <div class="card-body">
                            <h5 class="card-title">99.9%</h5>
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 99.9%;"
                                    aria-valuenow="99.9" aria-valuemin="0" aria-valuemax="100">99.9%</div>
                            </div>
                            <p class="card-text mt-2">Current uptime of the database.</p>
                        </div>
                    </div>
        
                    <!-- Response Time -->
                    <div class="card border-info col">
                        <div class="card-header">Response Time</div>
                        <div class="card-body">
                            <h5 class="card-title">120ms</h5>
                            <p class="card-text">Average query response time.</p>
                        </div>
                    </div>
        
                    <!-- Storage Usage -->
                    <div class="card border-danger col">
                        <div class="card-header">Storage Usage</div>
                        <div class="card-body">
                            <h5 class="card-title">75% Full</h5>
                            <div class="progress">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 75%;" aria-valuenow="75"
                                    aria-valuemin="0" aria-valuemax="100">75%</div>
                            </div>
                            <p class="card-text mt-2">Current storage utilization.</p>
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
