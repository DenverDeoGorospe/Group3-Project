<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php
include('../functions/connection/dbconn.php');

if(isset($_POST['action']) && $_POST['action'] === 'add') {
    $name = $_POST['name'];
    $studentId = $_POST['studentId'];
    $accountType = $_POST['accountType'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Password validation pattern
    $passwordPattern = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";

    // Validate password
    if (!preg_match($passwordPattern, $password)) {
        echo "
        <script type=\"text/javascript\">
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Weak Password.',
                showConfirmButton: true
            }).then(() => {
                history.back();
            });
        </script>
        ";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO tbl_register (name, studentId, accountType, email, password) VALUES (:name, :studentId, :accountType, :email, :password)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':studentId', $studentId);
        $stmt->bindParam(':accountType', $accountType);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);

        try {
            $stmt->execute();
            registerAlert();
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

function registerAlert() {
    echo "<script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Registered Successfully!',
            showConfirmButton: false,
            timer: 1500 
        }).then(() => {
            window.location.href = '../pages/index.php';
        });
    </script>";
}
?>
</body>
</html>
