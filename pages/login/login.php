<!-- PHP gathers the username and password as session variables from the form, we can use these to compare what is stored in the database and determine who is logged in or if someone has access -->
<?php

include "db.php";

session_start();

if (isset($_POST['submit'])) {  

// Set Global Session Variables from Form's POST Values
$_SESSION["username"] = $_POST["username"];
$_SESSION["password"] = $_POST["password"];

}       
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>login</title>
</head>


<body>

    <div class="bg-image"
        style="background-image: url('https://picsum.photos/id/113/1700/1000'); height: 100vh">
        <div class="vh-100 d-flex justify-content-center align-items-center">
            <div class="col-md-3">

            <!-- CARD -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Espresso Express</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Sign-in</h6>

                        <!-- Form currently does not redirect anywhere, setting the action to a destination cancels the storing of session variables -->
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="id">Staff ID</label>
                                <input type="text" class="form-control" id="id" placeholder="Enter staff ID" name="username">
                            </div>
                            <div class="form-group py-2">
                                <label for="pass">Password</label>
                                <input type="password" class="form-control" id="pass" placeholder="Password" name="password">
                            </div>
                            <button id="id1" type="submit" value="submit" name="submit" class="btn btn-primary my-2">Login</button>
                        </form>
                        <a href="../test.php" class="card-link">Customer Page</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
<!-- js to open new page if correct info inputted to form -->
<?php
    $sql = "SELECT staff_id, passwords FROM staff ";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<h1>1---------------------------------------------------------------------</h1>";
        // $found = FALSE;
        while ($row = mysqli_fetch_array($result)) {
            if ($_SESSION["username"] == $row['staff_id'] && $_SESSION["password"] == $row['passwords']){
                // $found = TRUE;
                echo "<h1>2------------------------------------------------------------------------------------------------------</h1>";
                header('Location: profile.php');
            } else {
                echo "<h1>Error with if statement</h1>";
                
            }
        }
        
        // if ($found == FALSE) {
            // session_unset();

        // }    
    }
?>

</html>