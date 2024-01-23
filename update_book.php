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


    $newTitle = $_POST['newTitle'];
    $newAuthor = $_POST['newAuthor'];
    $newIsbn = $_POST['newIsbn'];
    $newGenre = $_POST['newGenre'];
    $newYear = $_POST['newYear'];
    $newQuantity = $_POST['newQuantity'];
    $newDescription = $_POST['newDescription'];


    $updateQuery = "UPDATE libri SET titolo = '$newTitle', autore = '$newAuthor', isbn = '$newIsbn', genere = '$newGenre', annoPubblicazione = '$newYear', quantita = '$newQuantity', descrizione = '$newDescription' WHERE id = '$bookId'";
    mysqli_query($db, $updateQuery);

    header('Location: dashboard_admin.php');
    exit();
}

//gestione per l'aggiornamento degli utenti, questo è il codice della pagina html
/*<?php foreach ($users as $user) { ?>
                <tr>
                    <form method="POST" action="">
                        <td><?php echo $user['id']; ?></td>
                        <td><input type="text" name="user_name" value="<?php echo $user['nome']; ?>"></td>
                        <td><input type="text" name="user_surname" value="<?php echo $user['cognome']; ?>"></td>
                        <td><input type="text" name="user_email" value="<?php echo $user['email']; ?>"></td>
                        <td><input type="text" name="user_password" value="<?php echo $user['password']; ?>"></td>
                        <td><input type="text" name="user_admin" value="<?php echo $user['adm']; ?>"></td>
                        <td>
                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                            <input type="submit" value="Aggiorna" onclick="return confirmDelete()">
                        </td>
                    </form>
                </tr>
            <?php } ?>*/

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['user_id'];
    $query = "SELECT * FROM utenti_registrati WHERE id = '$userId'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $newName = $row['nome'];
    $newSurname = $row['cognome'];
    $newEmail = $row['email'];
    $newPassword = $row['password'];
    $newAdmin = $row['adm'];

    $newName = $_POST['user_name'];
    $newSurname = $_POST['user_surname'];
    $newEmail = $_POST['user_email'];
    $newPassword = $_POST['user_password'];
    $newAdmin = $_POST['user_admin'];

    $updateQuery = "UPDATE utenti_registrati SET nome = '$newName', cognome = '$newSurname', email = '$newEmail', password = '$newPassword', adm = '$newAdmin' WHERE id = '$userId'";
    mysqli_query($db, $updateQuery);

    header('Location: dashboard_admin.php');
    exit();
}


?>
