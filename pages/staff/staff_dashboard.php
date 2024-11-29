<?php

include '../../config/db.php'; 
session_start();

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: /espresso-express/Database-Assessment2/pages/login/login.php');
}

if($_SESSION['type'] == 'loyal' or is_null($_SESSION['type'])){
    header('Location: ../welcome_page.php');
}



$sql = "SELECT clock FROM staff WHERE staff_id = " . $_SESSION['username'];
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($result)){
    if ($row["clock"] == 0) {
        $_SESSION["onshift"] = 0;
    } else{
        $_SESSION["onshift"] = 1;
    }
}

if (isset($_POST['submit'])) {
    if ($_SESSION["onshift"] == 0) {  
        $query = "UPDATE staff SET clock = 1 WHERE staff_id = " . $_SESSION['username'];
        mysqli_query($conn, $query);
        $_SESSION["onshift"] = 1;
    } elseif ($_SESSION["onshift"] == 1) {
        $query = "UPDATE staff SET clock = 0 WHERE staff_id = " . $_SESSION['username'];
        mysqli_query($conn, $query);
        $_SESSION["onshift"] = 0;
    }
}





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Custome CSS Link -->
    <link rel="stylesheet" href="staff_dashboard.css">
    <title>Staff Dashboard</title>
</head>
<body>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


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
    <br>
    <main class="container-fluid">
        <h1>Staff Dashboard</h1>
        <div class="row">
            <section class="col m-3 content">
                <div class="row top">
                    <h2>Attendance</h2>
                </div>
                <div class="row">
                    <div class="col">
                        <form method="post" action="">
                            <?php
                                if($_SESSION["onshift"] == 0){
                                    echo"<button id='changebutton' class='bg-success' type='submit' value='submit' name='submit'>Clock In</button>";
                                } elseif($_SESSION["onshift"] == 1){
                                    echo"<button id='changebutton' class='bg-danger' type='submit' value='submit' name='submit'>Clock Out</button>";
                                }
                            ?>
                        </form>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-8">
                        <h3>Currently Clocked In:</h3>
                    </div>
                    <div class="col-3">
                        <h3 id="change" class="text-danger">NO</h3>
                    </div>
                </div>
                <div class="row">
                    <h4>Totals Since Last Pay</h4>
                </div>
                <div class="row table-responsive">
                    <table class="table table-secondary">
                    <?php
                        //get name
                        $sql = "SELECT first_name, last_name, salary, absences FROM staff WHERE staff_id = " . $_SESSION['username'];
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                        
                            while ($row = mysqli_fetch_array($result))
                            {
                                echo "<tr>";
                                echo "<th>First Name:</th>";
                                echo "<td>" . $row['first_name'] . "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<th>Last Name:</th>";
                                echo "<td>" . $row['last_name'] . "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<th>Salary:</th>";
                                echo "<td>£" . $row['salary'] . "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<th>Absences:</th>";
                                echo "<td>" . $row['absences'] . "</td>";
                                echo "</tr>";
                            }
                        }
                    ?>
                    </table>
                </div>
                <div class="accordion" id="payslips">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Employee Payslips (Last 12 Months)
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#payslips">
                            <div class="accordion-body">
                                <a href="payslip_months/december_payslip.php" target="_blank">December Payslip</a>
                            </div>
                            <div class="accordion-body">
                                <a href="payslip_months/november_payslip.php" target="_blank">November Payslip</a>
                            </div>
                            <div class="accordion-body">
                                <a href="payslip_months/october_payslip.html" target="_blank">October Payslip</a>
                            </div>
                            <div class="accordion-body">
                                <a href="payslip_months/september_payslip.html" target="_blank">September Payslip</a>
                            </div>
                            <div class="accordion-body">
                                <a href="payslip_months/august_payslip.html" target="_blank">August Payslip</a>
                            </div>
                            <div class="accordion-body">
                                <a href="payslip_months/july_payslip.html" target="_blank">July Payslip</a>
                            </div>
                            <div class="accordion-body">
                                <a href="payslip_months/june_payslip.html" target="_blank">June Payslip</a>
                            </div>
                            <div class="accordion-body">
                                <a href="payslip_months/may_payslip.html" target="_blank">May Payslip</a>
                            </div>
                            <div class="accordion-body">
                                <a href="payslip_months/april_payslip.html" target="_blank">April Payslip</a>
                            </div>
                            <div class="accordion-body">
                                <a href="payslip_months/march_payslip.html" target="_blank">March Payslip</a>
                            </div>
                            <div class="accordion-body">
                                <a href="payslip_months/february_payslip.html" target="_blank">February Payslip</a>
                            </div>
                            <div class="accordion-body">
                                <a href="payslip_months/january_payslip.html" target="_blank">January Payslip</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="col m-3 content">
                <div class="row top">
                    <h2>Requests</h2>
                </div>
                <div class="card-group">
                    <div class="row d-flex justify-content-center">
                        <div class="col-6">
                            <div class="card">
                                <img class="card-img-top" src="https://picsum.photos/id/199/300/200" alt="annual leave">
                                <div class="card-body">
                                    <h5 class="card-title">Annual Leave</h5>
                                    <a href="" class="btn btn-primary">Request</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <img class="card-img-top" src="https://picsum.photos/id/103/300/200" alt="unpaid leave">
                                <div class="card-body">
                                    <h5 class="card-title">Unpaid Leave</h5>
                                    <a href="" class="btn btn-primary">Request</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-6">
                            <div class="card">
                                <img class="card-img-top" src="https://picsum.photos/id/326/300/200" alt="sickness">
                                <div class="card-body">
                                    <h5 class="card-title">Sickness</h5>
                                    <a href="" class="btn btn-primary">Request</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <img class="card-img-top" src="https://picsum.photos/id/184/300/200" alt="other">
                                <div class="card-body">
                                    <h5 class="card-title">Other</h5>
                                    <a href="" class="btn btn-primary">Request</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="row">
            <section>

            </section>
        </div>
    </main>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

    
</body>
</html>