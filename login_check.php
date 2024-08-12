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
   // Ensure this function exists and returns user role
    // Redirect based on user role
    switch ($_SESSION['user_role']) {
        case '1':
            ?>
            <script>
            location.replace("admin");
            </script>
            <?php
            break;
        case '2':
            ?>
            <script>
            location.replace("censusEnumerator.php");
            </script>
            <?php
            break;
        case '3':
            ?>
            <script>
            location.replace("dataAnalyst");
            </script>
            <?php
            break;
        case '4':
                ?>
                <script>
                location.replace("researcher");
                </script>
                <?php
                break;
        case '5':
                ?>
                <script>
                location.replace("citizen");
                </script>
                <?php
                break;
        case '6':
                ?>
                <script>
                location.replace("governmentAgent");
                </script>
                <?php
                break;
        default:
        ?>
<script>
        location.replace("login.php?error=1");
            </script>
        <?php
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
