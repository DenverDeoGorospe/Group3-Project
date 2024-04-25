<?php
include('../functions/connection/dbconn.php');  
// Start session
// Check if user is logged in and if capstone_id is set
if (isset($_GET['capstone_id']) && isset($_GET['id'])) {
    // Include database connection
    include('../functions/connection/dbconn.php');

    try {
        // Sanitize input
        $capstoneId = $_GET['capstone_id'];
        $userId = $_GET['id'];

        // Check if the capstone is already in the user's favorites
        $stmt = $conn->prepare("SELECT COUNT(*) FROM tbl_favorite WHERE userID = :userId AND capstoneID = :capstoneId");
        $stmt->bindParam(":userId", $userId);
        $stmt->bindParam(":capstoneId", $capstoneId);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            // Capstone is already in favorites, so remove it
            $stmt = $conn->prepare("DELETE FROM tbl_favorite WHERE userID = :userId AND capstoneID = :capstoneId");
            $stmt->bindParam(":userId", $userId);
            $stmt->bindParam(":capstoneId", $capstoneId);
            $stmt->execute();
        } else {
            // Capstone is not in favorites, so add it
            $stmt = $conn->prepare("INSERT INTO tbl_favorite (userID, capstoneID) VALUES (:userid, :capstoneid)");
            $stmt->bindParam(":userid", $userId);
            $stmt->bindParam(":capstoneid", $capstoneId);
            $stmt->execute();
        }

        // Redirect back to the page the user was on
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    } catch(PDOException $e) {
        // Log any errors
        echo "Error: " . $e->getMessage();
    }
} 
?>

