<?php
$servername = "localhost";
$username = "tom";
$password = "express123";
$dbname = "espresso-express";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>