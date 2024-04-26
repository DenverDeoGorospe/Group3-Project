<?php

include('../functions/connection/dbconn.php');


    if(isset($_GET['favorite'])) {
        session_start();
        $faveCapstone = $_GET['favorite'];
        $faveUser = $_SESSION['id'];
    
        $sql = "INSERT INTO tbl_favorite (userID, capstoneID) 
        VALUES ($faveUser, :id)";
    
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $faveCapstone);
    
        try {
            $stmt->execute();
            header("Location: ../pages/home-user.php");
            exit;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

?>
