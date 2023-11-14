<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fileId = $_POST['storeID'];
    $filename = $_POST['filename'];
    $filetype = $_POST['filetype'];

    $conn = new mysqli("localhost", "root", "", "sir_ile");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE uploaded_files SET filename='$filename', filetype='$filetype' WHERE id=$fileId";

    if ($conn->query($sql) === TRUE) {
        echo ' <p class="success">Updated successfully. <a href="home.php">Go back to home</a></p>';
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
