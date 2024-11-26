<?php
include "db.php";
$staff = [];


#will change it to the annual leave when the table is updated
$sqlOnLeave = "SELECT staff_id, first_name, last_name, position FROM staff WHERE `on_leave` = 1";
$resultOnLeave = mysqli_query($conn, $sqlOnLeave);

if ($resultOnLeave) {
    while ($row = mysqli_fetch_assoc($resultOnLeave)) {
        $staff[] = [
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'position' => $row['position']
        ];
    }
} 

header('Content-Type: application/json');
if (empty($staff)) {
    echo json_encode(['message' => 'No staff data found']);
} else {
    echo json_encode($staff);
}
?>