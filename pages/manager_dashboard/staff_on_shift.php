<?php
include "db.php";

$staff = [];

$sqlClockedIn = "SELECT staff_id, first_name, last_name, position FROM staff WHERE `clock_in/out` = 1";  
$resultClockedIn = mysqli_query($conn, $sqlClockedIn);

if ($resultClockedIn) {
    while ($row = mysqli_fetch_assoc($resultClockedIn)) {

        $staff[] = [
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'position' => $row['position']
        ];
    }
}

if (empty($staff)) {
    echo json_encode(["message" => "No staff on shift"]);
} else {
    echo json_encode($staff);
}
?>