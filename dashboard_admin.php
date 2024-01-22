<?php
// FILEPATH: /Users/dade/Documents/GitHub/BibliotecaPhp/dashboard_admin.php

// Controlla se l'utente è loggato e ha privilegi di amministratore
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: login.php"); // Reindirizza alla pagina di login se non loggato come amministratore
    exit;
}

// Includi i file necessari e inizializza le variabili
// DATABASe Mysql
$db = mysqli_connect('localhost', 'phpmyadmin', 'ciaone11', 'biblioteca');
$database = new Database();
$books = $database->getBooks();
$users = $database->getUsers();

// Gestisci le sottomissioni del form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['book_id']) && isset($_POST['book_title']) && isset($_POST['book_author'])) {
        // Aggiorna i dettagli del libro
        $bookId = $_POST['book_id'];
        $bookTitle = $_POST['book_title'];
        $bookAuthor = $_POST['book_author'];
        $database->updateBook($bookId, $bookTitle, $bookAuthor);
    } elseif (isset($_POST['user_id']) && isset($_POST['user_name']) && isset($_POST['user_email'])) {
        // Aggiorna i dettagli dell'utente
        $userId = $_POST['user_id'];
        $userName = $_POST['user_name'];
        $userEmail = $_POST['user_email'];
        $database->updateUser($userId, $userName, $userEmail);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pannello di controllo amministratore</title>
</head>
<body>
    <h1>Benvenuto nel Pannello di Controllo Amministratore</h1>

    <h2>Libri</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Titolo</th>
            <th>Autore</th>
            <th>Azione</th>
        </tr>
        <?php foreach ($books as $book) { ?>
            <tr>
                <form method="POST" action="">
                    <td><?php echo $book['id']; ?></td>
                    <td><input type="text" name="book_title" value="<?php echo $book['title']; ?>"></td>
                    <td><input type="text" name="book_author" value="<?php echo $book['author']; ?>"></td>
                    <td>
                        <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                        <input type="submit" value="Aggiorna">
                    </td>
                </form>
            </tr>
        <?php } ?>
    </table>

    <h2>Utenti</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Azione</th>
        </tr>
        <?php foreach ($users as $user) { ?>
            <tr>
                <form method="POST" action="">
                    <td><?php echo $user['id']; ?></td>
                    <td><input type="text" name="user_name" value="<?php echo $user['name']; ?>"></td>
                    <td><input type="text" name="user_email" value="<?php echo $user['email']; ?>"></td>
                    <td>
                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                        <input type="submit" value="Aggiorna">
                    </td>
                </form>
            </tr>
        <?php } ?>
    </table>

    <?php
        include_once("./style/fonts.php");
    ?>
</body>
</html>
