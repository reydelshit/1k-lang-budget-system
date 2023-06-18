<?php
session_start();
// Perform any necessary cleanup or session handling before logging out
// For example, you can destroy the session or update the 'isLoggedIn' column to false in the database

// Get the user ID from the session
$userId = $_SESSION['userId'];

// Include the necessary database connection code
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "seait-students";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the database connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update the isLoggedIn column to false
$updateSql = "UPDATE accounts SET isLoggedIn = 0 WHERE id = '$userId'";
$conn->query($updateSql);

// Redirect to login.php
header("Location: login.php");
exit();
