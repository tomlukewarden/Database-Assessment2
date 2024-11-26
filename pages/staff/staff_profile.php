
<?php 

include '../../../config/db.php';  
session_start();
echo "asldfsdfhshdfhsdkghsdgskdghsd <br> <br>asdfsdfsdfsdf<br><br>sdfksgdfksjdf";
echo "session variable for user: " . $_SESSION["password"];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Profile Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="profile.css">
</head>

<body class="coolor">
    <nav class="navbar navbar-dark bg-dark fixed-top p-3">
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
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Navigation Menu</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item"><a class="nav-link active" href="staff_profile.php">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="staff_dashboard.php">Staff Dashboard</a></li>
                        <li class="" nav-item><a class="nav-link" href="staff_products.php">Products</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>


    <main class="container-fluid my-5 pt-5 coolor">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card my-4">
                        <h5 class="card-header mx-3">Name</h5>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <?php
                                    //get name
                                    $sql = "SELECT first_name, last_name FROM staff WHERE staff_id = " . $_SESSION['username'];
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                        
                                        while ($row = mysqli_fetch_array($result))
                                        {
                                            echo "<tr>";
                                            echo "<td>" . $row['first_name'] . "</td>";
                                            echo "<td>" . $row['last_name'] . "</td>";
                                            echo "</tr>";
                                        }
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card my-4">
                        <h5 class="card-header mx-3">Personal Information</h5>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card my-4">
                        <h5 class="card-header mx-3">Job info</h5>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>