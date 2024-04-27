<?php
include('../functions/connection/dbconn.php');
include('../functions/admin/get-admin.php');
include('../functions/admin/add-admin.php');
include('../functions/admin/edit-admin.php');
include('../functions/admin/delete-admin.php');
include('../functions/type.php');
include('../functions/reset.php');
?>

<?php
session_start();

if(!isset($_SESSION["id"])){
	header("location: ../pages/login.php"); 
	exit();
}

if($_SESSION['accountType'] != 'admin'){
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
            <a href="../pages/home-admin.php" class="sidebar-link">
                <i class="bi bi-house-door-fill"></i>
                <span>Home</span>
            </a>
        </li>
       
        <li class="sidebar-item">
            <a href="../pages/profile-admin.php" class="sidebar-link">
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

<div class="container-fluid" style="overflow:hidden; height: 100%;">
    <div class="row" style="height:100vh;">
        <div class="col-sm-3 bg-secondary text-light">
            <div class="middle mt-3" style="overflow:hidden; height: 100%;">
            <form method="POST" enctype="multipart/form-data">
                <div class="h3 m-3 p-2 text-center">Add New Capstone</div>
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="edit_id" id="edit_id" value="">
                        <div class="form-group mt">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control shadow-none text-white" id="title" name="title" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="author">Author:</label>
                            <input type="text" class="form-control shadow-none text-white" id="author" name="author" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="date_pub">Date Published:</label>
                            <input type="date" class="form-control shadow-none text-white" id="date_pub" name="date_pub" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="abstract">Abstract:</label>
                            <textarea class="form-control shadow-none" id="abstract" name="abstract" rows="4" required></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label for="pdf_file">PDF File:</label>
                            <input type="file" class="form-control shadow-none text-white bg-secondary border-0 text-light" id="pdf_file" name="pdf_file" accept=".pdf" required>
                        </div>
                        <button type="submit" class="btn btn-dark m-1" name="submit" style="float:right;">Add Capstone</button>
                    </form>
            </div>
        </div>
        <div class="col-sm-9" style="overflow-y:auto; height: 100%;">
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
                            <div class="col-sm-6">
                                <div class="form-group d-flex">
                                    <label class="mr-2 p-1">From</label>
                                    <input type="date" name="from_date" id="sort" class="form-control shadow-none m-1" value="<?php echo (isset($fromdate))? $fromdate: null;?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group d-flex">
                                    <label class="mr-2 p-1">To</label>
                                    <input type="date" name="to_date" id="sort" class="form-control shadow-none m-1" value="<?php echo (isset($todate))? $todate: null;?>">
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
                    <?php if (count($searchCapstone) == 0): ?>
                        <div class="col-12 text-center">
                            <div class="h5">
                                No record found
                            </div>
                        </div>
                    <?php else: ?>
                        <?php foreach($searchCapstone as $capstone): 
                            $pdf_file = $capstone['pdf_file'];?>
                            
                            <div class="col-sm-4 mb-4">
                                <div class="card bg-light h-100" onclick="openViewModal(`<?php echo htmlspecialchars($capstone['title']); ?>`, '<?php echo htmlspecialchars($capstone['author']); ?>', '<?php echo htmlspecialchars($capstone['date_published']); ?>', `<?php echo htmlspecialchars($capstone['abstract']); ?>`)"> <!-- Added h-100 class to ensure all cards have the same height -->
                                    <div class="card-body d-flex flex-column"> <!-- Added flex-column class to align content vertically -->
                                        <label for="title" class="font-weight-bold">Title</label>
                                        <h5 class="card-title text-truncate"><?php echo $capstone['title']; ?></h5>
                                        <label for="author" class="font-weight-bold">Author</label>
                                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $capstone['author']; ?></h6>
                                        <label for="date published" class="font-weight-bold">Date published</label>
                                        <p class="card-text"><?php echo $capstone['date_published']; ?></p>
                                        <label for="abstract" class="font-weight-bold">Abstract</label>
                                        <p class="card-text text-truncate"><?php echo $capstone['abstract']; ?></p>
                                        
                                    <?php if (!empty($pdf_file)): ?>
                                        <a href="<?php echo $pdf_file; ?>" download class="mt-auto" onclick="propa(event)">Download PDF</a> <!-- Added mt-auto class to push the link to the bottom -->
                                    <?php else: ?>
                                        <div class="alert alert-warning flex-grow-1" role="alert"> <!-- Added flex-grow-1 class to make the alert occupy the remaining space -->
                                            No Available File
                                        </div>
                                    <?php endif; ?>
                                        <div class="mt-3 d-flex justify-content-end">
                                            <!-- Edit button -->
                                            <button type="button" class="btn btn-none edit-btn" onclick="openEditModal('<?php echo $capstone['id']; ?>', `<?php echo htmlspecialchars($capstone['title']); ?>`, '<?php echo htmlspecialchars($capstone['author']); ?>', '<?php echo htmlspecialchars($capstone['date_published']); ?>', `<?php echo htmlspecialchars($capstone['abstract']); ?>`)">Edit</button>
                                            <!-- Delete button -->
                                            <a href="?delete=<?php echo $capstone['id']; ?>" class="btn btn-none" onclick="propa(event);">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
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
    
<!-- Modal for Editing -->
<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Capstone</h5>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>
            <form id="editForm" method="POST" action="../functions/admin/edit-admin.php"> 
                <div class="modal-body">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="edit_id" id="edit_id_modal" value="">
                    <div class="form-group">
                        <label for="title_modal">Title:</label>
                        <input type="text" class="form-control shadow-none text-dark" id="title_modal" name="title" value="<?php echo isset($capstone['title']) ? $capstone['title'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="author_modal">Author:</label>
                        <input type="text" class="form-control shadow-none text-dark" id="author_modal" name="author" value="<?php echo isset($capstone['author']) ? $capstone['author'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="date_pub_modal">Date Published:</label>
                        <input type="date" class="form-control shadow-none text-dark" id="date_pub_modal" name="date_pub" value="<?php echo isset($capstone['date_published']) ? $capstone['date_published'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="abstract_modal">Abstract:</label>
                        <textarea class="form-control shadow-none text-dark" id="abstract_modal" name="abstract" rows="4" required><?php echo isset($capstone['abstract']) ? $capstone['abstract'] : ''; ?></textarea>
                    </div>
                </div>
                                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="submit">Save Changes</button>
                </div>


            </form>
        </div>
    </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="viewModal">
    <div class="modal-dialog modal-lg">
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
                            <p id="view_title" class="font-weight-bold"></p>
                            <label for="view_author">Author</label>
                            <p id="view_author" class="font-weight-bold"></p>
                            <label for="view_date_published">Date published</label>
                            <p id="view_date_published" class="font-weight-bold"></p>
                            <label for="view_abstract">Abstract</label>
                            <p id="view_abstract"></p>
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script>

  function propa(event){
    event.stopPropagation();
  }

  function openEditModal(editId, title, author, datePublished, abstract) {
    propa(event);
    var editModal = document.getElementById('editModal');
    var titleInput = editModal.querySelector('#title_modal');
    var authorInput = editModal.querySelector('#author_modal');
    var datePubInput = editModal.querySelector('#date_pub_modal');
    var abstractInput = editModal.querySelector('#abstract_modal');
    var editIdInput = editModal.querySelector('#edit_id_modal');

    titleInput.value = title;
    authorInput.value = author;
    datePubInput.value = datePublished;
    abstractInput.value = abstract;
    editIdInput.value = editId;

    var bsModal = new bootstrap.Modal(editModal);
    bsModal.show();
}




function openViewModal(title, author, date_published, abstract) {
    propa(event);
    var viewModal = document.getElementById('viewModal');
    var viewTitle = viewModal.querySelector('#view_title');
    var viewAuthor = viewModal.querySelector('#view_author');
    var viewDatePublished = viewModal.querySelector('#view_date_published');
    var viewAbstract = viewModal.querySelector('#view_abstract');

    viewTitle.textContent = title;
    viewAuthor.textContent = author;
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

<style>


input.form-control {
  border: none;
  border-bottom: black solid 2px; 
  background: none; 
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


