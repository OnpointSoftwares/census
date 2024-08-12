<?php
include 'db_connection.php';

$query = "SELECT id, name, email, role_id FROM users";
$result = mysqli_query($conn, $query);

$users_data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $users_data[] = $row;
}

echo json_encode($users_data);
?>
