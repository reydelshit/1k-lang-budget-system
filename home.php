<?php
$current_page = "features.php";

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sir_ile";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['logout'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sir_ile";

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


    header("Location: /simple-simple/login.php");
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


$sqlFetchFiles = "SELECT * FROM uploaded_files";

$result = $conn->query($sqlFetchFiles);
if ($result && $result->num_rows > 0) {
    $files = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $files = [];
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon-32x32.png">

    <title>Assignment</title>

    <link rel="stylesheet" href="./style.css">
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


    img {
        margin-top: 2rem;
        width: 80%;
        height: 80%;

    }


    .main_page {
        height: 100vh;
        width: 100%;
        display: flex;
        align-items: center;

        justify-content: center;
        flex-direction: column;

        /* border: 1px solid orange; */
    }

    .file_upload form {
        width: 60rem;
        height: 20rem;
        flex-direction: column;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: white;
        -webkit-box-shadow: 3px 3px 10px 3px #dddddd;
        -moz-box-shadow: 3px 3px 10px 3px #dddddd;
        box-shadow: 3px 3px 10px 3px #dddddd;
        border-radius: 10px;

        /* border: 1px solid orange; */
    }


    input[type="file"]::file-selector-button {
        border-radius: 4px;
        padding: 0 16px;
        height: 40px;
        cursor: pointer;
        background-color: white;
        border: 1px solid rgba(0, 0, 0, 0.16);
        box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.05);
        margin-right: 16px;
        transition: background-color 200ms;
    }


    input[type="file"]::file-selector-button:hover {
        background-color: #f3f4f6;
    }

    input[type="file"]::file-selector-button:active {
        background-color: #e5e7eb;
    }


    .submit_btn {
        width: 10rem;
        height: 2.5rem;
        font-size: 0.8rem !important;
        margin: 2rem 0;
        border-radius: 1.5rem;
        border: none;
        background-color: var(--Bright-Red);
        color: white;
        font-family: var(--font-family);
        font-weight: 700;
        cursor: pointer;
    }

    .view_file {
        color: blue;
        text-decoration: none;
        font-weight: bold;
        margin-right: 2rem;

    }

    .success_message {
        background-color: green;
        padding: 0.5rem;
        border-radius: 8px;
        color: white;
    }

    .error_message {
        background-color: red;
        padding: 1rem;
        border-radius: 8px;
        color: white;
    }

    #updateModal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
        padding-top: 60px;
    }

    .modal-content {
        background-color: #fefefe;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<script>
    function openUpdateModal(fileID, filename, filetype) {

        console.log(fileID, filename, filetype)

        let updateModal = document.getElementById('updateModal');
        updateModal.style.display = 'block';

        let fileIDInput = document.getElementById('updateForm').elements['storeID'];
        fileIDInput.value = fileID;


        let filenameInput = document.getElementById('updateForm').elements['filename'];
        filenameInput.value = filename;

        let filetypeInput = document.getElementById('updateForm').elements['filetype'];
        filetypeInput.value = filetype;
    }

    function closeUpdateModal() {
        let updateModal = document.getElementById('updateModal');
        updateModal.style.display = 'none';
    }
</script>

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

            <form class="logout" method="POST" action="">
                <button type="submit" name="logout">Logout</button>
            </form>
        </header>

        <main class="main_page ">
            <h1>Hello, <?php echo $name; ?></h1>

            <div class="file_upload">
                <form onsubmit="window.location.reload()" method="post" enctype="multipart/form-data">
                    <input type="file" name="file" />
                    <input class="submit_btn" type="submit">

                    <div>
                        <?php

                        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_FILES["file"]["name"])) {
                            $target_dir = "uploads/";
                            $target_file = $target_dir . basename($_FILES["file"]["name"]);

                            if (file_exists($target_file)) {
                                echo "<div class='error_message'>Sorry, the file already exists. </div>";
                            } else {
                                if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {

                                    $filename = $_FILES["file"]["name"];
                                    $filetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


                                    $conn = new mysqli("localhost", "root", "", "sir_ile");

                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    }

                                    $sql = "INSERT INTO uploaded_files (filename, filetype) VALUES ('$filename', '$filetype')";

                                    if ($conn->query($sql) === TRUE) {
                                        echo "<div class='success_message'>The file has been uploaded successfully and the details have been saved to the database. <br> <a class='view_file' href='$target_file'>View file</a></div>";
                                        echo '<button class="submit_btn" onclick="window.location.reload()">reload page</button>';
                                    } else {
                                        echo "<div class='error_message'>Error: " . $sql . "<br>" . $conn->error . "</div>";
                                    }

                                    $conn->close();
                                } else {
                                    echo "<div class='error_message'>Sorry, there was an error uploading your file. </div>";
                                }
                            }
                        }
                        ?>
                    </div>
                </form>
                <div style="margin-top: 20px;">

                    <?php

                    if (!empty($files)) {
                        echo '<table style="border-collapse: collapse; width: 100%; margin-bottom: 20px;" border="1">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th style="padding: 10px; text-align: left;">ID</th>
                    <th style="padding: 10px; text-align: left;">File Name</th>
                    <th style="padding: 10px; text-align: left;">File Type</th>
                    <th style="padding: 10px; text-align: left;">Actions</th>
                </tr>
            </thead>
            <tbody>';

                        foreach ($files as $file) {
                            echo '<tr>
                <td style="padding: 10px;">' . $file['id'] . '</td>
                <td style="padding: 10px;">' . $file['filename'] . '</td>
                <td style="padding: 10px;">' . $file['filetype'] . '</td>
                <td style="padding: 10px;">
                    <a href="#" onclick="openUpdateModal(' . $file['id'] . ', \'' . $file['filename'] . '\', \'' . $file['filetype'] . '\')">Update</a>
                    <a href="functions/delete.php?id=' . $file['id'] . '" onclick="return confirm(\'Are you sure you want to delete this file?\')">Delete</a>
                </td>
            </tr>';
                        }

                        echo '</tbody></table>';
                    } else {
                        echo '<p>No files found.</p>';
                    }
                    ?>

                </div>
            </div>
            <div id="updateModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeUpdateModal()">&times;</span>


                    <form action="update.php" method="post" id="updateForm">
                        <input type="hidden" id="storeID" name="storeID" value="<?= $file['id'] ?>">

                        <label for="filename">File Name:</label>
                        <input type="text" id="filename" name="filename" value="<?= $file['filename'] ?>">

                        <label for="filetype">File Type:</label>
                        <input type="text" id="filetype" name="filetype" value="<?= $file['filetype'] ?>">

                        <input type="hidden" name="id" value="<?= $file['id'] ?>">

                        <input type="submit" value="Update">

                    </form>
                </div>
            </div>

        </main>
        <footer>
            <span>Copyright 2023. All Rights Reserved</span>
        </footer>

    </div>
</body>

</html>