<!DOCTYPE html>
<html>
<?php 
session_start(); 

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: ../../homepage.php');
}
if (isset($_POST['continue_shopping'])) {
    session_unset();
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
    <main class="container-fluid my-5" style="display: flex; justify-content: center; align-items: center; height: 75vh;">

    
        <div class="card" >
            <div class="card-body">
                <h5 class="card-title m-3">Order Complete.</h5>
                <h6 class="card-subtitle m-3 text-muted">Thank you for your order.</h6>
                <form action="" method="post">
                    <button class="btn btn-primary m-3" type="submit" name="logout">Return to Homepage </button>
                    <!-- NEED TO ADD REDIRECT PHP TO THE HOMEPAGE AND DESTROY SESSION VARIABLES WHEN CLICKED -->
                    <button class="btn btn-primary m-3" type="submit" name="continue_shopping">Continue Shopping </button>
                </form>
            </div>
        </div>
    </main>

    



    <footer class="container-fluid bg-dark position-absolute bottom-0">
        <br>
        <p class="text-light position-absolute start-50 top-50 translate-middle">&copy; Espresso Express</p>
        <br>
        
    </footer>

</body>

</html>