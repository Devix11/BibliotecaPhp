<?php
// update_book.php
$db = mysqli_connect('localhost', 'phpmyadmin', 'ciaone11', 'biblioteca');


//display error
ini_set('display_errors', 1);

//gestione aggiornamento titolo
/*
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bookId = $_POST['book_id'];
    $query = "SELECT titolo FROM libri WHERE id = '$bookId'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $currentTitle = $row['titolo'];

    if (isset($_POST['updateTitle'])) {
        $newTitle = $_POST['newTitle'];
    } else {
        // Handle error or default value
    }

    $updateQuery = "UPDATE libri SET titolo = '$newTitle' WHERE id = '$bookId'";
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


//gestione aggiornamento isbn
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $bookId = $_POST['book_id'];
    $query = "SELECT isbn FROM libri WHERE id = '$bookId'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $currentIsbn = $row['isbn'];

    if (isset($_POST['updateIsbn'])) {
        $newIsbn = $_POST['newIsbn'];
    } else {

    }

    $updateQuery = "UPDATE libri SET isbn = '$newIsbns' WHERE id = '$bookId'";
    mysqli_query($db, $updateQuery);

    header('Location: dashboard_admin.php'); 
    exit();
}

//gestione aggiornamento genere
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bookId = $_POST['book_id'];
    $query = "SELECT genere FROM libri WHERE id = '$bookId'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $currentGenre = $row['genere'];

    if (isset($_POST['updateGenre'])) {
        $newGenre = $_POST['newGenre'];
    } else {

    }

    $updateQuery = "UPDATE libri SET genere = '$newGenre' WHERE id = '$bookId'";
    mysqli_query($db, $updateQuery);

    header('Location: dashboard_admin.php'); 
    exit();
}


//gestione aggiornamento anno pubblicazione
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bookId = $_POST['book_id'];
    $query = "SELECT anno_pubblicazione FROM libri WHERE id = '$bookId'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $currentYear = $row['anno_pubblicazione'];

    if (isset($_POST['updateYear'])) {
        $newYear = $_POST['newYear'];
    } else {

    }

    $updateQuery = "UPDATE libri SET anno_pubblicazione = '$newYear' WHERE id = '$bookId'";
    mysqli_query($db, $updateQuery);

    header('Location: dashboard_admin.php'); 
    exit();
}

//gestione aggiornamento disponibilità tramite textbox
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bookId = $_POST['book_id'];
    $query = "SELECT disponibilita FROM libri WHERE id = '$bookId'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $currentAvailability = $row['disponibilita'];

    if (isset($_POST['updateAvailability'])) {
        $newAvailability = $_POST['newAvailability'];
    } else {

    }

    $updateQuery = "UPDATE libri SET disponibilita = '$newAvailability' WHERE id = '$bookId'";
    mysqli_query($db, $updateQuery);

    header('Location: dashboard_admin.php'); 
    exit();
}

//gestione aggiornamento disponibilità tramite pulsanti
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
}*/

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

    $updateQuery = "UPDATE libri SET titolo = '$newTitle', autore = '$newAuthor', isbn = '$newIsbn', genere = '$newGenre', annoPubblicazione = '$newYear', quantita = '$newQuantity', descrizione = '$newDescription' WHERE id = '$bookId'";
    var_dump($updateQuery);
    mysqli_query($db, $updateQuery);

    //header('Location: dashboard_admin.php');
    exit();
}

?>
