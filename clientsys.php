<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id']) && !isset($_COOKIE['user_id'])) {
    header('Location: loginpage.php');
    exit();
}

// Set the session if the cookie is set
if (isset($_COOKIE['user_id'])) {
    $_SESSION['user_id'] = $_COOKIE['user_id'];
}

include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Admin Panel</h1>
    <div class="logout-container">
        <form action="logout.php" method="post">
            <button type="submit" class="button logout-button">Logout</button>
        </form>
    </div>
    <h2>Clients</h2>
    <!-- Import form -->
    <form action="importcsv.php" method="post" enctype="multipart/form-data" style="margin-bottom: 10px;">
        <input type="file" name="file" accept=".csv">
        <button type="submit" class="button">Import CSV</button>
    </form>
    <!-- Export link -->
    <a href="exportcsv.php" class="button" style="margin-bottom: 10px;">Export CSV</a><br>
    <a href="insertclient.php" class="button" style="margin-bottom: 10px;">Add Client</a>
    <table>
        <thead>
            <tr>
                <th>Client ID</th>
                <th>Full Name</th>
                <th>Email Address</th>
                <th>Phone Number</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $userid = $_SESSION['user_id'];
            $sql = "SELECT * FROM clients WHERE userID = $userid";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["fullname"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["phone"] . "</td>";
                    echo "<td>";
                    echo "<a href='editclient.php?id=" . $row["id"] . "' class='button'>Update</a>";
                    echo "<a href='deleteclient.php?id=" . $row["id"] . "' class='button' style='background-color: #dc3545;'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No client found</td></tr>";
            }

            $result->free();
            ?>
        </tbody>
    </table>
</body>
</html>
