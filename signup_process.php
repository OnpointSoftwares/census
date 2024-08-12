<?php
require_once 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $role = $_POST['role'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    $contact_method = $_POST['contact-method'];
    $nationality = isset($_POST['nationality']) ? $_POST['nationality'] : '';

    // Validate passwords match
    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    // Process file upload
    if (isset($_FILES['national-id']) && $_FILES['national-id']['error'] == 0) {
        $file_tmp = $_FILES['national-id']['tmp_name'];
        $file_name = $_FILES['national-id']['name'];
        $file_dest = 'uploads/' . $file_name;

        // Ensure the uploads directory exists
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }

        if (move_uploaded_file($file_tmp, $file_dest)) {
            $national_id_path = $file_dest;
        } else {
            die("Failed to upload file.");
        }
    } else {
        die("No file uploaded or there was an upload error.");
    }

    // Register the user
    $census = new CensusSystem("localhost", "root", "", "census");
    try {
        $census->registerUser($username, $username, $password, $role, $contact_method, $national_id_path);
        // Redirect to login page after successful registration
        header("Location: login.php");
        exit();
    } catch (Exception $e) {
        die("Registration failed: " . $e->getMessage());
    }
}
?>
