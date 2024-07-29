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
    public function registerUser($name, $email, $password, $role) {
        $passwordHashed = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("ssss", $name, $email, $passwordHashed, $role);
            $stmt->execute();
            $stmt->close();
        } else {
            error_log("Error preparing statement: " . $this->conn->error);
        }
    }

    // Method to login a user
    public function loginUser($email, $password) {
        $stmt = $this->conn->prepare("SELECT id, name, password, role FROM users WHERE email = ?");
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

    // Method to get a list of all users
    public function getAllUsers() {
        $result = $this->conn->query("SELECT id, name, email, role, created_at FROM users");
        if ($result) {
            $users = [];
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
            return $users;
        } else {
            error_log("Error executing query: " . $this->conn->error);
            return [];
        }
    }

    // Method to get a user by ID
    public function getUserById($userId) {
        $stmt = $this->conn->prepare("SELECT id, name, email, role, created_at FROM users WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            $stmt->close();
            return $user;
        } else {
            error_log("Error preparing statement: " . $this->conn->error);
            return null;
        }
    }

    // Method to update user details
    public function updateUser($userId, $name, $email, $role) {
        $stmt = $this->conn->prepare("UPDATE users SET name = ?, email = ?, role = ? WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("sssi", $name, $email, $role, $userId);
            $stmt->execute();
            $stmt->close();
        } else {
            error_log("Error preparing statement: " . $this->conn->error);
        }
    }

    // Method to delete a user
    public function deleteUser($userId) {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $stmt->close();
        } else {
            error_log("Error preparing statement: " . $this->conn->error);
        }
    }
}

$census = new CensusSystem("localhost", "root", "", "census_system");
$census->registerUser("Alice Smith", "alice@example.com", "password123", "DataCollector");

// Login a user
if ($census->loginUser("alice@example.com", "password123")) {
    echo "Login successful";
} else {
    echo "Login failed";
}

// Get all users
$users = $census->getAllUsers();
print_r($users);

// Get a single user by ID
$user = $census->getUserById(1);
print_r($user);

// Update a user
$census->updateUser(1, "Alice Johnson", "alice.johnson@example.com", "Admin");

// Delete a user
$census->deleteUser(1);

?>
