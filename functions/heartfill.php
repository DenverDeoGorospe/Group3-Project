<?php
// Function to check if a capstone is in the user's favorites
function isCapstoneInFavorites($capstoneId, $userId) {
    include('../functions/connection/dbconn.php');

    try {
        // Prepare and execute a query to check if the capstone is in favorites
        $stmt = $conn->prepare("SELECT COUNT(*) FROM tbl_favorite WHERE userID = :userId AND capstoneID = :capstoneId");
        $stmt->bindParam(":userId", $userId);
        $stmt->bindParam(":capstoneId", $capstoneId);
        $stmt->execute();

        // Fetch the count of matching rows
        $count = $stmt->fetchColumn();

        // Return true if count is greater than 0 (capstone is in favorites), false otherwise
        return $count > 0;
    } catch(PDOException $e) {
        // Handle any errors here (e.g., log or display an error message)
        echo "Error: " . $e->getMessage();
        return false; // Return false in case of an error
    }
}
?>
