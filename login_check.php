<?php
session_start();
require_once 'includes/functions.php';

// Create an instance of the CensusSystem class
$census = new CensusSystem("localhost", "root", "", "census");

// Retrieve and sanitize user input
$email = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

// Debugging: output user input (remove in production)

// Validate login credentials
if ($census->loginUser($email, $password)) {
    // Set session variable for user role
    $_SESSION['user_role'] = $census->getUserRole($email); // Ensure this function exists and returns user role

    // Redirect based on user role
    switch ($_SESSION['user_role']) {
        case 'Admin':
            header("Location: admin_dashboard.php");
            break;
        case 'DataCollector':
            header("Location: data_collector_dashboard.php");
            break;
        case 'Viewer':
            header("Location: viewer_dashboard.php");
            break;
        default:
            header("Location: default_dashboard.php");
            break;
    }
    exit();
} else {
    // Redirect back to login with an error
?>
<script>
location.replace("login.php?error=1");
    </script>
<?php
    exit();
}
?>
