<?php
$current_page = 'manage-account.php';
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
    // Update the isLoggedIn column to false for the logged-in user
    $userId = $_SESSION['userId']; // Assuming you have the user ID stored in a session variable

    // Assuming you have a database connection established
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
    $updateSql = "UPDATE accounts SET isLoggedIn = 0 WHERE id = '$userId'";
    $conn->query($updateSql);

    // Close the database connection
    $conn->close();

    // Destroy the session
    session_start();
    session_destroy();

    // Redirect to the login page
    header("Location: ../login.php");
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

// Retrieve all registered accounts that the admin can manage
$fetchAccountsSql = "SELECT * FROM accounts WHERE account_type = 'student'";
$accountsResult = $conn->query($fetchAccountsSql);


// Close the database connection
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
        // Display the modal
        document.getElementById("modal").style.display = "block";

        // Set the input field values
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
            <a href="/seait-students/admin/course-enrollment.php" <?php if ($current_page === 'admin/course-enrollment.php') echo 'class="active"'; ?>>Course Enrollment</a>
        </div>

        <div class="accounts">
            <h2>Registered Accounts:</h2>


            <!-- Add Account Button -->
            <button onclick="openUpdateModal('', '', '')">Add Account</button>

            <!-- Modal -->
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