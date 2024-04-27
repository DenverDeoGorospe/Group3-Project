<?php
include($_SERVER["DOCUMENT_ROOT"].'/Group3-Project/functions/connection/dbconn.php');

$stmt = $conn->prepare("SELECT * FROM tblcapstone WHERE id=:edit_id");
$stmt->bindParam(':edit_id', $edit_id);
$stmt->execute();
$capstone = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle form submission for editing
if(isset($_POST['submit']) && isset($_POST['action']) && $_POST['action'] === 'edit') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $date_pub = $_POST['date_pub'];
    $abstract = $_POST['abstract'];
    $projectAdviser = $_POST['projectAdviser'];
    $category = $_POST['category'];
    $id = $_POST['edit_id'];

    $sql = "UPDATE tblcapstone SET title=:title, author=:author, date_published=:date_pub, projectAdviser = :projectAdviser, category=:category, abstract=:abstract WHERE id=:id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':author', $author);
    $stmt->bindParam(':date_pub', $date_pub);
    $stmt->bindParam(':abstract', $abstract);
    $stmt->bindParam(':projectAdviser', $projectAdviser);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':id', $id);

    try {
        $stmt->execute();
        header("Location: /Group3-Project/pages/home-admin.php");
        exit;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>