<?php
session_start();
require_once 'CensusSystem.php'; // Your class file

// Check if user is logged in and is an Analyst
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'Analyst') {
    header("Location: login.php"); // Redirect to login if not authorized
    exit();
}

$census = new CensusSystem("localhost", "root", "", "census_system");

// Fetch data for reports
$regions = $census->getAllRegions();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Analyst Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Analyst Page</h1>
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</p>
    
    <h2>View Reports</h2>
    <!-- Example: Region-wise report -->
    <h3>Regions</h3>
    <table>
        <tr><th>ID</th><th>Name</th><th>Description</th></tr>
        <?php foreach ($regions as $region): ?>
        <tr>
            <td><?php echo htmlspecialchars($region['id']); ?></td>
            <td><?php echo htmlspecialchars($region['name']); ?></td>
            <td><?php echo htmlspecialchars($region['description']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <a href="logout.php">Logout</a>
</body>
</html>
