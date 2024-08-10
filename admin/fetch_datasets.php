<?php
include 'db_connection.php';

$query = "SELECT * FROM datasets ORDER BY created_at DESC";
$result = $conn->query($query);

$datasets = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $datasets[] = $row;
    }
    echo json_encode($datasets);
} else {
    echo json_encode(['error' => 'Failed to fetch datasets']);
}
?>
