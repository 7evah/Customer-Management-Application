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
    <title>Insert client</title>
    <link rel="stylesheet" href="st.css"> 
</head>
<body>
    <h1>Insert New client</h1>
    <form action="insertclient.php" method="POST">
        <label for="venueName">full Name:</label>
        <input type="text" id="fullname" name="fullname" required><br>
        <label for="venueAddress">email:</label>
        <input type="text" id="email" name="email" required><br>
        <label for="venueType">phone:</label>
        <input type="text" id="phone" name="phone" required><br>
        <input type="submit" value="Insert">
    </form>

    <?php
    
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       

        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $userid = $_SESSION['user_id'];

        $sql = "INSERT INTO clients (fullname, email, phone, userID) VALUES (?, ?, ?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $fullname, $email, $phone, $userid);

        if ($stmt->execute()) {
            header("Location: clientsys.php?message=client inserted successfully");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
