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

    .form-container {
        display: flex;
        flex-direction: column;
        max-width: 400px;
        margin: 0 auto;

        border: 1px solid orange !important;
    }



    label {
        display: block;
        font-weight: bold;
        margin-top: 1rem;

        /* margin-bottom: 2rem; */
    }

    input[type="text"],
    select {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    input[type="text"]:focus,
    select:focus {
        outline: none;
        border-color: #888;
    }

    button {
        align-self: center;
        margin-top: 2rem;
        width: 10rem;
        height: 2.5rem;
        font-size: 0.8rem !important;

        border-radius: 1.5rem;
        border: none;
        background-color: var(--Bright-Red);
        color: white;
        font-family: var(--font-family);
        font-weight: 700;
        cursor: pointer;
    }

    .student_page {
        /* padding: 0 2rem; */
        margin-bottom: 2rem;
        display: flex;
        align-items: start;
        justify-content: start;
        flex-direction: column;
        height: 100%;

    }

    .success-message {
        background-color: #dff0d8;
        color: #3c763d;
        border: 1px solid #d6e9c6;
        padding: 1rem;
        margin-top: 1rem;
        display: none;
    }
</style>

<script>
    function toggleDropdown(index) {
        const dropdowns = document.getElementsByClassName('dropdown');
        const dropdownContent = dropdowns[index].querySelector('.dropdown-content');
        dropdowns[index].classList.toggle('active');
        dropdownContent.classList.toggle('active');
    }

    document.addEventListener('DOMContentLoaded', function() {
        let successMessage = document.getElementById('success-message');

        let submitButton = document.getElementById('submit-button');


        submitButton.addEventListener('click', function() {
            successMessage.style.display = 'block';
        });
    });
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
                    <h1>Enrollment Form</h1>

                    <div className="form-container">
                        <div id="success-message" class="success-message">Successfully Enrolled!</div>

                        <div className="form-field">
                            <label htmlFor="firstName">First Name:</label>
                            <input type="text" id="firstName" name="firstName" />
                        </div>
                        <div className="form-field">
                            <label htmlFor="lastName">Last Name:</label>
                            <input type="text" id="lastName" name="lastName" />
                        </div>
                        <div className="form-field">
                            <label htmlFor="gender">Gender:</label>
                            <input type="text" id="gender" name="gender" />
                        </div>
                        <div className="form-field">
                            <label htmlFor="dob">Date of Birth:</label>
                            <input type="text" id="dob" name="dob" />
                        </div>
                        <div className="form-field">
                            <label htmlFor="phoneNumber">Phone Number:</label>
                            <input type="text" id="phoneNumber" name="phoneNumber" />
                        </div>
                        <div className="form-field">
                            <label htmlFor="email">Email:</label>
                            <input type="text" id="email" name="email" />
                        </div>
                        <div className="form-field">
                            <label htmlFor="address">Address:</label>
                            <input type="text" id="address" name="address" />
                        </div>
                        <div className="form-field">
                            <label htmlFor="applicationType">Application Type:</label>
                            <select id="applicationType" name="applicationType">
                                <option value="freshman">Freshman</option>
                                <option value="transferee">Transferee</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div className="form-field">
                            <label htmlFor="admissionFor">Admission for:</label>
                            <select id="admissionFor" name="admissionFor">
                                <option value="1st semester">1st Semester</option>
                                <option value="2nd semester">2nd Semester</option>
                            </select>
                        </div>
                        <div className="form-field">
                            <label htmlFor="courseApplied">Course Applied:</label>
                            <select id="courseApplied" name="courseApplied">
                                <option value="BSIT">BSIT</option>
                                <option value="Computer Science">Computer Science</option>
                                <option value="Civil Engineering">Civil Engineering</option>
                                <option value="criminology">Criminology</option>
                            </select>
                        </div>

                        <button id="submit-button">Submit</button>

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