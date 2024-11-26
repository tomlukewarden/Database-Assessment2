<!DOCTYPE html>
<html>
<?php session_start(); ?>
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
            <a class="navbar-brand" href="#">Espresso Express</a>
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

    <!-- PHP FOR ADDING TO BASKET -->
    <?php
    if (!isset($_SESSION['basket'])) {
    $_SESSION['basket'] = [];
    }

    if (isset($_POST['add_to_basket'])) {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $price = $_POST['price'];
    
        // Check if the product is already in the basket
        if (isset($_SESSION['basket'][$product_id])) {
            // Increment the quantity
            $_SESSION['basket'][$product_id]['quantity'] += 1;
        } else {
            // Add the product to the basket
            $_SESSION['basket'][$product_id] = [
                'product_name' => $product_name,
                'price' => $price,
                'quantity' => 1
            ];
        }
    }

    if (isset($_POST['clear_basket'])) {
        unset($_SESSION['basket']);
    }

    // PHP FOR CLEARING THE BASKET:









    ?>



    <!-- MAIN CONTENT -->
    <main class="container my-5 pt-5">

        <!-- BASKET -->
        <div class="row">
            <div class="card border-secondary col">
                <div class="card-header"> <strong>Your Basket</strong></div>
                <div class="card-body">
                    <!-- ACCORDION FOR BASKET ITEMS -->
                    <div class="accordion" id="accordion1">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Items In Your Basket
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordion1">
                                <div class="accordion-body">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col-md">#</th>
                                                <th scope="col-md">Product</th>
                                                <th> </th>
                                                <th scope="col-md">Price</th>
                                                <th scope="col-md">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $price_total = 0; //initialise basket total price to 0.
                                                if (!empty($_SESSION['basket'])) {
                                                    foreach($_SESSION['basket'] as $basket_item) {
                                                        $item_total = $basket_item['price'] * $basket_item['quantity']; // total for this item
                                                        $price_total += $item_total; // Add to total price
                                                        echo "<tr>
                                                            <td>" . $basket_item['product_name'] . "</td>";
                                                        echo "<td class='text-capitalize'>" . $basket_item['product_name'] . "</td>";
                                                        echo "<td><img src='https://picsum.photos/100' alt='placeholder'></td>
                                                            <td>£" . $basket_item['price'] . ".00</td>";
                                                        echo "<td>" . $basket_item['quantity'] . "</td>";
                                                            
                                                        echo "</tr>";
                                                    }
                                                    
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                    
                                    <p class="text-end"> <strong> Basket Total: £<?php echo $price_total; ?>.00 </strong></p>
                                </div>
                            </div>
                        </div>
                        <form method="post" class="d-flex justify-content-evenly mt-3">
                            <button class="btn btn-secondary" type="submit" name="clear_basket">Clear Basket</button>
                            <button  class="btn btn-primary">Checkout</button>
                        </form>
                    </div>

                </div>
            </div>

            <!--products -->
            <div class="container-fluid">
                <h1>Products</h1>

                <!-- FILTER PRODUCTS/ SEARCH FUNCTION -->
                <div class="container-fluid">

                </div>

                <!-- CARDS OF PRODUCTS -->
                <div class="container-fluid">
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

                    <div class="row my-3">

                        <?php 

                        // CONNECT TO DATABASE
                        include 'db.php';

                        // DEFAULT QUERY
                        $sql = "SELECT * FROM product";

                        // RUN WHEN FORM IS SUBMITTED
                        if (isset($_POST['sort'])) {
                            $sortOption = $_POST['sort'];

                            //SET QUERY BASED ON WHAT IS SUBMITTED IN FORM.
                            switch ($sortOption) {
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
                                echo "<div class='col-md-4'>";
                                echo "<div class='card mb-4'>";
                                echo "    <img class='card-img-top' src='https://picsum.photos/id/1/200/180' alt='Card image cap'>";
                                echo "    <div class='card-body'>";
                                echo "        <h5 class='card-title text-capitalize'><strong>" . $row['product_name'] . "</strong></h5>";
                                echo "          <p class='card-text'>Product 1 description. Lorem ipsum dolor sit amet consectetur";
                                echo "                adipisicing elit. Veritatis at quia adipisci officiis pariatur tempora explicabo";
                                echo "                quod ex sint voluptate consequuntur non eveniet totam necessitatibus modi eum";
                                echo "                deserunt, error dolore.</p>";
                                echo "          <h4> £" . $row['price'] . "</h4>";

                                // code to store session variables when adding to basket.
                                echo "          <form method='post' action=''>";
                                echo "              <input type='hidden' name='product_id' value='" . $row['product_id'] . "'>";
                                echo "              <input type='hidden' name='product_name' value='" . $row['product_name'] . "'>";
                                echo "              <input type='hidden' name='price' value='" . $row['price'] . "'>";
                                echo "              <button class='btn btn-primary' type='submit' name='add_to_basket'>Add To Basket</button>";
                                echo "          </form>";
                                echo "        </div>";
                                echo "    </div>";
                                echo "    </div>";
                            }
                            }

                        ?>
                    </div>
                </div>
                    
                </div>
            </div>
    </main>

    <footer class="container-fluid bg-dark position-relative">
        <br>
        <p class="text-light position-absolute start-50 top-50 translate-middle">&copy; Espresso Express</p>
        <br>
        
    </footer>

</body>

</html>