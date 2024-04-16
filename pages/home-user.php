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

            <div class="col-lg-11" style="overflow-y:auto; height: 100%;">
                <div class="scrollable-right">
                    <div class="sticky-top" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                        <form method="post">
                            <div class="row bg-light">
                                <div class="col-sm-12 text-center">
                                    <div style="display: inline-block; width:75%;">
                                        <div class="input-group m-3">
                                            <input type="text" class="form-control rounded-pill" id="capSearch"
                                                placeholder="Search" name="forSearch"
                                                value="<?php echo (isset($searchVal)) ? $searchVal : null; ?>"
                                                oninput="getSuggestions(this.value)">
                                            <button type="submit" name="capSearch" value="SEARCH"
                                                class="btn btn-primary rounded-pill text-light bg-dark border-none"
                                                style="border:none;">
                                                <i class="bi bi-search"></i>
                                            </button>
                                        </div>
                                        <div id="suggestionBox" class="border rounded bg-light p-2"
                                            style="display:none;"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="row bg-light">
                                <div class="col-sm-6">
                                    <div class="form-group d-flex">
                                        <label class="mr-2">From</label>
                                        <input type="date" name="from_date" class="form-control"
                                            value="<?php echo (isset($fromdate)) ? $fromdate : null; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group d-flex">
                                        <label class="mr-2">To</label>
                                        <input type="date" name="to_date" class="form-control"
                                            value="<?php echo (isset($todate)) ? $todate : null; ?>">
                                        <div class="form-group ml-3">
                                            <button type="submit" class="btn btn-dark">Apply</button>
                                        </div>
                                    </div>
                                </div>
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
                                    if (!empty($searchCapstone)) {
                                        foreach ($searchCapstone as $capstone):
                                            $pdf_file = $capstone['pdf_file'];
                                            ?>
                                            <div class="col-sm-4 mb-4">
                                                <div class="card bg-light h-100"
                                                    onclick="openViewModal('<?php echo $capstone['title']; ?>', '<?php echo $capstone['author']; ?>', '<?php echo $capstone['date_published']; ?>', '<?php echo $capstone['abstract']; ?>',event)">
                                                    <!-- Added h-100 class to ensure all cards have the same height -->
                                                    <div class="card-body d-flex flex-column">
                                                        <!-- Added flex-column class to align content vertically -->
                                                        <label for="title" class="font-weight-bold">Title</label>
                                                        <h5 class="card-title text-truncate"><?php echo $capstone['title']; ?></h5>
                                                        <label for="author" class="font-weight-bold">Author</label>
                                                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $capstone['author']; ?>
                                                        </h6>
                                                        <label for="date published" class="font-weight-bold">Date published</label>
                                                        <p class="card-text"><?php echo $capstone['date_published']; ?></p>
                                                        <label for="abstract" class="font-weight-bold">Abstract</label>
                                                        <p class="card-text text-truncate"><?php echo $capstone['abstract']; ?></p>
                                                        <?php if (!empty($pdf_file)): ?>
                                                            <a href="<?php echo $pdf_file; ?>" download class="mt-auto">Download PDF</a>
                                                            <!-- Added mt-auto class to push the link to the bottom -->
                                                        <?php else: ?>
                                                            <div class="alert alert-warning flex-grow-1" role="alert">
                                                                <!-- Added flex-grow-1 class to make the alert occupy the remaining space -->
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
                                <?php endif; ?>
                            </div>
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

    function propa(event) {
        event.stopPropagation();
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

    function getSuggestions(input) {
        if (input.length === 0) {
            document.getElementById("suggestionBox").style.display = "none";
            return;
        }
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                var suggestions = JSON.parse(this.responseText);
                var suggestionBox = document.getElementById("suggestionBox");
                suggestionBox.innerHTML = "";
                if (suggestions.length > 0) {
                    suggestionBox.style.display = "block";
                    suggestions.forEach(function (suggestion) {
                        var suggestionElement = document.createElement("div");
                        suggestionElement.textContent = suggestion.title;
                        suggestionElement.classList.add("suggestion");
                        suggestionElement.addEventListener("click", function () {
                            setSelectedSuggestion(suggestion.title);
                        });
                        suggestionBox.appendChild(suggestionElement);
                    });
                } else {
                    suggestionBox.style.display = "none";
                }
            }
        };
        xhr.open("GET", "../functions/getSuggestions.php?input=" + input, true);
        xhr.send();
    }
    function setSelectedSuggestion(title) {
        var cards = document.querySelectorAll('.card');
        cards.forEach(function (card) {
            if (card.querySelector('.card-title').textContent === title) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>
<style>
    .card:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transform: translateY(-5px);
        transition: all 0.4s ease;
    }

    .card {
        border-radius: 20px;
    }

    .btn {
        border-radius: 10px;
    }

    .col-sm-3 {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
</style>

</html>