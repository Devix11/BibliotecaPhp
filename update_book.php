<?php
// update_book.php
$db = mysqli_connect('localhost', 'phpmyadmin', 'ciaone11', 'biblioteca');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bookId = $_POST['book_id'];
    $query = "SELECT quantita FROM libri WHERE id = '$bookId'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $currentQuantity = $row['quantita'];

    if (isset($_POST['increment'])) {
        $newQuantity = $currentQuantity + 1;
    } elseif (isset($_POST['decrement']) && $currentQuantity > 0) {
        $newQuantity = $currentQuantity - 1;
    } else {

    }

    $updateQuery = "UPDATE libri SET quantita = '$newQuantity' WHERE id = '$bookId'";
    mysqli_query($db, $updateQuery);

    header('Location: dashboard_admin.php'); 
    exit();
}
?>
