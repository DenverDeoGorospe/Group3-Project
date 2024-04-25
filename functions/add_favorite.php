<?php
// Include database connection
include('../functions/connection/dbconn.php');

// Check if capstone_id is set
if (isset($_GET['capstone_id'])) {
    // Sanitize input
    $capstoneId = $_GET['capstone_id'];
    $userId = $_SESSION['id'];

    // Insert into tbl_favorite
    $stmt = $conn->prepare("INSERT INTO tbl_favorite (userID, capstoneID) VALUES (:userid, :capstoneid)");
$stmt->bindParam(":userid", $userId);
$stmt->bindParam(":capstoneid", $capstoneId);
    
    try {
        $stmt->execute();
        header("Location: ../pages/home-user.php");
        exit;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
