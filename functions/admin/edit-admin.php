
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
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
        editAlert();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function editAlert() {
    echo "<script>Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Your work has been saved',
        showConfirmButton: false,
        timer: 1000 // Set the timer to 1.5 seconds
    }).then(() => {
        setTimeout(() => {
            window.location.href = '../../pages/home-admin.php';
        });
    });</script>";
}
?>
    
</body>
</html>
