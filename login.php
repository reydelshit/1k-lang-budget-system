<?php

$current_page = 'login.php';
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "seait-students";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM accounts WHERE username = '$username' AND password = '$password'";

    echo $sql;

    $result = $conn->query($sql);

    if (!$result) {

        echo "Error: " . $conn->error;
        exit();
    }

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $accountType = $row['account_type'];


        $userId = $row['id'];
        $updateSql = "UPDATE accounts SET isLoggedIn = 1 WHERE id = '$userId'";
        $conn->query($updateSql);


        $_SESSION['userId'] = $userId;

        if ($accountType === 'student') {

            header("Location: students.php");
            exit();
        } else {

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