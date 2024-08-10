<?php
include 'db_connection.php';

$name = $_POST['name'];
$description = $_POST['description'];

// SQL to create a new dataset (you might want to store additional metadata, or apply filters)
$query = "INSERT INTO datasets (name, description) VALUES ('$name', '$description')";

if ($conn->query($query) === TRUE) {
    echo json_encode(['success' => 'Dataset created successfully']);
} else {
    echo json_encode(['error' => 'Failed to create dataset']);
}
?>
