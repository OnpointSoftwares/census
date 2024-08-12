<?php
include 'db_connection.php';

$query = "SELECT id, name FROM users WHERE role_id = '2'";
$result = $conn->query($query);

$enumerators = [];
while($row = $result->fetch_assoc()) {
    $enumerators[] = $row;
}

echo json_encode($enumerators);
?>
