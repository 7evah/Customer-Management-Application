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
?>


<?php
include 'config.php';
$ido= $_SESSION['user_id'];

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=clients.csv');

$output = fopen('php://output', 'w');
fputcsv($output, array('Client ID', 'Full Name', 'Email Address', 'Phone Number'));

$sql = "SELECT id,fullname,email,phone FROM clients where userID=$ido";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
}

fclose($output);
?>
