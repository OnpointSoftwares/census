<?php
include 'db_connection.php';  // Include your database connection file

$query_population = "SELECT COUNT(*) AS total_population FROM individuals";
$query_households = "SELECT COUNT(*) AS total_households FROM households";
$query_regions = "SELECT COUNT(DISTINCT region) AS total_regions FROM households";

$population_result = mysqli_query($conn, $query_population);
$households_result = mysqli_query($conn, $query_households);
$regions_result = mysqli_query($conn, $query_regions);

$population_data = mysqli_fetch_assoc($population_result);
$households_data = mysqli_fetch_assoc($households_result);
$regions_data = mysqli_fetch_assoc($regions_result);

$data = [
    'total_population' => $population_data['total_population'],
    'total_households' => $households_data['total_households'],
    'total_regions' => $regions_data['total_regions'],
];

echo json_encode($data);
?>
