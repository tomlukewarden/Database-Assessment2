<?php 
$host = "espresso-express.cruet0gdarxg.us-east-1.rds.amazonaws.com"; 
$username = "callum"; 
$password = "express123"; 
$database = "espresso-express"; 
$mysql = new PDO("mysql:host=".$host.";dbname=".$database, 
$username, $password); 
echo "DB linked Successfully! <br>"; 
?> 
