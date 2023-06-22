<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "seait-students";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['create-username'];
    $password = $_POST['create-password'];
    $name = $_POST['create-name'];
    $accountType = 'student';


    $insertSql = "INSERT INTO accounts (username, password, name, account_type) VALUES ('$username', '$password', '$name', '$accountType')";
    if ($conn->query($insertSql) === TRUE) {

        $userId = $conn->insert_id;


        $updateSql = "UPDATE accounts SET isLoggedIn = 1 WHERE id = '$userId'";
        $conn->query($updateSql);


        $_SESSION['userId'] = $userId;
        echo "Account updated successfully.";


        header("Location: ../manage-account.php");
    } else {

        echo "Error: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
