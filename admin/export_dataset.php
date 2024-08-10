<?php
include 'db_connection.php';

$dataset_id = $_GET['id'];

// Fetch the dataset (this is a simplified version; you may need more complex logic based on your schema)
$query = "SELECT * FROM individuals WHERE household_id IN (SELECT household_id FROM households WHERE dataset_id = $dataset_id)";
$result = $conn->query($query);

if ($result) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename="dataset_' . $dataset_id . '.csv"');

    $output = fopen('php://output', 'w');
    fputcsv($output, array('ID', 'Household ID', 'Name', 'Age', 'Gender', 'Relation to Head'));

    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }

    fclose($output);
} else {
    echo json_encode(['error' => 'Failed to export dataset']);
}
?>
