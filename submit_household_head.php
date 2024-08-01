<?php
// Database connection (update with your connection details)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "census";

// Create a new connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get data from the form
$household_head_name = $_POST['household_head_name'];

// Prepare and execute the insert statement
$sql = "INSERT INTO household_heads (name) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $household_head_name);

if ($stmt->execute()) {
  echo "Household head has been added successfully.";
} else {
  echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
