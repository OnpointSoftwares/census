<?php
include 'db_connection.php';

$query = "
    SELECT region, COUNT(*) as total_population,
        SUM(CASE WHEN gender = 'Male' THEN 1 ELSE 0 END) as male,
        SUM(CASE WHEN gender = 'Female' THEN 1 ELSE 0 END) as female,
        SUM(CASE WHEN gender = 'Other' THEN 1 ELSE 0 END) as other
    FROM individuals 
    JOIN households ON individuals.household_id = households.household_id 
    GROUP BY region";

$result = $conn->query($query);
$demographics = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $demographics[] = $row;
    }
    echo json_encode($demographics);
} else {
    echo json_encode(['error' => 'Failed to fetch demographics']);
}
?>
