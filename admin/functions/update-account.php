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
    // Get the submitted data
    $accountId = $_POST['update-id'];
    $username = $_POST['update-username'];
    $name = $_POST['update-name'];
    $password = $_POST['update-password'];
    $confirmPassword = $_POST['update-confirm-password'];

    // Perform validation
    if ($password !== $confirmPassword) {
        echo "Error: Passwords do not match.";
        exit();
    }


    // Update the account information in the database
    $updateSql = "UPDATE accounts SET username = '$username', name = '$name', password = '$password' WHERE id = '$accountId'";
    if ($conn->query($updateSql) === TRUE) {
        echo "Account updated successfully.";

        // Redirect back to the previous page
        header("Location: ../manage-account.php");
        exit();
    } else {
        echo "Error updating account: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
