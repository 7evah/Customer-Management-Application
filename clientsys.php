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

    <h2>clients</h2>
    <a href="" class="button" style="margin-bottom: 10px;">import</a>
    <a href="" class="button" style="margin-bottom: 10px;">export</a>
    <table>
        <thead>
            <tr>
                <th>client id</th>
                <th>full name</th>
                <th>email adress</th>
                <th>phone number</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'config.php';
            $sql = "SELECT * FROM clients";
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
