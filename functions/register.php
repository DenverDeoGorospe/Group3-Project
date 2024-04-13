<?php
include('../functions/connection/dbconn.php');

if(isset($_POST['submit']) && isset($_POST['action']) && $_POST['action'] === 'add') {
    $name = $_POST['name'];
    $studentId = $_POST['studentId'];
    $accountType = $_POST['accountType'];
    $email = $_POST['email'];
    $password =  $_POST['password'];

    $sql = "INSERT INTO tbl_register (name, studentId, accountType, email, password) VALUES (:name, :studentId, :accountType, :email ,:password)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':studentId', $studentId);
    $stmt->bindParam(':accountType', $accountType);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);

    try {
        $stmt->execute();
        header("Location:../pages/registerPage.php");
        exit;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>