<?php

include "db.php";
session_start()     
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=shopping_bag" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
    </script>

</head>

<body>

    <nav class="navbar navbar-dark bg-dark fixed-top p-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Espresso Express Dashboard</a>
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
                        <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Profile</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown">Managers
                                Tools</a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="../db-admin-view/users/users.html">All Staff</a>
                                </li>
                                <li><a class="dropdown-item"
                                        href="../db-admin-view/transactions/transactions.html">Transactions</a>
                                </li>
                                <li><a class="dropdown-item" href="#">Stock</a></li>
                                <li><a class="dropdown-item" href="#">Orders</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Preview</a></li>

                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex mt-3" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

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
                            $sqlClocckedIn = "SELECT COUNT(*) AS clocked_in_staff FROM staff WHERE `clock_in/out` = 1 ";  
                            $resultClockedIn = mysqli_query($conn, $sql); 

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
                        <p class="text-center">Monthly Analytics</p>
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
                    <div class="card-body d-flex flex-column align-items-center" style="height: 100%;">
                        <h1 class="text-center"> Orders </h1>
                        <p style="display: flex; align-items: flex-end;">
                            <span class="material-symbols-outlined" style="line-height: 1;">
                                shopping_bag
                            </span>
                            <a href="#" style="margin-left: 5px;">54 New orders</a>
                        </p>


                        <section class="mb-2" style="width: 90%;">
                            <p class="mb-1"> Glasgow Shop </p>
                            <div class="progress mb-4" style="height: 20px">
                                <div class="progress-bar justify-content-center align-self-center" role="progressbar"
                                    style="width: 25%; height: 20px;" aria-valuenow="25" aria-valuemin="0"
                                    aria-valuemax="100"> 25 %
                                </div>
                            </div>
                            <p class="mb-1"> Dundee Shop</p>
                            <div class="progress mb-4" style="height: 20px">
                                <div class="progress-bar" role="progressbar" style="width: 50%; height: 20px;"
                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"> 50% </div>
                            </div>
                            <p class="mb-1"> Edinburgh Shop </p>
                            <div class="progress mb-4" style="height: 20px">
                                <div class="progress-bar" role="progressbar" style="width: 75%; height: 20px;"
                                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"> 75% </div>
                            </div>
                            <p class="mb-1"> Aberdeen Shop</p>
                            <div class="progress mb-4" style="height: 20px">
                                <div class="progress-bar" role="progressbar" style="width: 60%; height: 20px;"
                                    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"> 60% </div>
                            </div>
                            <p class="mb-1"> Online Store</p>
                            <div class="progress mb-4" style="height: 20px">
                                <div class="progress-bar" role="progressbar" style="width: 100%; height: 20px;"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"> 100% </div>
                            </div>
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
                                <p class="text-center"> Online visitors </p>
                                <h1 class="text-center" style="font-size: 50px;"> 1200 </h1>
                            </div>
                        </div>

                    </div>
                    <div class="col">
                        <div class="card" style="height: 240px; box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center"
                                style="height: 100%;">
                                <p class="text-center"> Online orders </p>
                                <h1 class="text-center" style="font-size: 50px;"> 500 <h1>
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
                                <h1 class="text-center" style="font-size: 50px;"> 70 </h1>


                            </div>
                        </div>

                    </div>
                    <div class="col">
                        <div class="card" style="height: 240px; box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center"
                                style="height: 100%;">
                                <p class="text-center"> Loyalty programs </p>
                                <h1 class="text-center" style="font-size: 50px;"> 200 </h1>

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
                        <h5 class="card-title mb-5" id="CardTitle">Daily Shift</h5>
                        <div id="CardContent">
                            <table class="table text-start">
                                <thead>
                                    <tr>
                                        <th scope="col"> </th>
                                        <th scope="col">Staff Name</th>
                                        <th scope="col">Staff Role </th>
                                        <th scope="col">Shift pattern </th>
                                        <th scope="col"> Attended </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Barista</td>
                                        <td> 10:00- 16:00</td>
                                        <td style="color: rgb(82, 145, 0);"> Clocked in </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Barista</td>
                                        <td> 10:00- 16:00</td>
                                        <td style="color: rgb(82, 145, 0);"> Clocked in </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Marketing</td>
                                        <td> 10:00- 16:00</td>
                                        <td style="color: rgb(82, 145, 0);"> Clocked in </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Head Assistant</td>
                                        <td> 10:00- 16:00</td>
                                        <td style="color: rgb(82, 145, 0);"> Clocked in </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Barista</td>
                                        <td> 10:00- 16:00</td>
                                        <td style="color: rgb(0, 0, 139);"> Late</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Barista</td>
                                        <td> 10:00- 16:00</td>
                                        <td style="color: rgb(82, 145, 0);"> Clocked in </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Social Media</td>
                                        <td> 10:00- 16:00</td>
                                        <td style="color: rgb(145, 17, 0);"> Absent</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Marketing</td>
                                        <td> 10:00- 16:00</td>
                                        <td style="color: rgb(82, 145, 0);"> Clocked in </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Head Assistant</td>
                                        <td> 10:00- 16:00</td>
                                        <td style="color: rgb(82, 145, 0);"> Clocked in </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Barista</td>
                                        <td> 10:00- 16:00</td>
                                        <td style="color: rgb(145, 17, 0);"> Absent</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Head Assistant</td>
                                        <td> 10:00- 16:00</td>
                                        <td style="color: rgb(82, 145, 0);"> Clocked in </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Barista</td>
                                        <td> 10:00- 16:00</td>
                                        <td style="color: rgb(145, 17, 0);"> Absent</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col">
                <div class="card SeeAllButton" style="height: 100px; box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center"
                        style="height: 100%;">
                        <h5 class="text-center"> See All Staff </h5>


                    </div>
                </div>

            </div>
            <div class="col">
                <div class="card SeeAllButton" style="height: 100px; box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center"
                        style="height: 100%;">
                        <h5 class="text-center"> See all products </h5>
                    </div>
                </div>

            </div>
        </div>
    </div>




    <div class="container-fluid px-4">
        <div class="row" style="height: 100%;">
            <div class="col py-3">
                <div class="card full-height-card" style="box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);">
                    <div class="card-body d-flex flex-column">
                        <h3 class="text-start mb-3"> Best selling products</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"> </th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Customer </th>
                                    <th scope="col">Rating </th>
                                    <th scope="col">Review</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"> </th>
                                    <td><img class="img" src="https://picsum.photos/id/8/20/20" alt="Card image cap">
                                        Caffe Latte</td>
                                    <td>James Steward</td>
                                    <td style="color: rgb(255, 208, 0);">★★★★★</td>
                                    <td>Best Coffee I ever had</td>
                                </tr>
                                <tr>
                                    <th scope="row"> </th>
                                    <td> <img class="img" src="https://picsum.photos/id/8/20/20" alt="Card image cap">
                                        Caffe Latte</td>
                                    <td>James Steward</td>
                                    <td style="color: rgb(255, 208, 0);">★★★★★</td>
                                    <td>Customers very friendly</td>
                                </tr>
                                <tr>
                                    <th scope="row"> </th>
                                    <td> <img class="img" src="https://picsum.photos/id/8/20/20" alt="Card image cap">
                                        Caffe Latte</td>
                                    <td>James Steward</td>
                                    <td style="color: rgb(255, 208, 0);">★★★★★</td>
                                    <td>nice coffee</td>
                                </tr>
                                <tr>
                                    <th scope="row"> </th>
                                    <td> <img class="img" src="https://picsum.photos/id/8/20/20" alt="Card image cap">
                                        Caffe Latte</td>
                                    <td>James Steward</td>
                                    <td style="color: rgb(255, 208, 0);">★★★★★</td>
                                    <td>will come again</td>
                                </tr>
                                <tr>
                                    <th scope="row"> </th>
                                    <td> <img class="img" src="https://picsum.photos/id/8/20/20" alt="Card image cap">
                                        Caffe Latte</td>
                                    <td>James Steward</td>
                                    <td style="color: rgb(255, 208, 0);">★★★★☆</td>
                                    <td>friendly staff</td>

                                <tr>
                                    <th scope="row"> </th>
                                    <td> <img class="img" src="https://picsum.photos/id/8/20/20" alt="Card image cap">
                                        Caffe Latte</td>
                                    <td>James Steward</td>
                                    <td style="color: rgb(255, 208, 0);">★★★★★</td>
                                    <td>Customers very friendly</td>
                                </tr>
                                <tr>
                                    <th scope="row"> </th>
                                    <td> <img class="img" src="https://picsum.photos/id/8/20/20" alt="Card image cap">
                                        Caffe Latte</td>
                                    <td>James Steward</td>
                                    <td style="color: rgb(255, 208, 0);">★★★★★</td>
                                    <td>nice coffee</td>
                                </tr>
                                <tr>
                                    <th scope="row"> </th>
                                    <td> <img class="img" src="https://picsum.photos/id/8/20/20" alt="Card image cap">
                                        Caffe Latte</td>
                                    <td>James Steward</td>
                                    <td style="color: rgb(255, 208, 0);">★★★★★</td>
                                    <td>will come again</td>
                                </tr>
                                <tr>
                                    <th scope="row"> </th>
                                    <td> <img class="img" src="https://picsum.photos/id/8/20/20" alt="Card image cap">
                                        Caffe Latte</td>
                                    <td>James Steward</td>
                                    <td style="color: rgb(255, 208, 0);">★★★★☆</td>
                                    <td>friendly staff</td>
                                </tr>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="container-fluid px-4">
        <h3> Products state: </h3>
        <div class="row">
            <div class="col-3 py-3">
                <div class="card border-danger actionrequired" style="box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.3);">
                    <img class="card-img-top p-2" src="https://picsum.photos/id/8/300/300" alt="Card image cap">
                    <div class="card-body p-2">
                        <h5 class="card-title mb-0">Product Title</h5>
                        <p class="card-text fs-6"><em>idproduct</em></p>
                    </div>
                    <div class="card-footer text-center text-light border-danger bg-danger">Low in stock
                    </div>
                </div>
            </div>
            <div class="col-3 py-3">
                <div class="card border-secondary actionrequired" style="box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);">
                    <img class="card-img-top p-2" src="https://picsum.photos/id/8/300/300" alt="Card image cap">
                    <div class="card-body p-2">
                        <h5 class="card-title mb-0">Product Title</h5>
                        <p class="card-text fs-6"><em>idproduct</em></p>
                    </div>
                    <div class="card-footer border-secondary bg-secondary text-center text-light">
                        Out of stock
                    </div>
                </div>
            </div>
            <div class="col-3 py-3">
                <div class="card border-secondary actionrequired" style="box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);">
                    <img class="card-img-top p-2" src="https://picsum.photos/id/8/300/300" alt="Card image cap">
                    <div class="card-body p-2">
                        <h5 class="card-title mb-0">Product Title</h5>
                        <p class="card-text fs-6"><em>idproduct</em></p>
                    </div>
                    <div class="card-footer border-secondary bg-secondary text-center text-light">
                        Out of stock
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="manager_dashboard.js"></script>
    

</body>

</html>