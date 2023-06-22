<?php
$current_page = 'manage-account.php';
session_start();

// Assuming you have a database connection established

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "seait-students";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['logout'])) {
    // Update the isLoggedIn column to false for the logged-in user
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


    $conn->close();


    session_start();
    session_destroy();

    header("Location: ../login.php");
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


$fetchAccountsSql = "SELECT * FROM accounts WHERE account_type = 'student'";
$accountsResult = $conn->query($fetchAccountsSql);



$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>

<script>
    function openUpdateModal(id, username, name) {

        document.getElementById("modal").style.display = "block";

        s
        document.getElementById("update-id").value = id;
        document.getElementById("update-username").value = username;
        document.getElementById("update-name").value = name;
    }

    function closeUpdateModal() {
        // Hide the modal and reset the input field values
        document.getElementById("modal").style.display = "none";
        document.getElementById("update-id").value = "";
        document.getElementById("update-username").value = "";
        document.getElementById("update-name").value = "";
    }
</script>

<body>

    <div class="content">
        <div>
            <h1>Hello, <?php echo $name; ?></h1>

            <form method="POST" action="">
                <button type="submit" name="logout">Logout</button>
            </form>
        </div>



        <div class="sidebar">
            <a href="/seait-students/admin/manage-account.php" <?php if ($current_page === 'admin/manage-account.php') echo 'class="active"'; ?>>Manage Student Account</a>
        </div>

        <div class="accounts">
            <h2>Registered Accounts:</h2>


            <button onclick="openUpdateModal('', '', '')">Add Account</button>


            <div id="modal" style="display: none;">
                <h3>Create Account</h3>
                <form action="./functions/create-account.php" method="POST">
                    <input type="hidden" id="create-id" name="create-id">
                    <label for="create-username">Username:</label>
                    <input type="text" id="create-username" name="create-username" required><br><br>
                    <label for="create-name">Name:</label>
                    <input type="text" id="create-name" name="create-name" required><br><br>
                    <label for="create-password">Password:</label>
                    <input type="password" id="create-password" name="create-password" required><br><br>
                    <label for="create-confirm-password">Re-enter Password:</label>
                    <input type="password" id="create-confirm-password" name="create-confirm-password" required><br><br>

                    <input type="submit" value="Create Account">
                    <button type="button" onclick="closeUpdateModal()">Cancel</button>
                </form>
            </div>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                <?php while ($account = $accountsResult->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $account['id']; ?></td>
                        <td><?php echo $account['username']; ?></td>
                        <td><?php echo $account['name']; ?></td>
                        <td>
                            <a href="#" onclick="openUpdateModal('<?php echo $account['id']; ?>', '<?php echo $account['username']; ?>', '<?php echo $account['name']; ?>')">Update</a>
                            <form method="POST" action="./functions/delete-account.php" style="display: inline;">
                                <input type="hidden" name="delete-id" value="<?php echo $account['id']; ?>">
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>

</body>


</html>

<div id="modal" style="display: none;">
    <h3>Update Account</h3>
    <form action="./functions/update-account.php" method="POST">
        <input type="hidden" id="update-id" name="update-id">
        <label for="update-username">Username:</label>
        <input type="text" id="update-username" name="update-username" required><br><br>
        <label for="update-name">Name:</label>
        <input type="text" id="update-name" name="update-name" required><br><br>
        <label for="update-password">Password:</label>
        <input type="password" id="update-password" name="update-password" required><br><br>
        <label for="update-confirm-password">Re-enter Password:</label>
        <input type="password" id="update-confirm-password" name="update-confirm-password" required><br><br>
        <input type="submit" value="Update">
        <button type="button" onclick="closeUpdateModal()">Cancel</button>
    </form>

</div>