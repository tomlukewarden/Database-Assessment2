<?php

include '../../config/db.php'; 
session_start();

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: /espresso-express/Database-Assessment2/pages/login/login.php');
  }

// Limits access unless a manager is logged in.
if($_SESSION['type'] != 'manager'){
    header('Location: ../../welcome_page.php');
}   
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title> Managers Dashboard </title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='manager_dashboard.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=bedtime" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=shopping_bag" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
    </script>
    <script src="manager_dashboard.js"></script>

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
                                        echo '<li class="nav-item"><a class="nav-link" href="/espresso-express/Database-Assessment2/pages/assistant-manager-view/Assistant-managers-dashboard/products_AS_view.php">Product</a></li>';
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
                            </ul>';
                        }

                        echo '<form action="" method="post">
                                        <button class="btn btn-primary m-3" type="submit" name="logout">Logout</button>
                                        </form>
                        </div>
                    </div>';
                                    
?>
                
</div>
</nav>
    </header>

    <div class="container-fluid mt-4 pt-5 px-4">
        <div class="row">
            <div class="col self-align-center mt-4 ms-2">

                <?php
                    // displays the name of the user logged in

                    $sql = "SELECT first_name, last_name FROM staff WHERE staff_id= " . $_SESSION['username'];  
                    $result = mysqli_query($conn, $sql); 
                    if($result){
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<p> Welcome Back, " . $row['first_name'] . " " . $row['last_name'] . "</p>";
                     }
 
                    }
                    
                ?>

            </div>
        </div>
    </div>

    <div class="container-fluid px-4">
        <div class="row">
            <div class="col py-2">
                <div class="card">
                    <div class="card-body"
                        style="height:120px; background-color: rgb(136, 88, 175); box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);">
                        <h2> Sales </h2>

                        <?php
                            $sql = "SELECT COUNT(*) AS total_sales FROM transactions";  
                            $result = mysqli_query($conn, $sql); 
                            if($result) {
                                $row = mysqli_fetch_assoc($result);
                                echo "<p>" . $row['total_sales']. "</p>";
                            }
                        ?>

                    </div>
                </div>
            </div>
            <div class="col py-2">
                <div class="card">
                    <div class="card-body"
                        style="height:120px; background-color: rgb(136, 88, 175); box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);">
                        <h2> Revenue</h2>

                        <?php
                            $sql = "SELECT SUM(p.price) AS total_revenue FROM transactions t JOIN product p ON t.product_id = p.product_id;";  
                            $result = mysqli_query($conn, $sql); 
                            if($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                echo "<p>" . $row['total_revenue'] . "</p>";
                                }
                            }
                        ?>

                    </div>
                </div>
            </div>
            <div class="col py-2">
                <div class="card">
                    <div class="card-body"
                        style="height:120px; background-color: rgb(136, 88, 175); box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);">
                        <h2> Attendance </h2>
                        <?php
                            $sqlClockedIn = "SELECT COUNT(*) AS clocked_in_staff FROM staff WHERE clock = 1 ";  
                            $resultClockedIn = mysqli_query($conn, $sqlClockedIn); 

                            $sqlTotalStaff = "SELECT COUNT(*) AS total_staff FROM staff";  
                            $resultTotalStaff = mysqli_query($conn, $sqlTotalStaff); 
                            
                            if($resultClockedIn && $resultTotalStaff) {
                                $rowClockedIn = mysqli_fetch_assoc($resultClockedIn);
                                $rowTotalStaff = mysqli_fetch_assoc($resultTotalStaff);
                                echo "<p>" . $rowClockedIn['clocked_in_staff']/100 * $rowTotalStaff['total_staff']. " % </p>";
                            }
                        ?>

                    </div>
                </div>
            </div>
            <div class="col py-2">
                <div class="card">
                    <div class="card-body"
                        style="height:120px; background-color: rgb(136, 88, 175); box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);">
                        <h2> Total Customers </h2>
                        <?php
                            $sql = "SELECT COUNT(*) AS total_customers FROM customer";  
                            $result = mysqli_query($conn, $sql); 
                            if($result) {
                                $row = mysqli_fetch_assoc($result);
                                echo "<p>" . $row['total_customers']. "</p>";
                            }
                        ?>
                    </div>
                </div>
            </div>
           
        </div>
    </div>


    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-md-5 py-3">
                <div class="card" style="height: 450px; box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center"
                        style="height: 100%;">
                        <h1 class="text-center">Product Sales</h1>
                        <canvas class="mb-5" id="myChart" style="width: 100%; max-width:700px;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-7 py-3">
                <div class="card" style="height: 450px; box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center"
                        style="height: 100%;">
                        <p class="text-center">2024 Monthly Analytics</p>
                        <canvas id="graph" style="width: 100%; max-width:700px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-md-7 py-3">
                <div class="card" style="height: 500px; box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);">
                    <div class="card-body d-flex flex-column align-items-center justify-content-between" style="height: 100%;">
                        <h1 class="text-center mt-4"> Store Transactions </h1>


                        <section class="mb-2" style="width: 90%;">
                            <p class="mb-1"> Glasgow Shop </p>
                            <?php
                            $sql = "SELECT COUNT(*) AS total_online_orders 
                                    FROM transactions t 
                                    JOIN store s ON t.store_id = s.store_id 
                                    WHERE s.store_id=3";

                            $salessql = "SELECT COUNT(*) AS total_sales FROM transactions";

                            $result = mysqli_query($conn, $sql); 
                            $result1 = mysqli_query($conn, $salessql);

                            if ($result && $result1) {
                                $rowonline=mysqli_fetch_assoc($result);
                                $onlineOrders = $rowonline['total_online_orders'];
                                $rowsales=mysqli_fetch_assoc($result1);
                                $totalSales = $rowsales['total_sales'];

                                if ($totalSales > 0) { // Prevent division by zero
                                    $percentage = ($onlineOrders / $totalSales) * 100;

                                    echo '<div class="progress mb-4" style="height: 20px">
                                            <div class="progress-bar" role="progressbar" 
                                                style="width: ' . $percentage . '%; height: 20px;" 
                                                aria-valuenow="' . $percentage . '" 
                                                aria-valuemin="0" 
                                                aria-valuemax="100">
                                                ' . number_format($percentage) . '% 
                                            </div>
                                        </div>';
                                } else {
                                    echo "No sales data available.";
                                }
                            } 
                            ?>
                            <p class="mb-1"> Dundee Shop</p>

                            <?php
                            $sql = "SELECT COUNT(*) AS total_online_orders 
                                    FROM transactions t 
                                    JOIN store s ON t.store_id = s.store_id 
                                    WHERE s.store_id=1";

                            $salessql = "SELECT COUNT(*) AS total_sales FROM transactions";

                            $result = mysqli_query($conn, $sql); 
                            $result1 = mysqli_query($conn, $salessql);

                            if ($result && $result1) {
                                $rowonline=mysqli_fetch_assoc($result);
                                $onlineOrders = $rowonline['total_online_orders'];
                                $rowsales=mysqli_fetch_assoc($result1);
                                $totalSales = $rowsales['total_sales'];

                                if ($totalSales > 0) { // Prevent division by zero
                                    $percentage = ($onlineOrders / $totalSales) * 100;

                                    echo '<div class="progress mb-4" style="height: 20px">
                                            <div class="progress-bar" role="progressbar" 
                                                style="width: ' . $percentage . '%; height: 20px;" 
                                                aria-valuenow="' . $percentage . '" 
                                                aria-valuemin="0" 
                                                aria-valuemax="100">
                                                ' . number_format($percentage) . '% 
                                            </div>
                                        </div>';
                                } else {
                                    echo "No sales data available.";
                                }
                            } 
                            ?>


                            <p class="mb-1"> Edinburgh Shop </p>
                            <?php
                            $sql = "SELECT COUNT(*) AS total_online_orders 
                                    FROM transactions t 
                                    JOIN store s ON t.store_id = s.store_id 
                                    WHERE s.store_id=2";

                            $salessql = "SELECT COUNT(*) AS total_sales FROM transactions";

                            $result = mysqli_query($conn, $sql); 
                            $result1 = mysqli_query($conn, $salessql);

                            if ($result && $result1) {
                                $rowonline=mysqli_fetch_assoc($result);
                                $onlineOrders = $rowonline['total_online_orders'];
                                $rowsales=mysqli_fetch_assoc($result1);
                                $totalSales = $rowsales['total_sales'];

                                if ($totalSales > 0) { // Prevent division by zero
                                    $percentage = ($onlineOrders / $totalSales) * 100;

                                    echo '<div class="progress mb-4" style="height: 20px">
                                            <div class="progress-bar" role="progressbar" 
                                                style="width: ' . $percentage . '%; height: 20px;" 
                                                aria-valuenow="' . $percentage . '" 
                                                aria-valuemin="0" 
                                                aria-valuemax="100">
                                                ' . number_format($percentage) . '% 
                                            </div>
                                        </div>';
                                } else {
                                    echo "No sales data available.";
                                }
                            } 
                            ?>

                            
                            <p class="mb-1"> Aberdeen Shop</p>
                            <?php
                            $sql = "SELECT COUNT(*) AS total_online_orders 
                                    FROM transactions t 
                                    JOIN store s ON t.store_id = s.store_id 
                                    WHERE s.store_id=4";

                            $salessql = "SELECT COUNT(*) AS total_sales FROM transactions";

                            $result = mysqli_query($conn, $sql); 
                            $result1 = mysqli_query($conn, $salessql);

                            if ($result && $result1) {
                                $rowonline=mysqli_fetch_assoc($result);
                                $onlineOrders = $rowonline['total_online_orders'];
                                $rowsales=mysqli_fetch_assoc($result1);
                                $totalSales = $rowsales['total_sales'];

                                if ($totalSales > 0) { // Prevent division by zero
                                    $percentage = ($onlineOrders / $totalSales) * 100;

                                    echo '<div class="progress mb-4" style="height: 20px">
                                            <div class="progress-bar" role="progressbar" 
                                                style="width: ' . $percentage . '%; height: 20px;" 
                                                aria-valuenow="' . $percentage . '" 
                                                aria-valuemin="0" 
                                                aria-valuemax="100">
                                                ' . number_format($percentage) . '% 
                                            </div>
                                        </div>';
                                } else {
                                    echo "No sales data available.";
                                }
                            } 
                            ?>

                            <p class="mb-1"> Online Store</p>

                            <?php
                            $sql = "SELECT COUNT(*) AS total_online_orders 
                                    FROM transactions t 
                                    JOIN store s ON t.store_id = s.store_id 
                                    WHERE s.is_online = 1";

                            $salessql = "SELECT COUNT(*) AS total_sales FROM transactions";

                            $result = mysqli_query($conn, $sql); 
                            $result1 = mysqli_query($conn, $salessql);

                            if ($result && $result1) {
                                $rowonline=mysqli_fetch_assoc($result);
                                $onlineOrders = $rowonline['total_online_orders'];
                                $rowsales=mysqli_fetch_assoc($result1);
                                $totalSales = $rowsales['total_sales'];

                                if ($totalSales > 0) { // Prevent division by zero
                                    $percentage = ($onlineOrders / $totalSales) * 100;

                                    echo '<div class="progress mb-4" style="height: 20px">
                                            <div class="progress-bar" role="progressbar" 
                                                style="width: ' . $percentage . '%; height: 20px;" 
                                                aria-valuenow="' . $percentage . '" 
                                                aria-valuemin="0" 
                                                aria-valuemax="100">
                                                ' . number_format($percentage) . '% 
                                            </div>
                                        </div>';
                                } else {
                                    echo "No sales data available.";
                                }
                            } 
                            ?>


                            
                        </section>

                    </div>
                </div>
            </div>

            <div class="col-md-5 py-3 d-flex flex-column justify-content-between">
                <div class="row">
                    <div class="col">
                        <div class="card" style="height: 240px; box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center"
                                style="height: 100%;">

                                <!--calculates nr of online customers -->
                                <p class="text-center"> Online customers </p> 
                                
                            
                                <?php
                                /*
                                    
                                    <!--calculates nr of online visitors stored in a file to see how many turned into customers-->
                                    //Change the above with <p class="text-center"> Online visitors </p> 


                                    $countFile = 'count_visitors.txt';

                                    if (file_exists($countFile)) {
                                        $count = file_get_contents($countFile);
                                        echo "<h1 class='text-center' style='font-size: 50px;'>".$count."</h1>";
                                    } else {
                                        echo "<h1 class='text-center' style='font-size: 50px;'>"."..."."</h1>";
                                    }*/
                        


                                    //customers that are online

                                    $sql = "SELECT COUNT(*) AS total_online_customers FROM customer WHERE is_online = 1;";  
                                    $result = mysqli_query($conn, $sql); 
                                    if($result) {
                                        $row = mysqli_fetch_assoc($result);
                                        echo "<h1 class='text-center' style='font-size: 50px;'>". $row['total_online_customers']. '</h1>';
                                    }
                                    
                                ?>
                                    
                                
                            </div>
                            
                        </div>

                    </div>
                    <div class="col">
                        <div class="card" style="height: 240px; box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center"
                                style="height: 100%;">
                                <p class="text-center"> Online orders </p>
                                <!--calculates nr of online orders -->
                                <?php
                                    $sql = "SELECT COUNT(product_id) AS total_online_orders FROM transactions t JOIN store s ON t.store_id = s.store_id WHERE s.is_online = 1;";  
                                    $result = mysqli_query($conn, $sql); 
                                    if($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<h1 class="text-center" style="font-size: 50px;">' . $row['total_online_orders'] . "</h1>";
                                        }
                                    }
                                ?>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card" style="height: 240px; box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center"
                                style="height: 100%;">
                                <p class="text-center"> In shop customers </p>
                                <!--calculates nr of in shop customers -->
                                <?php
                                    $sql = "SELECT COUNT(product_id) AS total_in_shop_sales FROM transactions t JOIN store s ON t.store_id = s.store_id WHERE s.is_online = 0";  
                                    $result = mysqli_query($conn, $sql); 
                                    if($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<h1 class="text-center" style="font-size: 50px;">' . $row['total_in_shop_sales'] . "</h1>";
                                        }
                                    }
                                ?>
                            </div>
                        </div>

                    </div>
                    <div class="col">
                        <div class="card" style="height: 240px; box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center"
                                style="height: 100%;">
                                <p class="text-center"> Loyalty memberships </p>
                                <!--calculates how many loyal customers -->
                                <?php
                                    $sql = "SELECT COUNT(loyalty_id) AS total_loyalty_memberships FROM loyalty";  
                                    $result = mysqli_query($conn, $sql); 
                                    if($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<h1 class="text-center" style="font-size: 50px;">' . $row['total_loyalty_memberships'] . "</h1>";
                                        }
                                    }
                                ?>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>



    <div class="container-fluid px-4">
        <div class="row">
            <div class="col py-3">
                <div class="card text-center" style="box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="DailyShiftTab">Daily Shift</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="StaffOnLeaveTab">Staff on Leave</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title m-3" id="CardTitle"> Staff on Shift </h5>
                        <div id="CardContent">
                            <?php
                            $sqlClockedIn = "SELECT first_name, last_name, position FROM staff WHERE clock = 1";  
                            $resultClockedIn = mysqli_query($conn, $sqlClockedIn); 
                            
                            if($resultClockedIn) {
                                if(mysqli_num_rows($resultClockedIn) > 0){
                                    echo '<table class="table text-start">';
                                    echo "<thead><tr><th scope='col'> </th><th scope='col'>Staff Name</th><th scope='col'>Staff Role </th><th scope='col'> Attendance </th></tr></thead>";
                                    echo "<tbody>";
                                    while($row = mysqli_fetch_assoc($resultClockedIn)){
                                        echo "<tr><th scope='row'> </th><td>" . $row['first_name'] . ' ' . $row['last_name'] . "</td><td>" . $row['position'] . "</td><td style='color: rgb(82, 145, 0);'>Clocked In</td></tr>";

                                    }  
                                    echo "</tbody></table>";

                                } else {
                                echo '<p class="text-center m-4 text-secondary font-italic ">'."No staff on shift at the moment...". '</p>';
                                }
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col">
                
                <a href="/espresso-express/Database-Assessment2/pages/assistant-manager-view/Assistant-managers-dashboard/users_AS_view.php" class="text-decoration-none">
                    <div class="card SeeAllButton" 
                        style="height: 100px; box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2); cursor: pointer;">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center"
                            style="height: 100%;"> 
                            <h5 class="text-center"> See All Staff </h5>
                        </div>
                    </div>
                </a>
                

            </div>
            <div class="col">
                <a href="/espresso-express/Database-Assessment2/pages/assistant-manager-view/Assistant-managers-dashboard/products_AS_view.php" class="text-decoration-none">
                    <div class="card SeeAllButton" style="height: 100px; box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center"
                            style="height: 100%;">
                            <h5 class="text-center"> See all products </h5> 
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </div>




    <div class="container-fluid px-4">
        <div class="row" style="height: 100%;">
            <div class="col py-3">
                <div class="card full-height-card" style="box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);">
                    <div class="card-body d-flex flex-column">
                        <h3 class="text-start m-3"> Best selling products</h3>
                        <?php

                        $sql = "SELECT p.product_name, COUNT(p.product_id) AS quantity FROM transactions t JOIN product p ON p.product_id = t.product_id GROUP BY p.product_id ORDER BY quantity DESC LIMIT 4";
                        $result = mysqli_query($conn, $sql); 
                        if($result) {
                            if(mysqli_num_rows($result) > 0){
                                echo '<table class="table">';
                                echo "<thead><tr><th scope='col'></th><th scope='col'></th><th scope='col'>Product Name</th><th scope='col'> Quantity </th></tr></thead>";
                                echo "<tbody>";
                                 while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr><th scope='row'></th><td>" .'<img class="img" src="https://picsum.photos/id/8/20/20" alt="Card image cap">'."</td><td>". $row['product_name'] . "</td><td>" . $row['quantity']. " items" . "</td></tr>";
                                }
                                echo "</tbody></table>";
                            } else {
                                echo '<p class="text-center m-4 text-secondary font-italic ">'."No products bought yet...". '</p>';
                                }
                        } 
                                            
                        ?>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="container-fluid px-4 mb-5">
        <?php
        $sqlLowInStock = "SELECT product_id, product_name, stock FROM product WHERE stock <= 5";  
        $resultLowInStock = mysqli_query($conn, $sqlLowInStock); 
        
        if($resultLowInStock) {
            
            if(mysqli_num_rows($resultLowInStock) > 0){
                echo '<h3> Products state: </h3>
                    <div class="row">'; 
                while($row = mysqli_fetch_assoc($resultLowInStock)){
                    echo '<div class="col-2 py-3">
                            <div class="card border-danger actionrequired" style="box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.3);">
                                <img class="card-img-top p-2" src="https://picsum.photos/id/8/300/300" alt="Card image cap">
                                <div class="card-body p-2">
                                    <h5 class="card-title mb-0">'. $row['product_name'] .'</h5>
                                    <p class="card-text fs-6"><em> #'. $row['product_id'] .'</em></p>
                                </div>
                                <div class="card-footer text-center text-light border-danger bg-danger">Low in stock
                                </div>
                            </div>
                        </div>';
                } 
                echo '</div';
            }
        }

        ?>

    </div>


    
    

</body>

</html>