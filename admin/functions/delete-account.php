<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "seait-students";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['delete-id'])) {

        $accountId = $_POST['delete-id'];


        $deleteSql = "DELETE FROM accounts WHERE id = '$accountId'";
        if ($conn->query($deleteSql) === TRUE) {
            echo "Account deleted successfully.";


            header("Location: ../manage-account.php");
            exit();
        } else {
            echo "Error deleting account: " . $conn->error;
        }
    }
}


$conn->close();
