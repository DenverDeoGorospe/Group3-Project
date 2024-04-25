<?php
include('../functions/connection/dbconn.php');  
// Start session
// Check if user is logged in and if capstone_id is set
if (isset($_GET['capstone_id']) && isset($_GET['id'])) {
    // Echo out for debugging
    // Include database connection
    include('../functions/connection/dbconn.php');

    try {
        // Sanitize input
        $capstoneId = $_GET['capstone_id'];
        $userId = $_GET['id'];

        // Insert into tbl_favorite
        $stmt = $conn->prepare("INSERT INTO tbl_favorite (userID, capstoneID) VALUES (:userid, :capstoneid)");
        $stmt->bindParam(":userid", $userId);
        $stmt->bindParam(":capstoneid", $capstoneId);
            
        // Execute the statement
        $stmt->execute();

        // Redirect after successful insertion
        header("Location: ../pages/home-user.php");
        exit;
    } catch(PDOException $e) {
        // Log any errors
        echo "Error: " . $e->getMessage();
    }
} 
?>

