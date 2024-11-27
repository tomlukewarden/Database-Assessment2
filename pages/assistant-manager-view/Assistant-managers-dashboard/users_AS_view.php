<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Database Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
<?php 
include '../../../config/db.php'; 
session_start();

// Limits access unless an assistant manager is logged in.
if($_SESSION['type'] == 'loyal' or is_null($_SESSION['type']) or $_SESSION['type'] == 'barista'){
    header('Location: /espresso-express/Database-Assessment2/pages/welcome_page.php');
}
?>

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

    <main class="mt-5 pt-4 container">
        <div class="container-fluid">
            <h5>Management Staff</h5>
            <?php
            $managerQuery = 'SELECT * 
            FROM Staff 
            WHERE position = "manager" OR position = "assistant"';
            $managerResult = $conn->query($managerQuery);
            ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                        <th scope="col">Name</th>
                            <th scope="col">Position</th>
                            <th scope="col">Staff ID</th>
                            <th scope="col">Store ID</th>
                            <th scope="col">Salary</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($managerResult->num_rows > 0) {
                            // Loop through and display each staff member
                            while ($row = $managerResult->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>{$row['first_name']} {$row['last_name']}</td>";
                                echo "<td>{$row['position']}</td>";
                                echo "<td>{$row['staff_id']}</td>";
                                echo "<td>{$row['store_id']}</td>";
                                echo "<td>{$row['salary']}</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No staff members found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="container-fluid">
            <h5>Staff Members</h5>
            <?php
            $staffQuery = 'SELECT * 
    FROM Staff
    WHERE position != "manager" AND position != "assistant"';
            $staffResult = $conn->query($staffQuery);
            ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Position</th>
                            <th scope="col">Staff ID</th>
                            <th scope="col">Store ID</th>
                            <th scope="col">Salary</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($staffResult->num_rows > 0) {
                            // Loop through and display each staff member
                            while ($row = $staffResult->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>{$row['first_name']} {$row['last_name']}</td>";
                                echo "<td>{$row['position']}</td>";
                                echo "<td>{$row['staff_id']}</td>";
                                echo "<td>{$row['store_id']}</td>";
                                echo "<td>{$row['salary']}</td>";
                                echo "<td><button type='button' class='btn btn-primary'>Edit</button></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No staff members found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>


        

        </tbody>
        </table>
        </div>
        </div>


    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>