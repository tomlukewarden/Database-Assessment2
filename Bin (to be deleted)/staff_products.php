
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
                        <li class="nav-item"><a class="nav-link" href="staff_dashboard.php">Staff Dashboard</a></li>
                        <li class="" nav-item><a class="nav-link active" href="staff_products.php">Products</a></li>
                    </ul>
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
                
                <!-- TABLE OF PRODUCTS -->
                    <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col-md">#</th>
                            <th scope="col-md">Product Name</th>
                            <th scope="col-md">Product Description</th>
                            <th scope="col-md">Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>1</th>
                            <td>coffee 1</td>
                            <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vero porro minus dignissimos, atque earum praesentium quam officia quibusdam ullam tempora ducimus veritatis consectetur illum sit omnis, doloribus soluta debitis laudantium?</td>
                            <td><img src="https://picsum.photos/200" alt="placeholder"></td>
                            <td>Supplier:  </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>coffee 2</td>
                            <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestias repellendus aut voluptatibus atque! Tempore obcaecati, architecto accusamus explicabo aspernatur minus voluptatibus velit maxime necessitatibus odio quisquam ipsum ratione veritatis debitis?</td>
                            <td><img src="https://picsum.photos/200" alt="placeholder"></td>
                            <td>Supplier:  
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>coffee 3</td>
                            <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dicta sequi nam aut neque fugit incidunt, cupiditate reiciendis officia, corrupti rerum nesciunt quis nihil omnis veritatis facilis quidem quibusdam, quaerat ab.</td>
                            <td><img src="https://picsum.photos/200" alt="placeholder"></td>
                            <td>Supplier:  
                            </td>
                        </tr>
                    </tbody>
                </table>
                
    </main>

    <footer class="container-fluid bg-dark position-relative">
        <br>
        <p class="text-light position-absolute start-50 top-50 translate-middle">&copy; Espresso Express</p>
        <br>
        <!-- <div class="icons container-fluid">
        <a href="https://github.com/UniversityOfDundee-Computing/cw1-web-development-project-sca" target="_blank"><i
                class="fa-brands fa-github-square translate-middle h3 mx-3"></i></a>
        <a href="https://en.wikipedia.org/wiki/RollerCoaster_Tycoon" target="_blank"><i
                class="fa-brands fa-wikipedia-w translate-middle h3 mx-3"></i></a>
    </div> -->
    </footer>

</body>

</html>


