<?php 
$host = "labdatabase1.cvhoavzabfmd.us-east-1.rds.amazonaws.com"; 
$username = "callum"; 
$password = "changemee20486"; 
$database = "LabDatabase1"; 
$mysql = new PDO("mysql:host=".$host.";dbname=".$database, 
$username, $password); 
echo "DB linked Successfully! <br>"; 
?> 