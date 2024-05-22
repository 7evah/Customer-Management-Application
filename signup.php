<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="auth.css">
</head>
<body>
<h1>Sign Up</h1>
    <div class="container">
        
        <?php
        include 'config.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $conn->real_escape_string($_POST['email']);
            $password = $conn->real_escape_string($_POST['password']);
            $password_confirm = $conn->real_escape_string($_POST['password_confirm']);

            if ($password != $password_confirm) {
                echo '<p class="error">Passwords do not match.</p>';
            } else {
                $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
                if ($conn->query($sql) === TRUE) {
                    echo '<p>Account created successfully. <a href="loginpage.php">Login</a></p>';
                } else {
                    echo '<p class="error">Error: ' . $conn->error . '</p>';
                }
            }
        }
        ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirm">Confirm Password:</label>
                <input type="password" id="password_confirm" name="password_confirm" required>
            </div>
            <button type="submit">Sign Up</button>
        </form>
        <p>Already have an account? <a href="loginpage.php">Login</a></p>
    </div>
</body>
</html>
