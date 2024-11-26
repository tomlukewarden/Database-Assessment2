<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Database Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
<?php 
include '../components/navbar.php';
include '../../utilities/db.php'; 
?>
    <main class="mt-5 pt-4">
        <div class="container-fluid">
            <h5>Management Staff</h5>
            <?php
            $managerQuery = 'SELECT * 
            FROM Staff 
            WHERE position = "manager" OR position = "assistant"';
            $managerResult = $conn->query($managerQuery);
            ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                        <th scope="col">Name</th>
                            <th scope="col">Position</th>
                            <th scope="col">Staff ID</th>
                            <th scope="col">Store ID</th>
                            <th scope="col">Salary</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($managerResult->num_rows > 0) {
                            // Loop through and display each staff member
                            while ($row = $managerResult->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>{$row['first_name']} {$row['last_name']}</td>";
                                echo "<td>{$row['position']}</td>";
                                echo "<td>{$row['staff_id']}</td>";
                                echo "<td>{$row['store_id']}</td>";
                                echo "<td>{$row['salary']}</td>";
                                echo "<td><button type='button' class='btn btn-primary'>Edit</button></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No staff members found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="container-fluid">
            <h5>Staff Members</h5>
            <?php
            $staffQuery = 'SELECT * 
    FROM Staff
    WHERE position != "manager" AND position != "assistant"';
            $staffResult = $conn->query($staffQuery);
            ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Position</th>
                            <th scope="col">Staff ID</th>
                            <th scope="col">Store ID</th>
                            <th scope="col">Salary</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($staffResult->num_rows > 0) {
                            // Loop through and display each staff member
                            while ($row = $staffResult->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>{$row['first_name']} {$row['last_name']}</td>";
                                echo "<td>{$row['position']}</td>";
                                echo "<td>{$row['staff_id']}</td>";
                                echo "<td>{$row['store_id']}</td>";
                                echo "<td>{$row['salary']}</td>";
                                echo "<td><button type='button' class='btn btn-primary'>Edit</button></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No staff members found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="container-fluid">
            <h5>Suppliers</h5>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <?php
                    $supplierQuery = "SELECT * FROM Supplier";
                    $supplierResult = $conn->query($supplierQuery);
                    ?>
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Supplier ID</th>
                            <th scope="col">Location</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if ($supplierResult->num_rows > 0) {
                            // Loop through and display each supplier
                            while ($row = $supplierResult->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>{$row['supplier_name']}</td>";
                                echo "<td>{$row['supplier_id']}</td>";
                                echo "<td>{$row['location']}</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No suppliers found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        </tbody>
        </table>
        </div>
        </div>

        <div class="container-fluid">
            <h5>AllCustomers</h5>
            <?php
            $customerQuery = 'SELECT * FROM Customer';
            $customerResult = $conn->query($customerQuery);
            ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Loyalty Customer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
if ($customerResult->num_rows > 0) {
    // Loop through and display each customer
    while ($row = $customerResult->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['first_name']} {$row['last_name']}</td>";
        echo "<td>{$row['email']}</td>";
        echo "<td>";
        if ($row['loyalty_id'] != 0) {
            echo "Yes";
        } else {
            echo "No";
        }
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No customers found</td></tr>";
}
?>

                    </tbody>
                </table>
            </div>
        </div>


    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>