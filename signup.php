<?php

$current_page = 'signup.php';
session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sir_ile";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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

<style>
    .success {
        margin-top: 1rem;
        margin-bottom: 1rem;
        color: green;

    }
</style>

<body>

    <div class="whole_page_container">
        <header>
            <div>
                <img src="./assets/images/logo.png" alt="logo">
            </div>
            <div class="overlay"></div>
            <div class="navigation_link__container">
                <a href="/simple-simple/index.php" <?php if ($current_page === 'index.php') echo 'class="active"'; ?>>Home</a>
                <a href="/simple-simple/index.php" <?php if ($current_page === 'index.php') echo 'class="active"'; ?>>About</a>
                <a href="/simple-simple/index.php" <?php if ($current_page === 'index.php') echo 'class="active"'; ?>>Contact</a>
            </div>

            <button><a href="/simple-simple/login.php" <?php if ($current_page === 'login.php') echo 'class="active"'; ?>>Login</a></button>
        </header>

        <main>
            <form class="login-form sign-up" action="signup.php" method="post">
                <h1>Create an account</h1>
                <label for="signup-name">Name:</label>
                <input type="text" id="signup-name" name="signup-name" required><br><br>

                <label for="signup-username">Username:</label>
                <input type="text" id="signup-username" name="signup-username" required><br><br>
                <label for="signup-password">Password:</label>
                <input type="password" id="signup-password" name="signup-password" required><br><br>

                <?php

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $username = $_POST['signup-username'];
                    $password = $_POST['signup-password'];
                    $name = $_POST['signup-name'];


                    $insertSql = "INSERT INTO accounts (username, password, name) VALUES ('$username', '$password', '$name')";
                    if ($conn->query($insertSql) === TRUE) {

                        $userId = $conn->insert_id;


                        $updateSql = "UPDATE accounts SET isLoggedIn = 1 WHERE id = '$userId'";
                        $conn->query($updateSql);


                        $_SESSION['userId'] = $userId;
                ?>
                        <p class="success">Account created successfully. <a href="login.php">Go back to login</a></p>
                    <?php
                    } else {

                    ?>
                        <p>Error: <?php echo $conn->error; ?></p>
                <?php
                    }
                }
                ?>

                <input class="button" type="submit" value="Create Account">

                <a href="/simple-simple/login.php" <?php if ($current_page === 'login.php') echo 'class="active"'; ?>>Already have an account?</a>
            </form>
        </main>




        <footer>

            <span>Copyright 2023. All Rights Reserved</span>

        </footer>

    </div>


</body>

</html>