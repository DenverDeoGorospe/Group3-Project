<?php
include('../functions/connection/dbconn.php');
// Fetch all capstones from the database
$stmt = $conn->prepare("SELECT c.title as title,c.author as author,c.date_published as date_published,c.abstract as abstract,
c.pdf_file as pdf_file FROM tbl_favorite as f
INNER JOIN tblcapstone as c ON c.id = f.capstoneID
INNER JOIN tbl_register as r ON r.id = f.userID;");
$stmt->execute();
$favorite = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
