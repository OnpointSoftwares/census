<?php
session_start();
require_once 'CensusSystem.php'; // Your class file

// Check if user is logged in and is a DataCollector
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'DataCollector') {
    header("Location: login.php"); // Redirect to login if not authorized
    exit();
}

$census = new CensusSystem("localhost", "root", "", "census_system");

// Fetch regions for data entry
$regions = $census->getAllRegions();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Collector Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Data Collector Page</h1>
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</p>
    
    <h2>Add New Household</h2>
    <form action="add_household.php" method="post">
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>
        
        <label for="region_id">Region:</label>
        <select id="region_id" name="region_id" required>
            <?php foreach ($regions as $region): ?>
            <option value="<?php echo htmlspecialchars($region['id']); ?>">
                <?php echo htmlspecialchars($region['name']); ?>
            </option>
            <?php endforeach; ?>
        </select>
        
        <input type="submit" value="Add Household">
    </form>

    <a href="logout.php">Logout</a>
</body>
</html>
