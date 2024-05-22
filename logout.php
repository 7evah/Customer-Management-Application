<?php
session_start();

// Destroy the session
session_unset();
session_destroy();

// Delete the cookie
setcookie('user_id', '', time() - 3600, "/");

header('Location: loginpage.php');
exit();
?>
