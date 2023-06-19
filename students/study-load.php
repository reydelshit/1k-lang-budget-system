<?php
$current_page = "features.php";

session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "seait-students";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['logout'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "seait-students";


    $conn = new mysqli($servername, $username, $password, $dbname);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $userId = $_SESSION['userId'];
    $updateSql = "UPDATE accounts SET isLoggedIn = 0 WHERE id = '$userId'";
    $conn->query($updateSql);


    $conn->close();


    session_start();
    session_destroy();


    header("Location: /seait-students/login.php");
    exit();
}



$userId = $_SESSION['userId'];


$fetchNameSql = "SELECT name FROM accounts WHERE id = '$userId'";
$result = $conn->query($fetchNameSql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
} else {
    $name = "Unknown";
}

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

    table {
        margin-top: 2rem;
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    .button-container {
        width: 100%;
        display: flex;
        justify-content: flex-end;
    }

    button {
        margin-top: 2rem;
        font-size: 0.8rem !important;

        width: 10rem;
        height: 2.5rem;
        border-radius: 1.5rem;
        border: none;
        background-color: var(--Bright-Red);
        color: white;
        font-family: var(--font-family);
        font-weight: 700;
        cursor: pointer;
    }

    .details {
        margin-top: 2rem;
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
                    <h1>Study Load</h1>

                    <div class="details">
                        <h1>Name: <?php echo $name; ?></h1>
                        <h1>Course: Bachelor of Science in Technology</h1>
                    </div>


                    <div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Course Code</th>
                                    <th>Descriptive Title</th>
                                    <th>Lecture Units</th>
                                    <th>Laboratory Units</th>
                                    <th>Total Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>IT101</td>
                                    <td>Introduction to Programming</td>
                                    <td>3</td>
                                    <td>1</td>
                                    <td>4</td>
                                </tr>
                                <tr>
                                    <td>CS201</td>
                                    <td>Data Structures and Algorithms</td>
                                    <td>4</td>
                                    <td>2</td>
                                    <td>6</td>
                                </tr>
                                <tr>
                                    <td>CE301</td>
                                    <td>Database Management Systems</td>
                                    <td>3</td>
                                    <td>1</td>
                                    <td>4</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="button-container">
                            <button>Download</button>
                        </div>
                    </div>
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