<?php 
$host = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "espresso-express"; 
$mysql = new PDO("mysql:host=".$host.";dbname=".$database, 
$username, $password); 
echo "DB linked Successfully! <br>"; 
?> 