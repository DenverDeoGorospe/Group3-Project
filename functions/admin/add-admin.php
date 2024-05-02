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
include('../functions/connection/dbconn.php');

if(isset($_POST['submit']) && isset($_POST['action']) && $_POST['action'] === 'add') {
    // Your existing form data retrieval
    $title = $_POST['title'];
    $author = $_POST['author'];
    $date_pub = $_POST['date_pub'];
    $abstract = $_POST['abstract'];
    $projectAdviser = $_POST['projectAdviser'];
    $category = $_POST['category'];
    $status = 1;

    // File upload handling
    $file_name = $_FILES['pdf_file']['name'];
    $file_tmp = $_FILES['pdf_file']['tmp_name'];
    $file_destination = '../uploads/' . $file_name;

    move_uploaded_file($file_tmp, $file_destination);

    // Insert data into database
    $sql = "INSERT INTO tblcapstone (title, author, date_published, projectAdviser, category, abstract, pdf_file, is_status) 
            VALUES (:title, :author, :date_pub, :projectAdviser, :category, :abstract, :pdf_file, :is_status)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':author', $author);
    $stmt->bindParam(':date_pub', $date_pub);
    $stmt->bindParam(':abstract', $abstract);
    $stmt->bindParam(':projectAdviser', $projectAdviser);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':pdf_file', $file_destination); // Store the file path
    $stmt->bindParam(':is_status', $status);

    try {
        $stmt->execute();
        successAlert(); // Call the function here
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
function successAlert() {
    echo "<script>Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Your work has been saved',
        showConfirmButton: false,
        timer: 1500 // Set the timer to 1.5 seconds
    }).then(() => {
        setTimeout(() => {
            window.location.href = '../pages/home-admin.php';
        }, 1500);
    });</script>";
}
?>
</body>
</html>
