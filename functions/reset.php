<?php
include('../functions/connection/dbconn.php');
include('../functions/admin/get-admin.php');

// Check if the delete parameter is set in the URL
if(isset($_GET['reset'])) {
    $id = $_GET['reset'];

    unset($_POST['from_date']);
    unset($_POST['to_date']);
    unset($_POST['forSearch']);

    $sql = "SELECT * FROM tblcapstone WHERE is_status= '1';";

    $stmt = $conn->prepare($sql);

        $stmt->execute();
        $capstones = $stmt->fetchAll(PDO::FETCH_ASSOC);
        header('location: ../pages/home-admin.php');
       
}
?>