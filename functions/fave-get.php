<?php
include('../functions/connection/dbconn.php');


$searchVal = $_POST['forSearchFave'] ?? null;

$stmt = $conn->prepare("SELECT c.title as title,c.author as author,c.date_published as date_published,c.abstract as abstract, f.id,
c.pdf_file as pdf_file FROM tbl_favorite as f
INNER JOIN tblcapstone as c ON c.id = f.capstoneID
INNER JOIN tbl_register as r ON r.id = f.userID
AND (c.title LIKE '%$searchVal%')");
$stmt->execute();
$favorite = $stmt->fetchAll(PDO::FETCH_ASSOC);


//pagination logic
$recordsPerPage = 15;
$totalRecords = count($favorite);
$totalPages = ceil($totalRecords / $recordsPerPage);
$page = isset($_GET['page']) && $_GET['page'] <= $totalPages ? $_GET['page'] : 1;
$offset = ($page - 1) * $recordsPerPage;
$favorite = array_slice($favorite, $offset, $recordsPerPage);
?>
