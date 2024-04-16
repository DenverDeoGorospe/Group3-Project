<?php
include('../functions/connection/dbconn.php');

if (isset($_GET['input']) && !empty($_GET['input'])) {
    $input = $_GET['input'];

    $stmt = $conn->prepare("SELECT title FROM tblcapstone WHERE title LIKE :input AND is_status = '1'");
    $stmt->bindValue(':input', '%' . $input . '%', PDO::PARAM_STR);
    $stmt->execute();
    $suggestions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($suggestions) {
        echo json_encode($suggestions);
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode([]);
}
?>
