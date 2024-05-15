<?php
include('../functions/connection/dbconn.php');

$searchVal = $_POST['forSearchFave'] ?? null;
$searchSort = $_GET['sort_alphabet'] ?? null;

function fetchFavorites($conn, $searchVal = null, $searchSort = null) {
    // Default SQL query
    $sql = "SELECT c.title as title, c.author as author, c.date_published as date_published, c.projectAdviser as projectAdviser, c.category as category, c.abstract as abstract, f.id, c.pdf_file as pdf_file 
            FROM tbl_favorite as f
            INNER JOIN tblcapstone as c ON c.id = f.capstoneID
            INNER JOIN tbl_register as r ON r.id = f.userID";

    // Adding search condition if search value is provided
    if ($searchVal !== null) {
        $sql .= " WHERE c.title LIKE '%$searchVal%'";
    }

    // Adding sorting condition if sort option is provided
    if ($searchSort !== null) {
        if ($searchSort === "a-z") {
            $sql .= " ORDER BY c.title ASC";
        } elseif ($searchSort === "z-a") {
            $sql .= " ORDER BY c.title DESC";
        }
    }

    // Prepare and execute the statement
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $favorite = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $favorite;
}

$favoriteResults = fetchFavorites($conn, $searchVal, $searchSort);

// Pagination logic
$recordsPerPage = 15;
$totalRecords = count($favoriteResults);
$totalPages = ceil($totalRecords / $recordsPerPage);
$page = isset($_GET['page']) && $_GET['page'] <= $totalPages ? $_GET['page'] : 1;
$offset = ($page - 1) * $recordsPerPage;
$favorite = array_slice($favoriteResults, $offset, $recordsPerPage);
?>


<!-- Displaying the fetched favorites -->
<?php foreach ($favorite as $item): ?>
    <!-- Display each favorite item here -->
<?php endforeach; ?>

<!-- Pagination links -->
<div class="pagination">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?page=<?php $i; ?>"><?php $i; ?></a>
    <?php endfor; ?>
</div>
