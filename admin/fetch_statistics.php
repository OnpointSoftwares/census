<?php
include 'db_connection.php';

// Gender Distribution
$query_gender = "SELECT gender, COUNT(*) as count FROM individuals GROUP BY gender";
$gender_result = $conn->query($query_gender);

$gender_data = [];
if ($gender_result) {
    while ($row = $gender_result->fetch_assoc()) {
        $gender_data[$row['gender']] = $row['count'];
    }
}

// Age Groups
$query_age = "
    SELECT 
        SUM(CASE WHEN age BETWEEN 0 AND 18 THEN 1 ELSE 0 END) as '0-18',
        SUM(CASE WHEN age BETWEEN 19 AND 35 THEN 1 ELSE 0 END) as '19-35',
        SUM(CASE WHEN age BETWEEN 36 AND 60 THEN 1 ELSE 0 END) as '36-60',
        SUM(CASE WHEN age > 60 THEN 1 ELSE 0 END) as '60+'
    FROM individuals";
$age_result = $conn->query($query_age);

$age_data = $age_result->fetch_assoc();

echo json_encode(['gender' => $gender_data, 'age' => $age_data]);
?>
