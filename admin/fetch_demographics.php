<?php
include 'db_connection.php';

$query = "SELECT region, COUNT(*) AS total_population,
                 SUM(CASE WHEN gender = 'Male' THEN 1 ELSE 0 END) AS male,
                 SUM(CASE WHEN gender = 'Female' THEN 1 ELSE 0 END) AS female,
                 SUM(CASE WHEN gender = 'Other' THEN 1 ELSE 0 END) AS other
          FROM individuals
          JOIN households ON individuals.household_id = households.id
          GROUP BY region";
$result = mysqli_query($conn, $query);

$demographics_data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $demographics_data[] = $row;
}

echo json_encode($demographics_data);
?>
