
<?php 

include 'db.php'; 
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assistant Manager Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" href="./assistant-manager.css">
    <style>
    .dashboard-title {
        font-size: 2rem;
    }

    .profile-pic {
        width: 40px;
        height: 40px;
        object-fit: cover;
      }

    .sales-list {
        list-style: none;
        padding-left: 0;
    }
    .sales-list li {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 8px;
    }

    /* Style for active tab */
    .active-tab {
        font-weight: bold;
        color: #dc3545;
        border-bottom: 2px solid #dc3545;
      }

      /* Custom table header style */
      table thead {
        background-color: #f8f9fa;
        font-weight: bold;
      }

      /* Custom button-like status styles */
      .status {
        display: inline-block;
        padding: 0.2rem 0.5rem;
        border-radius: 0.5rem;
        font-size: 0.85rem;
        color: #fff;
        text-align: center;
      }
      .status-success { background-color: #28a745; }
      .status-open { background-color: #fd7e14; }
      .status-return { background-color: #6f42c1; }
      .status-process { background-color: #ffc107; }
      </style>

  </head>

  <body>

    <!--nav-->
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
                        <li class="nav-item"><a class="nav-link active" href="assistant_manager_dashboard.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="assistant_manager_profile.php">Profile</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown">Assistant Manager Tools</a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="users_AS_view.php">All Staff</a>
                                </li>
                                <li><a class="dropdown-item"
                                        href="transactions_AS_view.php">Transactions</a>
                                </li>
                                <li><a class="dropdown-item" href="products_AS_view.php">Product</a></li>
                                <li><a class="dropdown-item" href="suppliers_AS_view.php">Suppliers</a></li>
                                
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
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5>All Assistant Manager</h5>
                    </div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex align-items-center">
                            <img src="https://media.tenor.com/LE7DIybEseAAAAAi/bunny.gif" 
                                class="rounded-circle me-3 profile-pic" 
                                alt="Assistant Manager 1">                       
                            <div>
                                <strong>
                                    <a href="http://127.0.0.1:5501/pages/assistant-manager-view/Assistant-managers-dashboard/Aberdeen.html" class="text-decoration-none text-dark">Aberdeen Assistant Manager</a>
                                </strong>
                            </div>
                        </div>

                        <div class="list-group-item d-flex align-items-center">
                            <img src="https://lh3.googleusercontent.com/proxy/JDS28PW_z_X4g65Bk4eufgE8fpB9HEvLGWwSZK0gPq8gS8DseRVV14kakXMngBaw6Yzz-GzhdEvD6_BJko8bTES76tX5uCzHJjQGRkxk" 
                                class="rounded-circle me-3 profile-pic" 
                                alt="Assistant Manager 2"> 
                            <div>
                                <strong>
                                    <a href="http://127.0.0.1:5501/pages/assistant-manager-view/Assistant-managers-dashboard/Dundee.html" class="text-decoration-none text-dark">Dundee Assistant Manager</a>
                                </strong>
                            </div>
                        </div>

                        <div class="list-group-item d-flex align-items-center">
                            <img src="https://i.pinimg.com/originals/fb/b2/8c/fbb28cf9534ecf1cf4576cdfeef3fef4.gif" 
                                class="rounded-circle me-3 profile-pic" 
                                alt="Assistant Manager 3"> 
                            <div>
                                <strong>
                                    <a href="http://127.0.0.1:5501/pages/assistant-manager-view/Assistant-managers-dashboard/Edinburgh.html" class="text-decoration-none text-dark">Edinburgh Assistant Manager</a>
                                </strong>
                            </div>
                        </div>

                        <div class="list-group-item d-flex align-items-center">
                            <img src="https://cdn3.emoji.gg/emojis/8678-bun-sleep.gif" 
                                class="rounded-circle me-3 profile-pic" 
                                alt="Assistant Manager 4"> 
                            <div>
                                <strong>
                                    <a href="http://127.0.0.1:5501/pages/assistant-manager-view/Assistant-managers-dashboard/Glasgow.html" class="text-decoration-none text-dark">Glasgow Assistant Manager</a>
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    

            <!-- Weekly Target Section -->
            <div class="col-md-8 ms-3;">
                <div class="card p-4 shadow-sm">
                    <h4 class="mb-4">Weekly Target</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <h2>$8000</h2>
                            <p class="text-muted">Target</p>
                            <h3>$6350</h3>
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
    <div class="container mt-5 mb-5">
    <div class="card p-4 shadow-sm">
        <!-- Tabs -->
        <ul class="nav nav-pills mb-3" id="statusTabs">
          <li class="nav-item">
            <a class="nav-link active-tab" href="#" onclick="switchTab(event, 'orderStatus')">Order Status</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="switchTab(event, 'staffStatus')">Staff Status</a>
          </li>
        </ul>
    
        <!-- Order Status Table -->
        <div id="orderStatus" class="table-container">
          <table class="table table-bordered text-center">
            <thead>
              <tr>
                <th>Invoice</th>
                <th>Customers</th>
                <th>From</th>
                <th>Item</th>
                <th>Price</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody id="orderTableBody">
              <tr>
                <td>#25</td>
                <td>Kamillah</td>
                <td>Glasgow</td>
                <td>coffee tin</td>
                <td>£3</td>
                <td><span class="status status-success">Success</span></td>
              </tr>
              <tr>
                <td>#24</td>
                <td>Ezri</td>
                <td>Glasgow</td>
                <td>americano blend</td>
                <td>£5</td>
                <td><span class="status status-open">Open</span></td>
              </tr>
              <tr>
                <td>#23</td>
                <td>Dallon</td>
                <td>Glasgow</td>
                <td>coffee tin</td>
                <td>£3</td>
                <td><span class="status status-return">Return</span></td>
              </tr>
              <tr>
                <td>#22</td>
                <td>Dita</td>
                <td>Glasgow</td>
                <td>green</td>
                <td>£3</td>
                <td><span class="status status-success">Success</span></td>
              </tr>
              <tr>
                <td>#21</td>
                <td>Vivi</td>
                <td>Aberdeen</td>
                <td>americano blend</td>
                <td>£5</td>
                <td><span class="status status-process">Process</span></td>
              </tr>
            </tbody>
          </table>
        </div>
    
        <!-- Staff Status Table -->
        <div id="staffStatus" class="table-container" style="display: none;">
          <table class="table table-bordered text-center">
            <thead>
              <tr>
                <th>Name</th>
                <th>Staff Role</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody id="staffTableBody">
              <tr>
                <td>Liam Caldwell</td>
                <td>Barista</td>
                <td><span class="status status-open">Clock in</span></td>
              </tr>
              <tr>
                <td>Isobel Bennet</td>
                <td>Barista</td>
                <td><span class="status status-open">Late</span></td>

              </tr>
              <tr>
                <td>Ian Crow</td>
                <td>Barista</td>
                <td><span class="status status-open">take leave</span></td>
              </tr>
              <tr>
                <td>Sam Samuel</td>
                <td>Barista</td>
                <td><span class="status status-open">Clock in</span></td>
              </tr>
              <tr>
                <td>Mags Stewart</td>
                <td>Barista</td>
                <td><span class="status status-open">Clock out</span></td>
              </tr>
            </tbody>
          </table>
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
