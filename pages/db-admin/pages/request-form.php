<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Submit Request</title>
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
        <div class="container">
            <header class="d-flex align-items-center mb-4">
                <h1 class="h2">Submit New Request</h1>
            </header>

            <?php
            // Handle form submission
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $managerName = htmlspecialchars($_POST['manager_name']);
                $requestDetails = htmlspecialchars($_POST['request_details']);
                $status = "Pending"; // Default status
                $timeRequested = date("Y-m-d H:i:s"); // Current timestamp

                // Insert into the database
                $insertQuery = "INSERT INTO requests (manager_name, request_details, status, time_requested)
                                VALUES ('$managerName', '$requestDetails', '$status', '$timeRequested')";

                if ($conn->query($insertQuery) === TRUE) {
                    echo '<div class="alert alert-success">Request submitted successfully!</div>';
                } else {
                    echo '<div class="alert alert-danger">Error: ' . $conn->error . '</div>';
                }
            }
            ?>

            <form action="" method="POST" class="card p-4">
                <div class="mb-3">
                    <label for="manager_name" class="form-label">Manager Name</label>
                    <input type="text" name="manager_name" id="manager_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="request_details" class="form-label">Request Details</label>
                    <textarea name="request_details" id="request_details" class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit Request</button>
            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
