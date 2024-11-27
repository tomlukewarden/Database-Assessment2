<?php

include "../config/db.php";
session_start();

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Custome CSS Link -->
    <link rel="stylesheet" href="welcome_page.css">
    <title>Staff Dashboard</title>
</head>
<body>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


    <header>
        <nav class="navbar navbar-dark bg-dark p-3">
            <div class="container-fluid">
                <?php
                    // $manager = FALSE;
                    // $assistant = FALSE;
                    // $staff = FALSE;
                    
                    // for($x = 1; $x <= 5; $x++ ){
                    //     if($_SESSION['username'] == $x){
                    //         $manager = True;
                    //     }
                    // }

                    // for($x = 6; $x <= 10; $x++ ){
                    //     if($_SESSION['username'] == $x){
                    //         $assistant = True;
                    //     }
                    // }

                    // for($x = 11; $x <= 50; $x++ ){
                    //     if($_SESSION['username'] == $x){
                    //         $staff = True;
                    //     }
                    // }
                    if($_SESSION['type'] == 'manager'){
                        echo "<a class='navbar-brand' href='#'>Espresso Express Manager</a>";
                    }elseif($_SESSION['type'] == 'assistant'){
                        echo "<a class='navbar-brand' href='#'>Espresso Express Assistant Manager</a>";
                    }elseif($_SESSION['type'] == 'barista'){
                        echo "<a class='navbar-brand' href='#'>Espresso Express Staff</a>";
                    }
                ?>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
                    aria-labelledby="offcanvasDarkNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Menu</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <!-- change these for  -->
                            <?php
                                if ($_SESSION['type'] == 'barista' or $_SESSION['type'] == 'manager' or $_SESSION['type'] == 'assistant'){
                                    echo "<li class='nav-item'><a class='nav-link' href='staff/staff_dashboard.php'>Staff Dashboard</a></li>";
                                    echo "<li class='nav-item' ><a class='nav-link' href='staff/staff_products.php'>Products</a></li>";
                                }
                                if ($_SESSION['type'] == 'manager') {
                                    echo '<li class="nav-item"><a class="nav-link active" href="manager_dashboard.php">Home</a></li>
                                        <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                            data-bs-toggle="dropdown">Managers
                                            Tools</a>
                                        <ul class="dropdown-menu dropdown-menu-dark">
                                            <li><a class="dropdown-item" href="manager_view_users.php">All Staff</a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                    href="transactions.php">Transactions</a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                        <li><a class="dropdown-item" href="#">Preview</a></li>
                                        </ul>
                                        </li>
                                        </ul>';
                                }
                            ?>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <br>
    <main class="container-fluid">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4 text-center">
                <h1>Welcome</h1>
            </div>
            <div class="col-4"></div>
        </div>



        <div class="row">
            <div class="col-4"></div>
            <div class="col-4 text-center">
                <?php
                    //get name
                    if ($_SESSION['type'] == 'barista' or $_SESSION['type'] == 'manager' or $_SESSION['type'] == 'assistant'){
                        $sql = "SELECT first_name, last_name FROM staff WHERE staff_id = " . $_SESSION['username'];
                        $result = mysqli_query($conn, $sql);
                        if ($result) {

                            while ($row = mysqli_fetch_array($result))
                            {
                                echo "<h2>" . $row['first_name'] . " " . $row['last_name'] . "</h2>";
                            }
                        }
                    } elseif ($_SESSION['type'] == 'loyal'){
                        $sql = "SELECT first_name, last_name FROM loyalty WHERE loyalty_id = " . $_SESSION['username'];
                        $result = mysqli_query($conn, $sql);
                        if ($result) {

                            while ($row = mysqli_fetch_array($result))
                            {
                                echo "<h2>" . $row['first_name'] . " " . $row['last_name'] . "</h2>";
                            }
                        }
                    }
                ?>
            </div>
            <div class="col-4"></div>
        </div>

    
</body>
</html>