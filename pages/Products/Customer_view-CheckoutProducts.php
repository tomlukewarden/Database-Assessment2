<!DOCTYPE html>
<html>
<?php session_start(); 

if (isset($_POST['Amend_order'])) {
    header('Location: Customer_view-Products.php');
}
?>
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

    <br><br>
    <main class="container my-5">

    <!-- display basket -->
    <!-- BASKET -->

    <!-- ACCORDION FOR BASKET ITEMS -->
    <div class="accordion" id="accordion1">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Items to Checkout
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
        
        <form method="post" class="d-flex justify-content-evenly my-3">
            <button class="btn btn-secondary" type="submit" name="Amend_order">Amend Order</button>
        </form>
    </div>

    <form>
        <div class="form-group col-md-6 my-2">
            <label for="inputAddress">House/Flat No.</label>
            <input type="text" class="form-control" id="inputAddress" placeholder="eg. Flat 3R">
        </div>
        <div class="form-group col-md-6 my-2">
            <label for="inputAddress2">Address</label>
            <input type="text" class="form-control" id="inputAddress2" placeholder="eg. 12 Blackness Avenue">
        </div>
        <div class="form-row row">
            <div class="form-group col-md-3 my-2">
            <label for="inputCity">City</label>
            <input type="text" class="form-control" id="inputCity">
            </div>
            <div class="form-group col-md-3 my-2">
            <label for="inputPostCode">Post Code</label>
            <input type="text" class="form-control" id="inputPostCode">
            </div>
        </div>
        
        </div>
        <button type="submit" class="btn btn-primary my-3" name="submit_order">Submit Order</button>
    </form>

    </main>

    <footer class="container-fluid bg-dark position-relative">
        <br>
        <p class="text-light position-absolute start-50 top-50 translate-middle">&copy; Espresso Express</p>
        <br>
        
    </footer>

</body>

</html>