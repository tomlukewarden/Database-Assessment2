<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Alerts</title>
</head>
<body>

<?php 
include '../components/navbar.php';
include '../../utilities/db.php'; 

// Fetch all alerts from the database
$query = "SELECT alert_id, alert_type, alert_message, status, created_at, updated_at FROM Alerts";
$result = $conn->query($query);
?>

<main class="container my-5">
    <h1 class="text-center">All Alerts</h1>

    <!-- Alerts Table -->
    <div class="table-responsive mt-4">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Alert ID</th>
                    <th scope="col">Alert Type</th>
                    <th scope="col">Message</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Loop through the results and display each alert
                    while ($alert = $result->fetch_assoc()) {
                        // Determine the status class for each alert
                        $statusClass = "";
                        switch ($alert['status']) {
                            case 'Open':
                                $statusClass = "bg-warning text-dark";
                                break;
                            case 'Acknowledged':
                                $statusClass = "bg-info text-dark";
                                break;
                            case 'Closed':
                                $statusClass = "bg-success text-white";
                                break;
                            default:
                                $statusClass = "bg-secondary text-white";
                        }
                        
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($alert['alert_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($alert['alert_type']) . "</td>";
                        echo "<td>" . htmlspecialchars($alert['alert_message']) . "</td>";
                        echo "<td><span class='badge $statusClass'>" . htmlspecialchars($alert['status']) . "</span></td>";
                        echo "<td>" . htmlspecialchars($alert['created_at']) . "</td>";
                        echo "<td>" . htmlspecialchars($alert['updated_at']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    // If no alerts, display a message
                    echo "<tr><td colspan='6' class='text-center'>No alerts found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</main>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
