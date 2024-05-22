<?php

include 'config.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $sql = "DELETE FROM clients WHERE id = ?";

  
    $stmt = $conn->prepare($sql);

    
    $stmt->bind_param("i", $id);

    
    if ($stmt->execute()) {
        
        header("Location: clientsys.php?message=client deleted successfully");
        exit();
    } else {
       
        header("Location: clientsys.php?error=Error deleting client: " . $conn->error);
        exit();
    }
} else {
    
    header("Location: clientsys.php?error=client ID not provided");
    exit();
}

$stmt->close();


$conn->close();
?>
