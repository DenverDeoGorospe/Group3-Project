<?php
include('../functions/connection/dbconn.php');

// Fetch all capstones from the database
$stmt = $conn->prepare("SELECT * FROM tbl_favorite;");
$stmt->execute();
$capstones = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>