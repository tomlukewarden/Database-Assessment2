<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Raise Ticket</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
<?php 
include '../components/navbar.php';
include '../db.php'; 
?>

    <main class="mt-5 pt-4">
        <div class="container">
            <header class="d-flex align-items-center mb-4">
                <h1 class="h2">Raise New Ticket</h1>
            </header>

            <?php
            // Handle foram submission
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $issue = htmlspecialchars($_POST['issue']);
                $staffName = htmlspecialchars($_POST['staff_name']);
                $status = "Open"; // Default status for new tickets
                $timeRaised = date("Y-m-d H:i:s"); // Current timestamp

                // Insert into the database
                $insertQuery = "INSERT INTO tickets (issue, staff_name, status, time_raised)
                                VALUES ('$issue', '$staffName', '$status', '$timeRaised')";

                if ($conn->query($insertQuery) === TRUE) {
                    echo '<div class="alert alert-success">Ticket raised successfully!</div>';
                } else {
                    echo '<div class="alert alert-danger">Error: ' . $conn->error . '</div>';
                }
            }
            ?>

            <form action="" method="POST" class="card p-4">
                <div class="mb-3">
                    <label for="issue" class="form-label">Issue</label>
                    <textarea name="issue" id="issue" class="form-control" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="staff_name" class="form-label">Staff Name</label>
                    <input type="text" name="staff_name" id="staff_name" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Raise Ticket</button>
            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
