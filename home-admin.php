<?php
include('dbconn.php');
include('get-admin.php');
include('add-admin.php');
include('edit-admin.php');
include('delete-admin.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body>

    <div class="container-fluid">
        <div class="row" style="height:100vh;">
            <div class="col-sm-4" style="overflow-y:hidden;">Add here <!-- LEFT PART-->
                <h1 class="mb-4">Submit New Capstone</h1>
                <form method="POST">
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
                    <button type="submit" class="btn btn-dark" name="submit" style="float:right;">Add Capstone</button>
                </form>
            </div>
            <div class="col-sm-8" style="overflow-y:auto;">Browse here <!-- EDIT VIEW PART -->

            <div class="search-container">
    <form action="search_view.php" method="post">
        <input type="text" class="search-box" name="query" placeholder="Enter your search title">
        <button type="submit" class="search-button">Search</button>
    </form>
</div>

                <div class="row mt-5">
                    <?php foreach($capstones as $capstone): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card" onclick="openViewModal('<?php echo $capstone['title']; ?>', '<?php echo $capstone['author']; ?>', '<?php echo $capstone['date_published']; ?>', '<?php echo $capstone['abstract']; ?>',event)" style="width: 100%; height: 100%;" >
                                <div class="card-body">
                                    <label for="title" class="font-weight-bold">Title</label>
                                    <h5 class="card-title"><?php echo $capstone['title']; ?></h5>
                                    <label for="author" class="font-weight-bold">Author</label>
                                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $capstone['author']; ?></h6>
                                    <label for="date published" class="font-weight-bold">Date published</label>
                                    <p class="card-text"><?php echo $capstone['date_published']; ?></p>
                                    <label for="abstract" class="font-weight-bold">Abstract</label>
                                    <p class="card-text text-truncate"><?php echo $capstone['abstract']; ?></p>
                                    <div class="mt-5" style="position: absolute; bottom: 2px; right: 2px;">
                                    <button  type="button" class="btn btn-dark edit-btn" onclick="openEditModal('<?php echo $capstone['id']; ?>', '<?php echo $capstone['title']; ?>', '<?php echo $capstone['author']; ?>', '<?php echo $capstone['date_published']; ?>', '<?php echo $capstone['abstract']; ?>')">
                                        Edit
                                    </button>

                                      <a href="?delete=<?php echo $capstone['id']; ?>" value="delete" class="btn btn-dark">Delete</a>
                                  </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
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
            <form id="editForm" method="POST" action="edit.php"> 
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




    function openViewModal(title, author, date_published, abstract) {
  
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
</html>
