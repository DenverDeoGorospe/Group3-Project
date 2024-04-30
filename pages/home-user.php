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
	header("location: ../pages/login.php"); 
	exit();
}

if($_SESSION['accountType'] != 'student'){
    session_destroy();
    header("location: ../pages/login.php");
    exit();
}

if(isset($_REQUEST["logout"])){
	session_destroy();
	header("location: ../pages/login.php");
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
    <a href="#" class="sidebar-link" onclick="confirmLogout()"> <!-- Use "#" for href to prevent default navigation -->
    <i class="bi bi-box-arrow-left"></i>
    <span>Logout</span>
</a>

<script>
function confirmLogout() {
    Swal.fire({
        title: "Are you sure?",
        text: "You will be logged out.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, logout"
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect to logout URL
            window.location.href = "home-admin.php?logout=<?php echo $_SESSION['id']; ?>";
        }
    });
}
</script>
    </div>
</aside>

<div class="container-fluid" style="overflow:hidden; height: 100%;">
    <div class="row" style="height:100vh;">
        <div class="col-sm-12" style="overflow-y:auto; height: 100%;">
            <div class="scrollable-right">
                <!-- Capstone Manager -->
                <div class="sticky-top"  style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                    <div class="row bg-dark">  
                        <div class="h3 text-light text-center p-1">Capstone Manager</div>  
                    </div>
                    <form method="post"> 
                        <div class="row bg-light">
                            <div class="col-sm-12 text-center">
                                <div style="display: inline-block; width:75%;">
                                    <div class="input-group m-3">
                                        <input type="text" class="form-control shadow-none" id="capSearch" placeholder="Search" name="forSearch" value="<?php echo (isset($searchVal))? $searchVal: null;?>">
                                        <button type="submit" name="capSearch" value="SEARCH" class="btn btn-primary rounded-pill text-light bg-dark border-none" style="border:none;">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Date filter -->
                        <div class="row bg-light pb-3">
                            <div class="col-3">
                            <div class="form-group d-flex p-1">
                                <label for="category" class="p-1">Category</label>
                                <select class="form-control shadow-none" name="category" id="category">
                                        <option value="">Select</option>
                                        <option value="Web-Application">Web</option>
                                        <option value="Mobile-Application">Mobile</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group d-flex">
                                    <label class="p-1">From</label>
                                    <input type="date" name="from_date" id="sort" class="form-control shadow-none m-1" style="border:solid lightgray 1px; background:white;" value="<?php echo (isset($fromdate))? $fromdate: null;?>">
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group d-flex">
                                    <label class="p-1">To</label>
                                    <input type="date" name="to_date" id="sort" class="form-control shadow-none m-1" style="border:solid lightgray 1px; background:white;" value="<?php echo (isset($todate))? $todate: null;?>">
                                    <div class="form-group p-1">
                                        <button type="submit" class="btn btn-outline-dark">Apply</button>
                                    </div>
                                    <div class="form-group p-1">
                                        <a href="?reset" class="btn btn-outline-dark">Reset</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Capstone Cards Section -->
                <div class="row mt-3">
            <?php if (count($capstones) == 0): ?>
                <div class="col-12 text-center">
                    <div class="h5">
                        No record found
                    </div>
                </div>
            <?php else: ?>
                <?php
                if(!empty($searchCapstone)) {
                


                  foreach($searchCapstone as $capstone): 
                        $pdf_file = $capstone['pdf_file'];
                    ?>
                             <?php
                                
                                $isFavorite = isCapstoneInFavorites($capstone['id'], $_SESSION['id']); 
                                ?>
                        <div class="col-sm-4 mb-4">
                            <div class="card bg-light h-100" onclick="openViewModal(`<?php echo htmlspecialchars($capstone['title']); ?>`, '<?php echo htmlspecialchars($capstone['author']); ?>', '<?php echo htmlspecialchars($capstone['date_published']); ?>', '<?php echo htmlspecialchars($capstone['projectAdviser']); ?>','<?php echo htmlspecialchars($capstone['category']); ?>',`<?php echo htmlspecialchars($capstone['abstract']); ?>`,event)">
                                <a href="../functions/add_favorite.php?capstone_id=<?php echo $capstone['id']; ?>&id=<?php echo $_SESSION['id']; ?>" class="btn btn-none fs-5 text-right position-absolute top-0 end-0 p-3 favorite-icon" onclick="propa(event);">
                                    <?php if ($isFavorite): ?>
                                        <!-- Solid heart icon -->
                                        <i class="bi bi-heart-fill text-danger"></i>
                                    <?php else: ?>
                                        <!-- Outline heart icon -->
                                        <i class="bi bi-heart text-dark"></i>
                                    <?php endif; ?>
                                </a>

                                <div class="card-body d-flex flex-column"> <!-- Added flex-column class to align content vertically -->
                                    <label for="title" class="font-weight-bold">Title</label>
                                    <h5 class="card-title text-truncate"><?php echo $capstone['title']; ?></h5>
                                    <label for="author" class="font-weight-bold">Author</label>
                                    <h6 class="card-subtitle mb-2 text-muted text-truncate"><?php echo $capstone['author']; ?></h6>
                                    <label for="author" class="font-weight-bold">Project Adviser</label>
                                    <h6 class="card-subtitle mb-2 text-muted text-truncate"><?php echo $capstone['projectAdviser']; ?></h6>
                                    <label for="author" class="font-weight-bold">Category</label>
                                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $capstone['category']; ?></h6>
                                    <label for="date published" class="font-weight-bold">Date published</label>
                                    <p class="card-text text-muted"><?php echo $capstone['date_published']; ?></p>
                                    
                                    <?php if (!empty($pdf_file)): ?>
                                        <a href="<?php echo $pdf_file; ?>" download class="mt-auto">Download PDF</a> <!-- Added mt-auto class to push the link to the bottom -->
                                    <?php else: ?>
                                        <div class="alert alert-warning flex-grow-1" role="alert"> <!-- Added flex-grow-1 class to make the alert occupy the remaining space -->
                                            No Available File
                                        </div>
                                    <?php endif; ?>
                                   
                                </div>
                            </div>
                        </div>
                    <?php endforeach; 
                    
                    

                } else {
                    echo "<div class='col-12 text-center'>
                            <div class='h5'>
                                No record found
                            </div>
                        </div>";
                }
                ?>
            <?php endif;?>
        </div>

                <!-- Pagination Section -->
             
            </div>
            <div class="pagination-container d-flex justify-content-center">
            <nav aria-label="navigation">
    <ul class="pagination">
        <?php
        // Previous page link
        $prevPage = $page - 1;
        if ($prevPage > 0) {
            echo "<li class='page-item'><a class='page-link text-dark bg-light' href='?page=$prevPage' aria-label='<<'><span aria-hidden='true'>&laquo;</span><span class='sr-only'></span></a></li>";
        }

        // Pagination links
        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<li class='page-item ".($page==$i?'active':'')."'><a class='page-link ".($page==$i?'text-light bg-dark outline-none':'bg-light text-dark')."' href='?page=$i'>$i</a></li>";
        }

        // Next page link
        $nextPage = $page + 1;
        if ($nextPage <= $totalPages) {
            echo "<li class='page-item'><a class='page-link text-dark bg-light' href='?page=$nextPage' aria-label='>>'><span aria-hidden='true'>&raquo;</span><span class='sr-only'></span></a></li>";
        }
        ?>
    </ul>
