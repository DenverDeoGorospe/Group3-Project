<?php
include('../functions/connection/dbconn.php');
include('../functions/admin/get-admin.php');

// Check if the delete parameter is set in the URL
if(isset($_GET['reset'])) {
    $id = $_GET['reset'];

    unset($_POST['from_date']);
    unset($_POST['to_date']);
    unset($_POST['forSearch']);      
}
?>