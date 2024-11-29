
<?php 

include '../../../config/db.php'; 
session_start();

if (isset($_POST['logout'])) {
  session_destroy();
  header('Location: /espresso-express/Database-Assessment2/pages/login/login.php');
}

// Limits access unless an assistant manager is logged in.
if($_SESSION['type'] != 'assistant' and $_SESSION['type'] != 'admin'){
  header('Location: ../../welcome_page.php');
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assistant Manager Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" href="assistant-manager.css">

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
    
    <!--內容-->
    <main class="container my-5 pt-5">
      <h1 class="dashboard-title">Assistant Manager Dashboard</h1>

      <?php
        //get name
        $sql = "SELECT first_name, last_name FROM staff WHERE staff_id = " . $_SESSION['username'];
        $result = mysqli_query($conn, $sql);
        if ($result) {

            while ($row = mysqli_fetch_array($result))
            {
                echo "<p>Hello! " . $row['first_name'] . " " , $row['last_name'] , "</p>";
            }
        }                               
        ?>

        <!-- Manage Cards -->
        <div class="row mt-5">
            <!-- Manage Staff Card -->
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-header">Manage Staff</div>
                    <div class="card-body">
                        <a href="users_AS_view.php" class="btn btn-secondary">View</a>
                    </div>
                </div>
            </div>
            <!-- Manage Stock Card -->
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-header">Manage Products</div>
                    <div class="card-body">
                        <a href="products_AS_view.php" class="btn btn-secondary">View</a>
                    </div>
                </div>
            </div>
            <!-- Manage Supplier Card -->
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-header">Manage Suppliers</div>
                    <div class="card-body">
                        <a href="suppliers_AS_view.php" class="btn btn-secondary">View</a>
                    </div>
                </div>
            </div>
            <!-- Manage Order Card -->
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-header">Manage Transaction</div>
                    <div class="card-body">
                        
                        <a href="transactions_AS_view.php" class="btn btn-secondary ">Transaction</a>
                    </div>
                </div>
            </div>
            
        </div>

        <!-- Charts Row -->
        <div class="row">
            <!-- Product Sales Chart Section -->
            <div class="col-md-6 mb-4 mt-3">
            <div class="card p-4 shadow-sm">
                <h4 class="mb-4">Product Sales</h4>
                <canvas id="productSalesChart"></canvas>
            </div>
            </div>

            <script>
                const ctx = document.getElementById('productSalesChart').getContext('2d');
                const productSalesChart = new Chart(ctx, {
                  type: 'doughnut',
                  data: {
                    labels: ['americano blend', 'green', 'coffee tin', 'hot chocolate', 'croissants'],
                    datasets: [{
                      data: [35, 25, 15, 10, 15],  // 設定每個產品類別的數據比例
                      backgroundColor: ['#1E3D58', '#A2B9BC', '#D8CFC4', '#9BC4CB', '#682C91'],
                      borderWidth: 1
                    }]
                  },
                  options: {
                    responsive: true,
                    plugins: {
                      legend: {
                        position: 'top',
                      },
                      title: {
                        display: true,
                        text: 'Product Sales'
                      }
                    }
                  }
                });
              </script>

            <!-- Weekly Transactions Line Graphs Section -->
            <div class="col-md-6 mb-4 mt-3">
            <div class="card p-4 shadow-sm">
                <h4 class="mb-4">Weekly Transactions Analysis</h4>
                <canvas id="myChart"></canvas>
            </div>
            </div>

            <script>
                const xValues = [50,60,70,80,90,100,110,120,130,140,150];
                const yValues = [7,8,8,9,9,9,10,11,14,14,15];
                
                new Chart("myChart", {
                  type: "line",
                  data: {
                    labels: xValues,
                    datasets: [{
                      fill: false,
                      lineTension: 0,
                      backgroundColor: "rgba(0,0,255,1.0)",
                      borderColor: "rgba(0,0,255,0.1)",
                      data: yValues
                    }]
                  },
                  options: {
                    legend: {display: false},
                    scales: {
                      yAxes: [{ticks: {min: 6, max:16}}],
                    }
                  }
                });
                </script>
                
        </div>
        

            
        <!-- Assistant Manager List and Weekly Target Section -->
        <div class="row mt-3 d-flex align-items-start">
            <!-- Assistant Manager List -->
            

            <!-- Weekly Target Section -->
            <div class="col-md-12 ">
                <div class="card p-4 shadow-sm">
                    <h4 class="mb-4">Weekly Target</h4>
                    <div class="row ">
                        <div class="col-md-4">
                            <h2>£8000</h2>
                            <p class="text-muted">Target</p>
                            <h3>£6350</h3>
                            <p class="text-muted">Current Weekly Sales</p>
                        </div>
                        <div class="col-md-8">
                            <canvas id="storeSalesChart" style="width:100%;max-width:600px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

            <script>
                // JavaScript to create the bar chart for Store Sales
                const storeSalesCtx = document.getElementById("storeSalesChart").getContext("2d"); // 使用新的 id
                const storeSalesData = {
                    labels: ["Aberdeen", "Dundee", "Edinburgh", "Glasgow"],
                    datasets: [{
                        label: "All Store Performance",
                        backgroundColor: ["#3A7CA5", "#D9DCD6", "#16425B", "#81C3D7"],
                        data: [55, 49, 44, 24],
                    }]
                };

                const storeSalesOptions = {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        title: {
                            display: true,
                            text: "Store Sales Performance"
                        }
                    }
                };

                new Chart(storeSalesCtx, {
                    type: "bar",
                    data: storeSalesData,
                    options: storeSalesOptions
                });
            </script>
        </div>

    </main>

    <!-- Forms Section -->
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col py-3">
                <div class="card text-center" style="box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="DailyShiftTab">Daily Shift</a>
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
    
      <script>
        // Switch between Order and Staff Status
        function switchTab(event, tabId) {
          event.preventDefault();
          document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active-tab'));
          event.target.classList.add('active-tab');
          document.querySelectorAll('.table-container').forEach(container => container.style.display = 'none');
          document.getElementById(tabId).style.display = 'block';
        }
    
        // Filter table rows based on search input
        function filterTable() {
          const searchValue = document.getElementById('searchInput').value.toLowerCase();
          const activeTableBody = document.querySelector('.table-container:not([style*="display: none"]) tbody');
          const rows = activeTableBody.querySelectorAll('tr');
          rows.forEach(row => {
            const rowText = row.textContent.toLowerCase();
            row.style.display = rowText.includes(searchValue) ? '' : 'none';
          });
        }
      </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
