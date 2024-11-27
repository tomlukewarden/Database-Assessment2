
<?php 

include '../../config/db.php'; 
session_start();

// Limits access unless an assistant manager is logged in.
if($_SESSION['type'] != 'manager'){
    header('Location: ../welcome_page.php');
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Suppliers</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="dash.css">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

        <!--nav-->
        <nav class="navbar navbar-dark bg-dark fixed-top p-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Espresso Express Manager</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
                aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item"><a class="nav-link active" href="manager_dashboard.php">Manager Dashboard</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown">Manager Tools</a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li>
                                    <a class="dropdown-item active" href="manager_view_users.php">All Staff</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="transactions.php">Transactions</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="product_manager.php">Products</a></li>
                                <li>
                                    <a class="dropdown-item" href="suppliers_manager.php">Suppliers</a></li>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>


    <!-- MAIN CONTENT -->
    <main class="container my-5 pt-5">


        <!--products -->
        <div class="container-fluid">
            <h1>Suppliers</h1>

            <!-- FILTER PRODUCTS/ SEARCH FUNCTION -->
            <div class="container-fluid">
            <form name="table_properties" method="post" action="">
                    <label for="sort">Sort By:</label>
                        <!-- DROPDOWN FOR SORTING THE TABLE -->
                        <select class="btn btn-secondary" name="sort" id="sort">
                            <option value="sort_id_asc">Supplier ID Asc</option>
                            <option value="sort_id_desc">Supplier ID Desc</option>
                            <option value="sort_price_asc">Name Asc</option>
                            <option value="sort_price_desc">Name Desc</option>
                            <option value="sort_name_asc">Location Asc</option>
                            <option value="sort_name_desc">Location Desc</option>
                        </select> 
                    <button class="btn btn-secondary mx-3" type="submit">Sort</button>
                </form>
            </div>

            <!-- TABLE OF PRODUCTS -->
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col-md">Supplier ID</th>
                        <th scope="col-md">Supplier Name</th>
                        <th scope="col-md">Supplier Location</th>
                        <th scope="col-md">Product ID</th>
                    </tr>
                </thead>
                <tbody>
                        <?php

                            // DEFAULT QUERY
                            $sql = "SELECT * FROM supplier";

                            // RUN WHEN FORM IS SUBMITTED
                            if (isset($_POST['sort'])) {
                                $sortOption = $_POST['sort'];

                                //SET QUERY BASED ON WHAT IS SUBMITTED IN FORM.
                                switch ($sortOption) {
                                    case 'sort_id_asc':
                                        $sql = "SELECT * FROM supplier ORDER BY supplier_id ASC";
                                        break;
                                    case 'sort_id_desc':
                                        $sql = "SELECT * FROM supplier ORDER BY supplier_id DESC";
                                        break;
                                    case 'sort_price_asc':
                                        $sql = "SELECT * FROM supplier ORDER BY supplier_name ASC";
                                        break;
                                    case 'sort_price_desc':
                                        $sql = "SELECT * FROM supplier ORDER BY supplier_name DESC";
                                        break;
                                    case 'sort_name_asc':
                                        $sql = "SELECT * FROM supplier ORDER BY location ASC";
                                        break;
                                    case 'sort_name_desc':
                                        $sql = "SELECT * FROM supplier ORDER BY location DESC";
                                        break;
                                    default:
                                        $sql = "SELECT * FROM supplier";
                                        break;
                                }
                            }

                            $result = mysqli_query($conn, $sql);

                            if ($result) {
                                // DISPLAY SORTED TABLE
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['supplier_id'] . "</td>";
                                    echo "<td>" . $row['supplier_name'] . "</td>";
                                    echo "<td>" .$row['location'] . "</td>";
                                    echo "<td>" .$row['product_id'] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                // ERROR MSG
                                echo "<tr><td>Error: " . mysqli_error($conn) . "</td></tr>";
                            }
                        ?>


                </tbody>
            </table>

    </main>

    <footer class="container-fluid bg-dark position-absolute bottom-0">
        <br>
        <p class="text-light position-absolute start-50 top-50 translate-middle">&copy; Espresso Express</p>
        <br>
    </footer>

</body>

</html>