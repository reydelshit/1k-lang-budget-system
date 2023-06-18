<?php
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
    // Get the submitted username, password, and name
    $username = $_POST['create-username'];
    $password = $_POST['create-password'];
    $name = $_POST['create-name'];
    $accountType = 'student';

    // Insert the new user into the database
    $insertSql = "INSERT INTO accounts (username, password, name, account_type) VALUES ('$username', '$password', '$name', '$accountType')";
    if ($conn->query($insertSql) === TRUE) {
        // Successful signup
        // Retrieve the user ID of the newly created account
        $userId = $conn->insert_id;

        // Update the isLoggedIn column to true
        $updateSql = "UPDATE accounts SET isLoggedIn = 1 WHERE id = '$userId'";
        $conn->query($updateSql);

        // Store the user ID in a session variable
        $_SESSION['userId'] = $userId;
        echo "Account updated successfully.";

        // Redirect back to the previous page
        header("Location: ../manage-account.php");
    } else {
        // Error occurred
        echo "Error: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
