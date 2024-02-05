<?php
// FILEPATH: /Users/dade/Documents/GitHub/BibliotecaPhp/dashboard_admin.php

// Controlla se l'utente è loggato e ha privilegi di amministratore
//session_start();
/*if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: login.php"); // Reindirizza alla pagina di login se non loggato come amministratore
    exit;
}*/

//metodi per la connessione al database e per la query dentro la classe Database
//display error
ini_set('display_errors', 1);

class Database {

    private $connection;

    public function __construct() {
        $this->connection = mysqli_connect('localhost', 'phpmyadmin', 'ciaone11', 'biblioteca');
    }

    public function getBooks() {
        $query = "SELECT * FROM libri";
        $result = mysqli_query($this->connection, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getUsers() {
        $query = "SELECT * FROM utenti_registrati";
        $result = mysqli_query($this->connection, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function updateBook($bookId, $bookTitle, $bookAuthor) {
        $query = "UPDATE libri SET titolo = '$bookTitle', autore = '$bookAuthor' WHERE id = $bookId";
        mysqli_query($this->connection, $query);
    }

    public function updateUser($userId, $userName, $userEmail) {
        $query = "UPDATE utenti_registrati SET nome = '$userName', email = '$userEmail' WHERE id = $userId";
        mysqli_query($this->connection, $query);
    }
}

// Includi i file necessari e inizializza le variabili
// DATABASe Mysql
$database = mysqli_connect('localhost', 'phpmyadmin', 'ciaone11', 'biblioteca');
$database = new Database();
//query per la lista dei libri
$books = $database->getBooks();
//query per la lista degli utenti
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
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
        <title>Pannello di controllo amministratore</title>
    </head>
    <body>
        <h1>Benvenuto nel Pannello di Controllo Amministratore</h1>
        <h2>Libri</h2>
        <table class="flex items-center border-b border-teal-500 py-2">
    <tr>
        <th>ID</th>
        <th>Titolo</th>
        <th>Autore</th>
        <th>ISBN</th>
        <th>Genere</th>
        <th>Anno Pubblicazione</th>
        <th>Disponibilità</th>
        <th>Descrizione</th>
        <th>Azione</th>
    </tr>
    <?php foreach ($books as $book) { ?>
        <tr>
            <table class="table-auto flex items-center border-b border-teal-500 py-2">
            <form method="POST" action="update_book.php" class="w-full max-w-sm">
                <td><?php echo $book['id']; ?></td>
                <td><input type="hidden" name="book_id" value="<?php echo $book['id']; ?>"></td>
                <td><input class="appearance-none bg-gray border-none w-full text-gray-700 mr-3 py-1 leading-tight focus:text-red-600 w-auto" type="text" name="newTitle" value="<?php echo $book['titolo']; ?>"></td>
                <td><input class="appearance-none bg-gray border-none w-full text-gray-700 mr-3 py-1 leading-tight focus:text-red-600 w-auto" type="text" name="newAuthor" value="<?php echo $book['autore']; ?>"></td>
                <td><input class="appearance-none bg-gray border-none w-full text-gray-700 mr-3 py-1 leading-tight focus:text-red-600 w-auto" type="text" name="newIsbn" value="<?php echo $book['isbn']; ?>"></td>
                <td><input class="appearance-none bg-gray border-none w-full text-gray-700 mr-3 py-1 leading-tight focus:text-red-600 w-auto" type="text" name="newGenre" value="<?php echo $book['genere']; ?>"></td>
                <td><input class="appearance-none bg-gray border-none w-full text-gray-700 mr-3 py-1 leading-tight focus:text-red-600 w-auto" type="text" name="newYear" value="<?php echo $book['annoPubblicazione']; ?>"></td>
                <td><input class="appearance-none bg-gray border-none w-full text-gray-700 mr-3 py-1 leading-tight focus:text-red-600 w-auto" type="text" name="newQuantity" value="<?php echo $book['quantita']; ?>"></td>
                <td><textarea class="appearance-none bg-gray border-none w-full text-gray-700 mr-3 py-1 leading-tight focus:text-red-600 w-auto" name="newDescription"><?php echo $book['descrizione']; ?></textarea></td>
                <td><input class="flex-shrink-0 bg-transparent hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-gray py-1  rounded" type="submit" name="updateBook" value="Aggiorna"></td>
            </form>
    </table>
        </tr>
    <?php } ?>
</table>


        <h2>Utenti</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Email</th>
                <th>Password</th>
                <th>Tipologia</th>
                <th>Azione</th>
            </tr>
            <?php foreach ($users as $user) { ?>
            <tr>
            <table class="flex items-center border-b border-teal-500 py-2">
                <form method="POST" action="update_user.php" class="w-full max-w-sm">
                    <td><?php echo $user['id']; ?></td>
                    <td><input type="text" name="user_name" value="<?php echo $user['nome']; ?>"></td>
                    <td><input type="text" name="user_surname" value="<?php echo $user['cognome']; ?>"></td>
                    <td><input type="text" name="user_email" value="<?php echo $user['email']; ?>"></td>
                    <td><input type="text" name="user_password" value="<?php echo $user['val']; ?>"></td>
                    <td><input type="text" name="user_admin" value="<?php echo $user['adm']; ?>"></td>
                    <td>
                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                        <input class="flex-shrink-0 bg-transparent hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-gray py-1  rounded" type="submit" value="Aggiorna">
                    </td>
                </form>
                </table>
            </tr>
            <?php } ?>
        </table>
        <!--  Script JS per aggiornare la pagina dopo aver premuto il bottone aggiorna, con un wait di mezzo secondo -->
        <script>
            function refreshPage() {
                setTimeout(function () {
                    window.location.reload(1);
                }, 500);
            }
        </script>
    </body>
</html>