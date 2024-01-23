<?php
// update_book.php
$db = mysqli_connect('localhost', 'phpmyadmin', 'ciaone11', 'biblioteca');

//display error
ini_set('display_errors', 1);


//gestione aggiornamento quantità
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

//gestione aggiornamento descrizione
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bookId = $_POST['book_id'];
    $query = "SELECT descrizione FROM libri WHERE id = '$bookId'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $currentDescription = $row['descrizione'];

    if (isset($_POST['updateDescription'])) {
        $newDescription = $_POST['newDescription'];
    } else {

    }

    $updateQuery = "UPDATE libri SET descrizione = '$newDescription' WHERE id = '$bookId'";
    mysqli_query($db, $updateQuery);

    header('Location: dashboard_admin.php'); 
    exit();
}

//gestione aggiornamento autore
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bookId = $_POST['book_id'];
    $query = "SELECT autore FROM libri WHERE id = '$bookId'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $currentAuthor = $row['autore'];

    if (isset($_POST['updateAuthor'])) {
        $newAuthor = $_POST['newAuthor'];
    } else {

    }

    $updateQuery = "UPDATE libri SET autore = '$newAuthor' WHERE id = '$bookId'";
    mysqli_query($db, $updateQuery);

    header('Location: dashboard_admin.php'); 
    exit();
}

//gestione aggiornamento titolo
?>
