<?php
session_start();

$userId = $_SESSION['userId'];


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "seait-students";
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$updateSql = "UPDATE accounts SET isLoggedIn = 0 WHERE id = '$userId'";
$conn->query($updateSql);


header("Location: login.php");
exit();
