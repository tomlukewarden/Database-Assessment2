<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Espresso Express</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="homepage.css">
</head>

<body class="bg-light">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgb(146, 138, 127);">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Espresso Express</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="homepage.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/Products/Customer_view-Products.php">Our Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/login/login.php">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main Section -->
  <main class="container my-5">
    <h1 class="text-center mb-4">Welcome to Espresso Express</h1>
    <p class="text-center mb-5">Discover the perfect blend of coffee and quality for a perfect cup of coffee.</p>

    <div class="row g-4">
      <div class="col-lg-6">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">Our Story</h5>
            <p class="card-text">Espresso Express is an up-and-coming coffee chain with ambitious goals of taking over the
              coffee industry. Founded in 2020 by four graduates Dundee University, the company has quickly gained
              popularity and experienced substantial growth over the past four years. Espresso Express’s mission is to
              provide every customer with an experience that awakens their senses through their unique high-quality
              coffee, a distinctive approach to the interior design of their physical locations, and friendly staff.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">Featured Products</h5>
            <p class="card-text">Check out our featured products for a perfect cup of coffee.</p>
            <a href="pages/Products/Customer_view-Products.php" class="btn btn-primary mt-auto">Shop Now</a>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Gallery Section -->
  <section class="bg-light py-5">
    <div class="container">
      <h2 class="text-center mb-4">Gallery</h2>

      <div class="row g-4">
        <div class="col-md-4">
          <div class="gallery-item">
            <img src="assets/coffee1.jpg" class="img-fluid" alt="Image 1">
          </div>
        </div>
        <div class="col-md-4">
          <div class="gallery-item">
            <img src="assets/coffee2.jpg" class="img-fluid" alt="Image 2">
          </div>
        </div>
        <div class="col-md-4">
          <div class="gallery-item">
            <img src="assets/coffee3.jpeg" class="img-fluid" alt="Image 3">
          </div>
        </div>
        <div class="col-md-4">
          <div class="gallery-item">
            <img src="assets/coffee4.jpg" class="img-fluid" alt="Image 4">
          </div>
        </div>
        <div class="col-md-4">
          <div class="gallery-item">
            <img src="assets/coffee5.jpg" class="img-fluid" alt="Image 5">
          </div>
        </div>
        <div class="col-md-4">
          <div class="gallery-item">
            <img src="assets/coffee6.jpg" class="img-fluid" alt="Image 6">
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
</body>

</html>
