<!-- 
    - recryled code format
    - no validation yet (incomplete validation)
-->

<?php
session_start();

if(isset($_POST["btn-login"])){
	
	$email = $_POST["email"];
	$password = $_POST["password"];
	
	
    if(strlen($password) < 4){  //change to 8 after testing
		echo "
        <script type=\"text/javascript\">
            alert('Password not match');
            history.back(1);
        </script>
            ";
	}
    else {
		$myRoot = $_SERVER["DOCUMENT_ROOT"];

		require($myRoot."/Group3-Project/functions/connection/dbconn.php");
		
		$sql = "SELECT id,email,password,name,studentId, accountType FROM tbl_register WHERE email = :email";
		
		$val = array(":email" => $email);
		
		$result = $conn->prepare($sql);
		$result->execute($val);
		
		if($result->rowCount() == 1){
			
			$row = $result->fetch(PDO::FETCH_ASSOC);
			
			if(password_verify($password, $row["password"]) && $row["accountType"] == 'admin'){
				$_SESSION["accountType"] = $row["accountType"];
				$_SESSION["id"] = $row["id"];
				$_SESSION["email"] = $row["email"];
                $_SESSION["name"] = $row["name"];
				$_SESSION["studentId"] = $row["studentId"];
				
				header("Location:../pages/home-admin.php");
				exit();
			} else if(password_verify($password, $row["password"]) && $row["accountType"] == 'student'){
				$_SESSION["accountType"] = $row["accountType"];
                $_SESSION["id"] = $row["id"];
				$_SESSION["email"] = $row["email"];
                $_SESSION["name"] = $row["name"];
				$_SESSION["studentId"] = $row["studentId"];
				
				header("Location: ../pages/home-user.php");
				exit();
            }else {
				echo "
        <script type=\"text/javascript\">
            alert('Invalid Credentials');
            history.back(1);
        </script>
            ";
            
			}
			
		} else {
			echo "
        <script type=\"text/javascript\">
            alert('Invalid Credentials');
            history.back(1);
        </script>
            ";
		}
	
	}
	
} else {
	header("Location: ../pages/home-admin.php");
	exit();
}

?>