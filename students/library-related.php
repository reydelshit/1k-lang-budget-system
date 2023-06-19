<?php
$current_page = "features.php";

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
    header("Location: /seait-students/login.php");
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
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon-32x32.png">

    <title>SEAIT</title>

    <link rel="stylesheet" href="../style.css">
</head>

<style>
    .dropdown-content {
        display: none;
    }

    .dropdown:hover .dropdown-content,
    .dropdown:focus .dropdown-content,
    .dropdown.active .dropdown-content {
        display: block;
    }
</style>

<script>
    function toggleDropdown(index) {
        const dropdowns = document.getElementsByClassName('dropdown');
        const dropdownContent = dropdowns[index].querySelector('.dropdown-content');
        dropdowns[index].classList.toggle('active');
        dropdownContent.classList.toggle('active');
    }
</script>

<body>

    <div class="whole_page_container">
        <header>
            <div>
                <img src="../assets/images/logo.png" alt="logo">
            </div>
            <div class="overlay"></div>
            <div class="navigation_link__container">
                <a href="/seait-students/index.php" <?php if ($current_page === 'index.php') echo 'class="active"'; ?>>Home</a>
                <a href="/seait-students/index.php" <?php if ($current_page === 'index.php') echo 'class="active"'; ?>>About</a>
                <a href="/seait-students/index.php" <?php if ($current_page === 'index.php') echo 'class="active"'; ?>>Contact</a>
            </div>

            <form class="logout" method="POST" action="">
                <button type="submit" name="logout">Logout</button>
            </form>
        </header>

        <main class="student_page">
            <h1>Hello, <?php echo $name; ?></h1>

            <div class="container">
                <div class="sidebar">
                    <div class="dropdown">
                        <a class="dropbtn" onclick="toggleDropdown(0)">Feature</a>
                        <div class="dropdown-content">
                            <a href="/seait-students/students/enrolment-related.php" <?php if ($current_page === 'enrolment-related.php') echo 'class="active"'; ?>>Enrollment</a>
                            <a href="/seait-students/students/enrolment-guide.php" <?php if ($current_page === 'enrolment-guide.php') echo 'class="active"'; ?>>Enrollment Guide</a>
                            <a href="/seait-students/students/library-related.php" <?php if ($current_page === 'library-related.php') echo 'class="active"'; ?>>Library</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a class="dropbtn" onclick="toggleDropdown(1)">Student Task</a>
                        <div class="dropdown-content">
                            <a href="/seait-students/students/study-load.php" <?php if ($current_page === 'study-load.php') echo 'class="active"'; ?>>Study Load</a>
                            <a href="/seait-students/students/schedule.php" <?php if ($current_page === 'schedule.php') echo 'class="active"'; ?>>Schedule</a>
                            <a href="/seait-students/students/grades.php" <?php if ($current_page === 'grades.php') echo 'class="active"'; ?>>Grades</a>
                        </div>
                    </div>
                </div>

                <div class="main_content">
                    <h1>Welcome to SEAIT Library</h1>

                    <h2>There is no scheduled borrowed book, go to the library for more information</h2>
                </div>
            </div>

    </div>



    </main>
    <footer>
        <span>Copyright 2023. All Rights Reserved</span>
    </footer>

    </div>

</body>



</html>