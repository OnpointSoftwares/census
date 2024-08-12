<?php

class CensusSystem {
    private $conn;

    // Constructor to establish database connection
    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Destructor to close the database connection
    public function __destruct() {
        $this->conn->close();
    }

    // Method to register a new user
    public function registerUser($name, $email, $password, $role, $contact_method, $national_id_path) {
        $this->conn->begin_transaction();
        try {
            // Get the role ID
            $stmt = $this->conn->prepare("SELECT id FROM roles WHERE role_name = ?");
            $stmt->bind_param("s", $role);
            $stmt->execute();
            $stmt->bind_result($role_id);
            $stmt->fetch();
            $stmt->close();

            // Insert into users table
            $passwordHashed = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $this->conn->prepare("INSERT INTO users (name, email, password, role_id) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssi", $name, $email, $passwordHashed, $role_id);
            $stmt->execute();
            $user_id = $stmt->insert_id; // Get the inserted user ID
            $stmt->close();

            // Insert into user_profiles table
            $stmt = $this->conn->prepare("INSERT INTO user_profiles (user_id, contact_method, national_id_path) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $user_id, $contact_method, $national_id_path);
            $stmt->execute();
            $stmt->close();

            // Commit transaction
            $this->conn->commit();
        } catch (Exception $e) {
            // Rollback transaction if there is an error
            $this->conn->rollback();
            error_log("Error registering user: " . $e->getMessage());
            throw new Exception("An error occurred during registration. Please try again.");
        }
    }

    // Method to login a user
    public function loginUser($email, $password) {
        $stmt = $this->conn->prepare("SELECT id, name, password, role_id FROM users WHERE email = ?");
        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($id, $name, $hashedPassword, $role);
            if ($stmt->fetch() && password_verify($password, $hashedPassword)) {
                session_start();
                $_SESSION['user_id'] = $id;
                $_SESSION['user_name'] = $name;
                $_SESSION['user_role'] = $role;
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        } else {
            error_log("Error preparing statement: " . $this->conn->error);
            return false;
        }
    }
}
?>
