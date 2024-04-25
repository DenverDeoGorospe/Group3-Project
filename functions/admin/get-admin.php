<?php
include('../functions/connection/dbconn.php');

// Pagination parameters
$limit = 15; // Number of capstones per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page, default is 1

// Calculate offset
$offset = ($page - 1) * $limit;

// Fetch total count of capstones
$totalStmt = $conn->prepare("SELECT COUNT(*) AS total FROM tblcapstone WHERE is_status = '1';");
$totalStmt->execute();
$totalResult = $totalStmt->fetch(PDO::FETCH_ASSOC);
$totalCapstones = $totalResult['total'];

// Calculate total number of pages
$totalPages = ceil($totalCapstones / $limit);

// Fetch capstones for the current page
$stmt = $conn->prepare("SELECT * FROM tblcapstone WHERE is_status = '1' LIMIT :limit OFFSET :offset;");
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$capstones = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
