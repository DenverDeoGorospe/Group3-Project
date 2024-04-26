<?php
include('../functions/connection/dbconn.php');

// Check if the delete parameter is set in the URL
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM tbl_favorite WHERE id = :id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);

    try {
        $stmt->execute();
        header("Location: ../pages/favorite.php");
        exit;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>