</nav>

                    </div>
          
        </div>
   
    </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="viewModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Capstone</h5>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <label for="view_title">Title</label>
                            <p id="view_title" class="font-weight-bold text-muted"></p>
                            <label for="view_author">Author</label>
                            <p id="view_author" class="font-weight-bold text-muted"></p>
                            <label for="view_projectAdviser">Project Adviser</label>
                            <p id="view_projectAdviser" class="font-weight-bold text-muted"></p>
                            <label for="view_category">Category</label>
                            <p id="view_category" class="text-muted"></p>
                            <label for="view_date_published">Date published</label>
                            <p id="view_date_published" class="font-weight-bold text-muted"></p>
                            <label for="view_abstract">Abstract</label>
                            <p id="view_abstract" class="text-muted"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
            </div>
       

</body>
<script>

  function propa(event){
    event.stopPropagation();
  }





function openViewModal(title, author, date_published, projectAdviser, category, abstract, event) {
    var viewModal = document.getElementById('viewModal');
    var viewTitle = viewModal.querySelector('#view_title');
    var viewAuthor = viewModal.querySelector('#view_author');
    var viewprojectAdviser = viewModal.querySelector('#view_projectAdviser');
    var viewCategory= viewModal.querySelector('#view_category');
    var viewDatePublished = viewModal.querySelector('#view_date_published');
    var viewAbstract = viewModal.querySelector('#view_abstract');

    viewTitle.textContent = title;
    viewAuthor.textContent = author;
    viewprojectAdviser.textContent = projectAdviser;
    viewCategory.textContent = category;
    viewDatePublished.textContent = date_published;
    viewAbstract.textContent = abstract;

    var bsModal = new bootstrap.Modal(viewModal);
    bsModal.show();
}
const hamBurger = document.querySelector(".toggle-btn");

hamBurger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});




</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
<style>

input.form-control {
  border: none;
  border-bottom: black solid 2px; 
  background: none; 
  border-radius: none;
}


input.form-control:focus {
  border-bottom: solid 2px; 
  outline: none;
  background: none; 
}

#sort {
  outline: none;
  background: none;
  border-radius: none;
}
.pagination-container {
    position: sticky;
    bottom: 20px;
    margin-top: auto;
    width:100%;

}

</style>
</html>


