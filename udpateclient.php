<?php
include 'config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = $_POST['id'];
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    
    $sql = "UPDATE clients SET fullname=?, email=?, phone=? WHERE id=?";

    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $phone, $id);

  
    if ($stmt->execute()) {
        
        header("Location: clientsys.php?message=client updated successfully");
        exit();
    } else {
        
        header("Location: clientsys.php?error=Error updating client: " . $conn->error);
        exit();
    }
} else {
    
    header("Location: clientsys.php");
    exit();
}


$stmt->close();


$conn->close();
?>
