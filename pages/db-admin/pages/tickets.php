<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tickets</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="tickets.css">
</head>

<body>
<?php 
include '../components/navbar.php';
include '../db.php'; 
?>

    <main class="mt-5 pt-4">
        <div class="container-fluid">
            <header class="d-flex align-items-center mb-4">
                <h1 class="h2">Tickets</h1>
                <p class="ms-3 text-muted">Overview of tickets and their statuses.</p>
            </header>

            <?php
            
            // Fetch tickets
            $ticketQuery = "SELECT * FROM tickets";
            $ticketResult = $conn->query($ticketQuery);
            ?>

            <div class="card col">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <span>Ticket Management</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Ticket ID</th>
                                    <th scope="col">Issue</th>
                                    <th scope="col">Staff Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Time Raised</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($ticketResult->num_rows > 0) {
                                    while ($row = $ticketResult->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>{$row['ticket_id']}</td>";
                                        echo "<td>{$row['issue']}</td>";
                                        echo "<td>{$row['staff_name']}</td>";

                                        // Handle status badge
                                        $status = htmlspecialchars($row['status']);
                                        if ($status == 'Open') {
                                            echo '<td><span class="badge bg-warning text-dark">' . $status . '</span></td>';
                                        } elseif ($status == 'Closed') {
                                            echo '<td><span class="badge bg-info text-dark">' . $status . '</span></td>';
                                        } else {
                                            echo '<td><span class="badge bg-secondary text-light">' . $status . '</span></td>';
                                        }

                                        echo "<td>{$row['time_raised']}</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>No tickets found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php
            // Close the database connection
            $conn->close();
            ?>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
