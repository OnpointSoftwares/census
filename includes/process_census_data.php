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
$household_id = $_POST['household_id'];
$region = $_POST['region'];
$household_head = $_POST['household_head'];
$individual_names = $_POST['individual_name'];
$individual_ages = $_POST['individual_age'];
$individual_genders = $_POST['individual_gender'];
$individual_relations = $_POST['individual_relation'];

// Insert household data
$sql = "INSERT INTO households (household_id, region, household_head) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $household_id, $region, $household_head);

if ($stmt->execute()) {
  // Get the ID of the newly inserted household
  $household_id = $stmt->insert_id;

  // Prepare statement for individual data
  $sql_individual = "INSERT INTO individuals (household_id, name, age, gender, relation) VALUES (?, ?, ?, ?, ?)";
  $stmt_individual = $conn->prepare($sql_individual);

  // Loop through individual data and insert
  for ($i = 0; $i < count($individual_names); $i++) {
    $name = $individual_names[$i];
    $age = $individual_ages[$i];
    $gender = $individual_genders[$i];
    $relation = $individual_relations[$i];

    $stmt_individual->bind_param("issss", $household_id, $name, $age, $gender, $relation);
    $stmt_individual->execute();
  }

  // Success response
  echo "Census data has been submitted successfully.";
} else {
  // Error response
  echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$stmt_individual->close();
$conn->close();
?>
