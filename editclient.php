<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Venue</title>
    <link rel="stylesheet" href="edit.css"> 
</head>
<body>
    <h1>Edit client</h1>

    <?php
    
    include 'config.php';

  
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        
        $sql = "SELECT * FROM clients WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
    <form action="udpateclient.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="venueName">full Name:</label>
        <input type="text" id="fullname" name="fullname" value="<?php echo $row['fullname']; ?>" required><br>
        <label for="venueAddress">email Address:</label>
        <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required><br>
        <label for="venueType">phone:</label>
        <input type="text" id="phone" name="phone" value="<?php echo $row['phone']; ?>" required><br>
        <input type="submit" value="Enregistre">
    </form>
    <?php
        } else {
            echo "client not found.";
        }
    } else {
        echo "client ID not provided.";
    }

    
    $conn->close();
    ?>

</body>
</html>
