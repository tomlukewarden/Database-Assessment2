
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <nav class="navbar navbar-dark bg-dark fixed-top p-3 mb-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Espresso Express Staff</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                aria-label="Toggle navigation">
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
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Profile</a>
                        </li>
                    </ul>
                    <form class="d-flex mt-3" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </nav>


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

    <footer class="container-fluid bg-dark position-relative">
        <br>
        <p class="text-light position-absolute start-50 top-50 translate-middle">&copy; Espresso Express</p>
        <br>
    </footer>

</body>

</html>

