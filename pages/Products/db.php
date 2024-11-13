<?php 
$host = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "espresso-express"; 
$mysql = new PDO("host=".$host.";dbname=".$database, 
$username, $password); 
echo "DB linked Successfully! "; 
?> 