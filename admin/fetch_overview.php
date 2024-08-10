<?php
include 'db_connection.php';

$query_population = "SELECT COUNT(*) as total_population FROM individuals";
$query_households = "SELECT COUNT(*) as total_households FROM households";
$query_regions = "SELECT COUNT(DISTINCT region) as total_regions FROM households";

$population_result = $conn->query($query_population);
$households_result = $conn->query($query_households);
$regions_result = $conn->query($query_regions);

if ($population_result && $households_result && $regions_result) {
    $overview = [
        'total_population' => $population_result->fetch_assoc()['total_population'],
        'total_households' => $households_result->fetch_assoc()['total_households'],
        'total_regions' => $regions_result->fetch_assoc()['total_regions']
    ];
    echo json_encode($overview);
} else {
    echo json_encode(['error' => 'Failed to fetch overview data']);
}
?>
