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
$userid = $_SESSION['user_id'];

if (isset($_FILES['file']['name'])) {
    $filename = $_FILES['file']['name'];
    $file_ext = pathinfo($filename, PATHINFO_EXTENSION);

    if ($file_ext == "csv") {
        $handle = fopen($_FILES['file']['tmp_name'], 'r');

        // Skip the first row if it contains headers
        fgetcsv($handle, 1000, ",");

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Check if the row is not empty
            if (count($data) == 4 && !empty($data[0]) && !empty($data[1]) && !empty($data[2]) && !empty($data[3])) {
                $id = $data[0];
                $fullname = $data[1];
                $email = $data[2];
                $phone = $data[3];
                

                $sql = "INSERT INTO clients (id, fullname, email, phone,userID) VALUES ('$id', '$fullname', '$email', '$phone','$userid') 
                        ON DUPLICATE KEY UPDATE fullname='$fullname', email='$email', phone='$phone', userID='$userid'";
                $conn->query($sql);
            }
        }

        fclose($handle);
        echo "CSV file has been successfully imported.";
    } else {
        echo "Please upload a valid CSV file.";
    }
}
?>

<a href="clientsys.php">Back to Admin Panel</a>
