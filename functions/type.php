<?php
include('../functions/connection/dbconn.php');
include('../functions/admin/get-admin.php');

$fromdate = $_POST['from_date'] ?? null;
$todate = $_POST['to_date'] ?? null;
$searchVal = $_POST['forSearch'] ?? null;
$catego = $_POST['category'] ?? null;
if($searchVal == null && $fromdate == null && $todate == null && $catego == null){
    $stmt = $conn->prepare("SELECT * FROM tblcapstone WHERE is_status = '1'");
}else if($fromdate == null && $todate == null && $catego == null){
    $stmt = $conn->prepare("SELECT * FROM tblcapstone WHERE title LIKE '%$searchVal%' AND is_status = '1'");
}else if($fromdate == null && $todate == null && $searchVal == null && $catego != null){
    $stmt = $conn->prepare("SELECT * FROM tblcapstone WHERE category = '$catego' AND is_status = '1'");
}else if($fromdate != null && $todate != null && $searchVal == null && $catego == null){
    $stmt = $conn->prepare("SELECT * FROM tblcapstone WHERE date_published BETWEEN '$fromdate' AND '$todate' AND is_status = '1'");
}
else if($searchVal != null && $fromdate != null && $todate != null && $catego != null){
    $stmt = $conn->prepare("SELECT * FROM tblcapstone WHERE date_published BETWEEN '$fromdate' AND '$todate' AND title LIKE '%$searchVal%' AND category = $catego AND is_status = '1'");
}else{
    $stmt = $conn->prepare("SELECT * FROM tblcapstone WHERE date_published BETWEEN '$fromdate' AND '$todate' AND category = '$catego' AND is_status = '1'");
}

$stmt->execute();
$searchCapstone = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Pagination Logic
$recordsPerPage = 15;
$totalRecords = count($searchCapstone);
$totalPages = ceil($totalRecords / $recordsPerPage);
$page = isset($_GET['page']) && $_GET['page'] <= $totalPages ? $_GET['page'] : 1;
$offset = ($page - 1) * $recordsPerPage;
$searchCapstone = array_slice($searchCapstone, $offset, $recordsPerPage);
?>
