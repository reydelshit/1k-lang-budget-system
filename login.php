<?php

$current_page = 'login.php';
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

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform user authentication
    // Query the database to check if the credentials are valid
    $sql = "SELECT * FROM accounts WHERE username = '$username' AND password = '$password'";

    // Debugging: Echo the SQL query for verification
    echo $sql;

    $result = $conn->query($sql);

    if (!$result) {
        // Error occurred
        echo "Error: " . $conn->error;
        exit();
    }

    if ($result->num_rows > 0) {
        // Successful login
        $row = $result->fetch_assoc();
        $accountType = $row['account_type'];

        // Update the isLoggedIn column to true
        $userId = $row['id']; // Assuming you have a column named 'id' in your 'accounts' table
        $updateSql = "UPDATE accounts SET isLoggedIn = 1 WHERE id = '$userId'";
        $conn->query($updateSql);

        // Store the user ID in a session variable
        $_SESSION['userId'] = $userId;

        if ($accountType === 'student') {
            // Redirect to students.php
            header("Location: students.php");
            exit();
        } else {
            // Redirect to admin.php
            header("Location: admin.php");
            exit();
        }
    } else {
        // Invalid credentials
        echo 'Invalid username or password';
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon-32x32.png">

    <title>SEAIT</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="whole_page_container">
        <header>
            <div>
                <img src="./assets/images/logo.png" alt="logo">
            </div>
            <div class="overlay"></div>
            <div class="navigation_link__container">
                <a href="/seait-students/index.php" <?php if ($current_page === 'index.php') echo 'class="active"'; ?>>Home</a>
                <a href="/seait-students/index.php" <?php if ($current_page === 'index.php') echo 'class="active"'; ?>>About</a>
                <a href="/seait-students/index.php" <?php if ($current_page === 'index.php') echo 'class="active"'; ?>>Contact</a>
            </div>

            <button><a href="/seait-students/login.php" <?php if ($current_page === 'login.php') echo 'class="active"'; ?>>Login</a></button>
        </header>

        <main>
            <form class="login-form" action="login.php" method="post">
                <h1>Login</h1>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required><br><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br><br>


                <input class="button" type="submit" value="Login">
                <a href="/seait-students/signup.php" <?php if ($current_page === 'sigun.php') echo 'class="active"'; ?>>Sign up</a>


            </form>
        </main>
        <footer>
            <span>Copyright 2023. All Rights Reserved</span>
        </footer>

    </div>

</body>

</html>