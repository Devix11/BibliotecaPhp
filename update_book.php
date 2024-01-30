<?php
// update_book.php
$db = mysqli_connect('localhost', 'phpmyadmin', 'ciaone11', 'biblioteca');


//display error
ini_set('display_errors', 1);

//gestione aggiornamento di tutti i campi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bookId = $_POST['book_id'];
    $query = "SELECT * FROM libri WHERE id = '$bookId'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $newTitle = $row['titolo'];
    $newAuthor = $row['autore'];
    $newIsbn = $row['isbn'];
    $newGenre = $row['genere'];
    $newYear = $row['annoPubblicazione'];
    $newQuantity = $row['quantita'];
    $newDescription = $row['descrizione'];


    $newTitle = strip_tags(html_entities($_POST['newTitle']));
    $newAuthor = strip_tags(html_entities($_POST['newAuthor']));
    $newIsbn = strip_tags(html_entities($_POST['newIsbn']));
    $newGenre = strip_tags(html_entities($_POST['newGenre']));
    $newYear = strip_tags(html_entities($_POST['newYear']));
    $newQuantity = strip_tags(html_entities($_POST['newQuantity']));
    $newDescription = strip_tags(html_entities($_POST['newDescription']));

    if ($newYear>time()){
        
        header('Location: dashboard_admin.php');
        exit();
    }

    
    $updateQuery = "UPDATE libri SET titolo = '$newTitle', autore = '$newAuthor', isbn = '$newIsbn', genere = '$newGenre', annoPubblicazione = '$newYear', quantita = '$newQuantity', descrizione = '$newDescription' WHERE id = '$bookId'";
    mysqli_real_escapestring($db, $updateQuery);

    header('Location: dashboard_admin.php');
    exit();
}

?>
