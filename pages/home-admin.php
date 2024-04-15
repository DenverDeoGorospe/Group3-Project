<?php
include('../functions/connection/dbconn.php');
include('../functions/admin/get-admin.php');
include('../functions/admin/add-admin.php');
include('../functions/admin/edit-admin.php');
include('../functions/admin/delete-admin.php');
include('../functions/type.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body>

    <div class="container-fluid">
        <div class="row" style="height:100vh;">
        <div class="col-sm-1 bg-dark" >
        <div class="left d-flex flex-column justify-content-between align-items-center" style="overflow:hidden; height: 100%;">
    <ul class="nav nav-pills flex-column mt-3 text-center">
        <li class="nav-item m-auto pt-3">
            <a href="home-admin.php" class="nav-link" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Home">
                <div class="d-flex align-items-center">
                    <i class="bi bi-house-fill h3 text-light"></i>
                    <label class="text-light ml-2">Home</label>
                </div>
            </a>
        </li>
        <li class="nav-item m-auto pt-3">
            <a href="#" class="nav-link" title="" data-bs-toggle="tooltip" data-bs-placement="right">
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
        <div class="col-sm-3 bg-secondary text-light">
                <div class="middle" style="overflow:hidden; height: 100%;">
                    <h3 class="mb-4 text-center">Submit Capstone <i class="fas fa-solid fa-star"></i></h3>
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="edit_id" id="edit_id" value="">
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="author">Author:</label>
                            <input type="text" class="form-control" id="author" name="author" required>
                        </div>
                        <div class="form-group">
                            <label for="date_pub">Date Published:</label>
                            <input type="date" class="form-control" id="date_pub" name="date_pub" required>
                        </div>
                        <div class="form-group">
                            <label for="abstract">Abstract:</label>
                            <textarea class="form-control" id="abstract" name="abstract" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="pdf_file">PDF File:</label>
                            <input type="file" class="form-control bg-secondary border-0 text-light" id="pdf_file" name="pdf_file" accept=".pdf" required>
                        </div>
                        <button type="submit" class="btn btn-dark" name="submit" style="float:right;">Add Capstone</button>
                    </form>
                </div>
            </div>

            
            <div class="col-sm-8" style="overflow-y:auto; height: 100%;">
    <div class="scrollable-right">
        <div class="sticky-top"  style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            <form method="post"> 
                <div class="row bg-light">
                    <div class="col-sm-12 text-center">
                        <div style="display: inline-block; width:75%;">
                            <div class="input-group m-3">
                                <input type="text" class="form-control rounded-pill" id="capSearch" placeholder="Search" name="forSearch" value="<?php echo (isset($searchVal))? $searchVal: null;?>">
                                <button type="submit" name="capSearch" value="SEARCH" class="btn btn-primary rounded-pill text-light bg-dark border-none" style="border:none;">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Date filter -->
                <div class="row bg-light">
                    <div class="col-sm-6">
                        <div class="form-group d-flex">
                            <label class="mr-2">From</label>
                            <input type="date" name="from_date" class="form-control" value="<?php echo (isset($fromdate))? $fromdate: null;?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group d-flex">
                            <label class="mr-2">To</label>
                            <input type="date" name="to_date" class="form-control" value="<?php echo (isset($todate))? $todate: null;?>">
                            <div class="form-group ml-3">
                                <button type="submit" class="btn btn-dark">Apply</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

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
                        <div class="col-sm-4 mb-4">
                            <div class="card bg-light h-100" onclick="openViewModal('<?php echo $capstone['title']; ?>', '<?php echo $capstone['author']; ?>', '<?php echo $capstone['date_published']; ?>', '<?php echo $capstone['abstract']; ?>',event)"> <!-- Added h-100 class to ensure all cards have the same height -->
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
                                        <a href="<?php echo $pdf_file; ?>" download class="mt-auto">Download PDF</a> <!-- Added mt-auto class to push the link to the bottom -->
                                    <?php else: ?>
                                        <div class="alert alert-warning flex-grow-1" role="alert"> <!-- Added flex-grow-1 class to make the alert occupy the remaining space -->
                                            No Available File
                                        </div>
                                    <?php endif; ?>
                                    <div class="mt-3 d-flex justify-content-end">
                                        <!-- Edit button -->
                                        <button type="button" class="btn btn-dark edit-btn mr-2" onclick="openEditModal('<?php echo $capstone['id']; ?>', '<?php echo $capstone['title']; ?>', '<?php echo $capstone['author']; ?>', '<?php echo $capstone['date_published']; ?>', '<?php echo $capstone['abstract']; ?>')">Edit</button>
                                        <!-- Delete button -->
                                        <a href="?delete=<?php echo $capstone['id']; ?>" class="btn btn-dark" onclick="propa(event);">Delete</a>
                                    </div>
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
    </div>
</div>

        </div>
    </div>
<!-- Modal for Editing -->
<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-dialog-centered">
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
                        <input type="text" class="form-control" id="title_modal" name="title" value="<?php echo isset($capstone['title']) ? $capstone['title'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="author_modal">Author:</label>
                        <input type="text" class="form-control" id="author_modal" name="author" value="<?php echo isset($capstone['author']) ? $capstone['author'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="date_pub_modal">Date Published:</label>
                        <input type="date" class="form-control" id="date_pub_modal" name="date_pub" value="<?php echo isset($capstone['date_published']) ? $capstone['date_published'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="abstract_modal">Abstract:</label>
                        <textarea class="form-control" id="abstract_modal" name="abstract" rows="4" required><?php echo isset($capstone['abstract']) ? $capstone['abstract'] : ''; ?></textarea>
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


</body>
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




function openViewModal(title, author, date_published, abstract, event) {
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


</script>
<style>

    .card:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transform: translateY(-5px);
        transition: all 0.4s ease;
    }
    .card{
        border-radius: 20px;
    }
    .btn{
        border-radius:10px;
    }
    .col-sm-3{
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
</style>
</html>
