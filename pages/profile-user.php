<?php
include('../functions/connection/dbconn.php');
include('../functions/admin/get-admin.php');
include('../functions/admin/add-admin.php');
include('../functions/admin/edit-admin.php');
include('../functions/admin/delete-admin.php');
include('../functions/type.php');
include('../functions/add_favorite.php');
include('../functions/heartfill.php');

?>

<?php
session_start();

if(!isset($_SESSION["id"])){
	header("location: ../pages/loginPage.php"); 
	exit();
}

if($_SESSION['accountType'] != 'student'){
    session_destroy();
    header("location: ../pages/loginPage.php");
    exit();
}

if(isset($_REQUEST["logout"])){
	session_destroy();
	header("location: ../pages/loginPage.php");
	exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="wrapper">
<aside id="sidebar" class="bg-dark">
    <div class="d-flex">
        <button class="toggle-btn" type="button">
            <i class="bi bi-list"></i>
        </button>
        <div class="sidebar-logo">
            <a href="#">Menu</a>
        </div>
    </div>
    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="../pages/home-user.php" class="sidebar-link">
                <i class="bi bi-house-door-fill"></i>
                <span>Home</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="../pages/favorite.php" class="sidebar-link">
            <i class="bi bi-bookmark-heart-fill"></i>
                <span>Favorites</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="../pages/profile-user.php" class="sidebar-link">
                <i class="bi bi-person-circle"></i>
                <span>Profile</span>
            </a>
        </li>
        
    </ul>
    <div class="sidebar-footer mt-auto"> <!-- Added mt-auto to push the footer to the bottom -->
        <a href="home-admin.php?logout=<?php echo $_SESSION["id"]; ?>" class="sidebar-link">
            <i class="bi bi-box-arrow-left"></i>
            <span>Logout</span>
        </a>
    </div>
</aside>

<div class="container-fluid" style="height:100vh;">


    <div class="row mt-5">
    <div class="col-3"></div>
      <div class="col-sm-6">
        <div class="card mb-4">
          <div class="card-header text-center bg-dark text-light">
            <h5 class="my-3"><?php echo $_SESSION['name'];?></h5>
            <p class="mb-1 text-light"><?php echo $_SESSION['studentId'];?></p>
            <p class="mb-4 text-light"><?php echo $_SESSION['accountType'];?></p>
            <div class="d-flex justify-content-center mb-2">
              <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary">Follow</button>
              <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary ms-1">Message</button>
            </div>
          </div>
          <div class="card-body">
          <div class="row">
            <div class="col-3"></div>
              <div class="col-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-3">
                <p class="text-muted mb-0"><?php echo $_SESSION['name'];?></p>
              </div>
              <div class="col-3"></div>
            </div>
            <hr>
            <div class="row">
            <div class="col-3"></div>
              <div class="col-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-3">
                <p class="text-muted mb-0"><?php echo $_SESSION['email'];?></p>
              </div>
              <div class="col-3"></div>
            </div>
            <hr>
            <div class="row">
            <div class="col-3"></div>
              <div class="col-3">
                <p class="mb-0">Role</p>
              </div>
              <div class="col-3">
                <p class="text-muted mb-0"><?php echo $_SESSION['accountType'];?></p>
              </div>
              <div class="col-3"></div>
            </div>
            <hr>
            </div>
        </div>
        

      </div>
      <div class="col-3"></div>
    </div>

</div>


            </div>
       

</body>
<script>

const hamBurger = document.querySelector(".toggle-btn");

hamBurger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});




</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
<style>

.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}

Similar snippets

</style>
</html>


