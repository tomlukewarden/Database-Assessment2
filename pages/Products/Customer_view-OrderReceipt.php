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