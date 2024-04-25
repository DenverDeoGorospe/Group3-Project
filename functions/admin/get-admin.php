<?php
include('../functions/connection/dbconn.php');

// Fetch all capstones from the database
$stmt = $conn->prepare("SELECT * FROM tblcapstone WHERE is_status= '1';");
$stmt->execute();
$capstones = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>