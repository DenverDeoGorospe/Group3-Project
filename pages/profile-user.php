<?php
include ('../functions/connection/dbconn.php');
include ('../functions/getSuggestions.php');
include ('../functions/type.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <div class="container-fluid">
        <div class="row" style="height:100vh;">
            <div class="col-sm-1 bg-dark">
                <div class="left d-flex flex-column justify-content-between align-items-center"
                    style="overflow:hidden; height: 100%;">
                    <ul class="nav nav-pills flex-column mt-3 text-center">
                        <li class="nav-item m-auto pt-3">
                            <a href="home-user.php" class="nav-link" title="" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-original-title="Home">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-house-fill h3 text-light"></i>
                                    <label class="text-light ml-2">Home</label>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item m-auto pt-3">
                            <a href="profile-user.php" class="nav-link" title="" data-bs-toggle="tooltip"
                                data-bs-placement="right">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person-circle h3 text-light"></i>
                                    <label class="text-light ml-2">Profile</label>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-pills mt-auto text-center">
                        <li class="nav-item m-auto pt-3">
                            <a href="#" class="nav-link" title="" data-bs-toggle="tooltip" data-bs-placement="right">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-box-arrow-left h3 text-light"></i>
                                    <label class="text-light ml-2">Logout</label>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div>
                Profile
            </div>
            <div class="">
                <div class="d-flex flex-row justify-content-center align-items-cente">
                    <div class="">
                        <div class="card mt-3 mx-auto" style="max-width: 90%;">
                            <div class="card-body">
                                <h5 class="card-title">User Profile</h5>
                                <p class="card-text">Display user data here</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>