<?php
header('Content-Type: application/json');

// Database connection (update with your connection details)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "census";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Query to get household heads
$sql = "SELECT id, name FROM household_heads"; // Adjust table and column names as needed
$result = $conn->query($sql);

$heads = [];

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $heads[] = $row;
  }
}

$conn->close();

echo json_encode($heads);
?>
