<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sir_ile";
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['id'])) {

    $fileId = htmlspecialchars($_GET['id']);


    $sqlDeleteFile = "DELETE FROM uploaded_files WHERE id = ?";
    $stmt = $conn->prepare($sqlDeleteFile);
    $stmt->bind_param("i", $fileId);


    $result = $stmt->execute();

    if ($result) {
        echo "File deleted successfully.";
    } else {
        echo "Error deleting file: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid file ID.";
}

header("Location: /simple-simple/home.php");
exit();
