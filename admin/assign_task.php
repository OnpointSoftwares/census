<?php
include 'db_connection.php';

$data = json_decode(file_get_contents("php://input"), true);

$enumerator_id = $data['enumerator_id'];
$task_description = $data['task_description'];

$query = "INSERT INTO tasks (enumerator_id, task_description) VALUES (?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param('is', $enumerator_id, $task_description);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false]);
}
?>
