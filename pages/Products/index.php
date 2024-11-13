
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<a href="db.php">Link to DB.PHP file</a>

<?php 
session_start();
// store session data
if(isset($_SESSION['views'])){
$_SESSION['views'] = $_SESSION['views'] + 1;
}
else{
$_SESSION['views'] = 1;
}
// display the session variable
echo "The number of views is ".$_SESSION['views'];
?>


<?php
// Include the database connection
$conn = mysqli_connect("localhost", "root", "", "espresso-express")
$query = "SELECT * FROM Customer WHERE 1";
$stmt = $mysql->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll();
?>

<div class="container">

<!-- HTML with PHP embedded in the table -->
<table class="table table-striped justify-content-evenly">
    <thead >
        <tr class="table-primary">
            <td>Firstname</td>
            <td>Surname</td>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($result as $row) {
        echo "<td>".$row['first_name']."</td>";
        echo "<td>".$row['first_name']."</td></tr>";
        }
        ?>
    </tbody>
</table>
</div>

<br>
<br>



</body>
</html>



