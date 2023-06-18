<?php
// Assuming you have a database connection established

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "seait-students";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the delete button is clicked
    if (isset($_POST['delete-id'])) {
        // Get the account ID to delete
        $accountId = $_POST['delete-id'];

        // Delete the account from the database
        $deleteSql = "DELETE FROM accounts WHERE id = '$accountId'";
        if ($conn->query($deleteSql) === TRUE) {
            echo "Account deleted successfully.";

            // Redirect back to the previous page
            header("Location: ../manage-account.php");
            exit();
        } else {
            echo "Error deleting account: " . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
