<?php
include('../functions/connection/dbconn.php');
session_start();

// Check if the delete parameter is set in the URL
if(isset($_GET['id'])) {
    $capstoneid = $_GET['id'];
    $userid = $_SESSION['id'];

    $sql = "DELETE FROM tbl_favorite WHERE capstoneID = :capstoneid AND userID = :userid";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':capstoneid', $capstoneid);
    $stmt->bindParam(':userid', $userid);

    try {
        $stmt->execute();
        header("Location: ../pages/favorite.php");
        exit;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>