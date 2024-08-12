<?php
include 'db_connection.php';

// Gender Distribution
$query_gender = "SELECT gender, COUNT(*) AS count FROM individuals GROUP BY gender";
$gender_result = mysqli_query($conn, $query_gender);
$gender_data = [];
while ($row = mysqli_fetch_assoc($gender_result)) {
    $gender_data[$row['gender']] = $row['count'];
}

// Age Groups
$query_age = "SELECT 
                SUM(CASE WHEN age BETWEEN 0 AND 18 THEN 1 ELSE 0 END) AS '0-18',
                SUM(CASE WHEN age BETWEEN 19 AND 35 THEN 1 ELSE 0 END) AS '19-35',
                SUM(CASE WHEN age BETWEEN 36 AND 60 THEN 1 ELSE 0 END) AS '36-60',
                SUM(CASE WHEN age > 60 THEN 1 ELSE 0 END) AS '60+'
              FROM individuals";
$age_result = mysqli_query($conn, $query_age);
$age_data = mysqli_fetch_assoc($age_result);

$data = [
    'gender' => $gender_data,
    'age' => $age_data,
];

echo json_encode($data);
?>
