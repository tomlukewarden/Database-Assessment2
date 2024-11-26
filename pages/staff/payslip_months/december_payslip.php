<?php

include "..\..\config\db.php";
session_start()

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Bootstrap CSS Link -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Custome CSS Link -->
    <link rel="stylesheet" href="../staff_dashboard.css">

    <title>December Payslip</title>
</head>
<body>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <header>
        <h1 class="d-flex justify-content-center">December Payslip</h1>
        <h2 class="d-flex justify-content-center">Espresso Express</h2>
        <br>
    </header>

    <main class="container-fluid">
        <div class="row">
            <div class="col">
                <table class="table table-secondary">
                <?php
                    //get name
                    $sql = "SELECT first_name, last_name, hourly_rate, hours_worked FROM payslip_december WHERE staff_id = " . $_SESSION['username'];
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
                            echo "<th>Hourly Rate:</th>";
                            echo "<td>£" . $row['hourly_rate'] . "</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<th>Hours Worked:</th>";
                            echo "<td>" . $row['hours_worked'] . "</td>";
                            echo "</tr>";
                        }
                    }
                ?>
                    </tr>
                </table>
            </div>
            <div class="col">
                <table class="table table-secondary">
                <?php
                    //get name
                    $sql = "SELECT national_insurance, taxcode FROM payslip_december WHERE staff_id = " . $_SESSION['username'];
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                    
                        while ($row = mysqli_fetch_array($result))
                        {
                            echo "<tr>";
                            echo "<th>Date:</th>";
                            echo "<td>31/12/2024</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<th>National Insurance Number:</th>";
                            echo "<td>" . $row['national_insurance'] . "</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<th>Tax Code:</th>";
                            echo "<td>" . $row['taxcode'] . "</td>";
                            echo "</tr>";
                        }
                    }
                ?>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-secondary">
                <?php
                    //get name
                    $sql = "SELECT regular_pay, overtime_pay, total_pay FROM payslip_december WHERE staff_id = " . $_SESSION['username'];
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                    
                        while ($row = mysqli_fetch_array($result))
                        {   
                            echo "<tr>"
                            echo "<th>Payments</th>"
                            echo "<td></td>"
                            echo "</tr>"
                            echo "<tr>";
                            echo "<th>Regular pay:</th>";
                            echo "<td>£" . $row['regular_pay'] . "</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<th>Overtime Pay:</th>";
                            echo "<td>£" . $row['overtime_pay'] . "</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<th>Total Pay:</th>";
                            echo "<td>£" . $row['total_pay'] . "</td>";
                            echo "</tr>";
                        }
                    }
                ?>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-secondary">
                    <tr>
                    <?php
                    //get name
                    $sql = "SELECT tax, ni_deduction, pension, total_deductions FROM payslip_december WHERE staff_id = " . $_SESSION['username'];
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                    
                        while ($row = mysqli_fetch_array($result))
                        {   
                            echo "<tr>"
                            echo "<th>Deductions</th>"
                            echo "<td></td>"
                            echo "</tr>"
                            echo "<tr>";
                            echo "<th>Tax:</th>";
                            echo "<td>£" . $row['tax'] . "</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<th>National Insurance:</th>";
                            echo "<td>£" . $row['ni_deduction'] . "</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<th>Pension:</th>";
                            echo "<td>£" . $row['pension'] . "</td>";
                            echo "</tr>";
                            echo "<th>Total Deductions:</th>";
                            echo "<td>£" . $row['total_deductions'] . "</td>";
                            echo "</tr>";
                        }
                    }
                ?>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-secondary">
                <?php
                    //get name
                    $sql = "SELECT total_net_pay FROM payslip_december WHERE staff_id = " . $_SESSION['username'];
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                    
                        while ($row = mysqli_fetch_array($result))
                        {   
                            echo "<tr>";
                            echo "<th>Total Net Pay:</th>";
                            echo "<td>£" . $row['total_net_pay'] . "</td>";
                            echo "</tr>";
                        }
                    }
                ?>
                </table>
            </div>
        </div>
    </main>
    
</body>
</html>