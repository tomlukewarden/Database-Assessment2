
<?php 

include '../../../config/db.php'; 
session_start();

// Limits access unless an assistant manager is logged in.
if($_SESSION['type'] == 'loyal'){
    header('Location: ../../welcome_page.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Products</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="dash.css">
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

    
    <!-- MAIN CONTENT -->
    <main class="container my-5 pt-5">

        
            <!--products -->
            <div class="container-fluid">
                <h1>Products</h1>

                <!-- FILTER PRODUCTS/ SEARCH FUNCTION -->
                <div class="container-fluid">

                </div>
                
                <!-- <form name="Table Properties" method="post" action="">
                    Order by price
                    <button type="submit" name="sort_price_asc" class="button" value="1"> Sort Price ASC</button>
                    <button type="submit" name="sort_price_desc" class="button" value="1"> Sort Price DESC</button>
                </form> -->


                <form name="table_properties" method="post" action="">
                    <label for="sort">Sort By:</label>
                        <!-- DROPDOWN FOR SORTING THE TABLE -->
                        <select class="btn btn-secondary" name="sort" id="sort">
                            <option value="sort_id_asc">ID Asc</option>
                            <option value="sort_id_desc">ID Desc</option>
                            <option value="sort_price_asc">Price Asc</option>
                            <option value="sort_price_desc">Price Desc</option>
                            <option value="sort_name_asc">Name Asc</option>
                            <option value="sort_name_desc">Name Desc</option>
                        </select> 
                    <button class="btn btn-secondary mx-3" type="submit">Sort</button>
                </form>

                <!-- TABLE OF PRODUCTS -->
                    <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col-md">#</th>
                            <th scope="col-md">Product Name</th>
                            <th scope="col-md">Price</th>
                        </tr>
                    </thead>

                    <tbody>
                        
                    <?php
                        // CONNECT TO DATABASE
                        include '../../../config/db.php'; 

                        // DEFAULT QUERY
                        $sql = "SELECT * FROM product";

                        // RUN WHEN FORM IS SUBMITTED
                        if (isset($_POST['sort'])) {
                            $sortOption = $_POST['sort'];

                            //SET QUERY BASED ON WHAT IS SUBMITTED IN FORM.
                            switch ($sortOption) {
                                case 'sort_id_asc':
                                    $sql = "SELECT * FROM product ORDER BY product_id ASC";
                                    break;
                                case 'sort_id_desc':
                                    $sql = "SELECT * FROM product ORDER BY product_id DESC";
                                    break;
                                case 'sort_price_asc':
                                    $sql = "SELECT * FROM product ORDER BY price ASC";
                                    break;
                                case 'sort_price_desc':
                                    $sql = "SELECT * FROM product ORDER BY price DESC";
                                    break;
                                case 'sort_name_asc':
                                    $sql = "SELECT * FROM product ORDER BY product_name ASC";
                                    break;
                                case 'sort_name_desc':
                                    $sql = "SELECT * FROM product ORDER BY product_name DESC";
                                    break;
                                default:
                                    $sql = "SELECT * FROM product";
                                    break;
                            }
                        }

                        $result = mysqli_query($conn, $sql);

                        if ($result) {
                            // DISPLAY SORTED TABLE
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['product_id'] . "</td>";
                                echo "<td>" . $row['product_name'] . "</td>";
                                echo "<td>£" .$row['price'] . ".00</td>";
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


