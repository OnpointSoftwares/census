<?php
session_start();
require_once 'CensusSystem.php'; // Your class file

// Check if user is logged in and is an Admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'Admin') {
    header("Location: login.php"); // Redirect to login if not authorized
    exit();
}

$census = new CensusSystem("localhost", "root", "", "census_system");

// Fetch data for the dashboard
$users = $census->getAllUsers();
$regions = $census->getAllRegions();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Admin Dashboard</h1>
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</p>
    
    <h2>User Management</h2>
    <table>
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Created At</th></tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo htmlspecialchars($user['id']); ?></td>
            <td><?php echo htmlspecialchars($user['name']); ?></td>
            <td><?php echo htmlspecialchars($user['email']); ?></td>
            <td><?php echo htmlspecialchars($user['role']); ?></td>
            <td><?php echo htmlspecialchars($user['created_at']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Regions</h2>
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
