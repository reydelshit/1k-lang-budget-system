<?php

$current_page = basename($_SERVER['PHP_SELF']);

session_start();

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

// Check if the logout button is clicked
if (isset($_POST['logout'])) {
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

    // Update the isLoggedIn column to false for the logged-in user
    $userId = $_SESSION['userId']; // Assuming you have the user ID stored in a session variable
    $updateSql = "UPDATE accounts SET isLoggedIn = 0 WHERE id = '$userId'";
    $conn->query($updateSql);

    // Close the database connection
    $conn->close();

    // Destroy the session
    session_start();
    session_destroy();

    // Redirect to the login page
    header("Location: login.php");
    exit();
}


// Retrieve the user ID from the session
$userId = $_SESSION['userId'];

// Query the database to fetch the user's name
$fetchNameSql = "SELECT name FROM accounts WHERE id = '$userId'";
$result = $conn->query($fetchNameSql);

// Check if the query was successful
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
} else {
    $name = "Unknown";
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <div class="content">
        <div>
            <h1>Hello, <?php echo $name; ?></h1>

            <form method="POST" action="">
                <button type="submit" name="logout">Logout</button>
            </form>
        </div>

        <div class="sidebar">
            <a href="/seait-students/admin/manage-account.php" <?php if ($current_page === 'admin/manage-account.php') echo 'class="active"'; ?>>Manage Student Account</a>
            <a href="/seait-students/admin/course-enrollment.php" <?php if ($current_page === 'admin/course-enrollment.php') echo 'class="active"'; ?>>Course Enrollment</a>
        </div>
    </div>
</body>

</html>