<?php
// Inizializzazione della sessione
session_start();
// Fine: ed8c6549bwf9
// FILEPATH: /dashboard_user.php
$db = mysqli_connect('localhost:3306', 'phpmyadmin', 'ciaone11!', 'biblioteca');
// Funzionalità di logout
function logout()
{
    header("Location: login.php");
    exit();
    // gestione ed eliminazione del cookie
}

// Funzionalità di eliminazione dell'account
function deleteAccount()
{
    // Reindirizza alla pagina di login
    header("Location: login.php");

    // Eliminazione dell'account dal database
    mysqli_query($db, "DELETE FROM utenti_registrati WHERE email='" . $_SESSION['email'] . "'");
    //eliminazione nome
    mysqli_query($db, "DELETE FROM utenti_registrati WHERE nome='" . $_SESSION['nome'] . "'");
    //eliminazione cognome
    mysqli_query($db, "DELETE FROM utenti_registrati WHERE cognome='" . $_SESSION['cognome'] . "'");
    //eliminazione password
    mysqli_query($db, "DELETE FROM utenti_registrati WHERE password='" . $_SESSION['password'] . "'");
}

// Mostra i libri disponibili
function displayBooks()
{
    // Funzione per mostrare tutti i libri attualmente in prestito
    $result = mysqli_query($db, "SELECT * FROM libri WHERE disponibilita < 1");
}

// Cerca libri per nome
function searchBooksByName($name)
{
    // Funzione per cercare i libri per nome
    $result = mysqli_query($db, "SELECT * FROM libri WHERE nome='" . $name . "'");
}

// Cerca libri per autore
function searchBooksByAuthor($author)
{
    // Funzione per cercare i libri per autore
    $result = mysqli_query($db, "SELECT * FROM libri WHERE autore='" . $author . "'");
}

// Cerca libri per categoria
function searchBooksByCategory($category)
{
    // Funzione per cercare i libri per categoria
    $result = mysqli_query($db, "SELECT * FROM libri WHERE categoria='" . $category . "'");
}

// Prendi in prestito un libro
function borrowBook($bookId)
{
    // Funzione per prendere in prestito un libro
    $result = mysqli_query($db, "SELECT * FROM libri WHERE id='" . $bookId . "'");
    $row = mysqli_fetch_array($result);
    $newAvailability = $row['disponibilita'] - 1;
    mysqli_query($db, "UPDATE libri SET disponibilita='" . $newAvailability . "' WHERE id='" . $bookId . "'");
}

// Restituisci un libro e lascia una recensione
function returnBookAndReview($bookId, $review)
{
    // Funzione per restituire un libro e lasciare una recensione
    $result = mysqli_query($db, "SELECT * FROM libri WHERE id='" . $bookId . "'");
    $row = mysqli_fetch_array($result);
    $newAvailability = $row['disponibilita'] + 1;
    mysqli_query($db, "UPDATE libri SET disponibilita='" . $newAvailability . "' WHERE id='" . $bookId . "'");
    mysqli_query($db, "INSERT INTO recensioni (id_libro, recensione) VALUES ('" . $bookId . "', '" . $review . "')");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
<!-- Pulsante di logout -->
<form action="dashboard_user.php" method="post">
    <input type="submit" name="logout" value="Logout">
</form>

<!-- Pulsante di eliminazione dell'account -->
<form action="dashboard_user.php" method="post">
    <input type="submit" name="deleteAccount" value="Elimina account">
</form>

<!-- Pulsante per mostrare i libri disponibili -->
<form action="dashboard_user.php" method="post">
    <input type="submit" name="displayBooks" value="Mostra libri disponibili">
</form>

<!-- Pulsante per cercare libri per nome -->
<form action="dashboard_user.php" method="post">
    <input type="text" name="searchByName" placeholder="Inserisci il nome del libro">
    <input type="submit" name="searchBooksByName" value="Cerca libri per nome">
</form>

<!-- Pulsante per cercare libri per autore -->
<form action="dashboard_user.php" method="post">
    <input type="text" name="searchByAuthor" placeholder="Inserisci il nome dell'autore">
    <input type="submit" name="searchBooksByAuthor" value="Cerca libri per autore">
</form>

<!-- Pulsante per cercare libri per categoria -->
<form action="dashboard_user.php" method="post">
    <input type="text" name="searchByCategory" placeholder="Inserisci la categoria">
    <input type="submit" name="searchBooksByCategory" value="Cerca libri per categoria">
</form>

<!-- Pulsante per prendere in prestito un libro -->
<form action="dashboard_user.php" method="post">
    <input type="text" name="bookId" placeholder="Inserisci l'ID del libro">
    <input type="submit" name="borrowBook" value="Prendi in prestito un libro">
</form>

<!-- Pulsante per restituire un libro e lasciare una recensione -->
<form action="dashboard_user.php" method="post">
    <input type="text" name="bookId" placeholder="Inserisci l'ID del libro">
    <input type="text" name="review" placeholder="Inserisci una recensione">
    <input type="submit" name="returnBookAndReview" value="Restituisci un libro e lascia una recensione">
</form>

<!-- Search books by category button -->
<form action="dashboard_user.php" method="post">
    <input type="text" name="searchByCategory" placeholder="Enter category">
    <input type="submit" name="searchBooksByCategory" value="Search books by category">
</form>

<!-- Borrow a book button -->
<form action="dashboard_user.php" method="post">
    <input type="text" name="bookId" placeholder="Enter book ID">
    <input type="submit" name="borrowBook" value="Borrow a book">
</form>

<!-- Return a book and leave a review button -->
<form action="dashboard_user.php" method="post">
    <input type="text" name="bookId" placeholder="Enter book ID">
    <input type="text" name="review" placeholder="Enter review">
    <input type="submit" name="returnBookAndReview" value="Return a book and leave a review">
</form>
</body>
</html>

