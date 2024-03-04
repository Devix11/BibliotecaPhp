<?php
    //display error
    ini_set('display_errors', 1);
    // Inizializzazione della sessione
    //session_start();
    // Fine: ed8c6549bwf9
    // FILEPATH: /dashboard_user.php
    // Stabilisco la connessione col database
    //$_POST = array();
    $db = mysqli_connect('localhost', 'phpmyadmin', 'ciaone11', 'biblioteca');
    // Verifica se la connessione è attiva
    if (mysqli_connect_error()) {
        die("Errore nella connessione al database: " . mysqli_connect_error());
    }
    // Funzionalità di logout
    function logout(){   
        // Distruggo la sessione
        session_unset(); 
        session_destroy();

        // Elimino i cookie
        if (isset($_COOKIE['emai'])) {
            setcookie('email', '', time() - 3600, '/');
        }

        if (isset($_COOKIE['password'])) {
            setcookie('password', '', time() - 3600, '/');
        }

        // Ridireziono l'utente all'homepage
        header("Location: homepage.php");
        exit();
    }

    if(isset($_POST['logout'])) {
            logout();
    }

    // Funzionalità di eliminazione dell'account
    function deleteAccount(){
        header("Location: confirmation_page.php");
    }

    if (isset($_POST['deleteAccount'])) {
        deleteAccount();
    }

    if (isset($_POST['confirmDelete'])) {
        $email = $_SESSION['email'];
        // Eliminazione del cookie dal database
        if (mysqli_query($db, "DELETE * FROM user_cookies INNER JOIN utenti_registrati ON utenti_registrati.id = user_cookies.id WHERE utenti_registrati.email = '$email'")){
        } else {
            echo "Error deleting records: " . mysqli_error($db);
        }
        // Distruggo la sessione
        session_unset(); 
        session_destroy();

        // Elimino i cookie
        if (isset($_COOKIE['emai'])) {
            setcookie('email', '', time() - 3600, '/');
        }

        if (isset($_COOKIE['password'])) {
            setcookie('password', '', time() - 3600, '/');
        }
        
        // Preparo la dichiarazione per ottenere la password criptata e il tipo di account
        $stmt = mysqli_prepare($db, "DELETE * FROM utenti_registrati WHERE email = ?");
                
        if ($stmt === false) {
            // Gestisco gli errori nella dichiarazione
            echo "<br><h3 style='color:Tomato;'>Error preparing statement: ". mysqli_error($db) . "</h3>";
            exit();
        }
        
        // Lego i parametri alla dichiarazione precedente
        // "s" sta per i tipi di parametri (String)
        mysqli_stmt_bind_param($stmt, 's', $_SESSION['email']);
        
        // Eseguo la dichiarazione
        if (mysqli_stmt_execute($stmt)) {
            echo "<script type='text/javascript'>alert('Utente eliminato con successo');</script>";
        } else {
            // Gestisco gli errori dell'esecuzione
            echo "<br><h3 style='color:Tomato;'>Error executing statement: ". mysqli_stmt_error($stmt) . "</h3>";
            exit();
        }
        
        // Chiudo la dichiarazione
        mysqli_stmt_close($stmt);

        // Ridirigo l'utente alla homepage
        header("Location: homepage.php");
    }

    if (isset($_POST['cancelDelete'])) {
        header("Location: dashboard_user.php");
    }

    // Mostra i libri disponibili
    function displayBooks(){
        $db = mysqli_connect('localhost', 'phpmyadmin', 'ciaone11', 'biblioteca');
        // Verifica se la connessione è attiva
        if (mysqli_connect_error()) {
            die("Errore nella connessione al database: " . mysqli_connect_error());
        }
        // Funzione per mostrare tutti i libri disponibili
        $result = mysqli_query($db, "SELECT * FROM libri WHERE quantita > 0");
    
        if (!$result) {
            die("Errore nella query: " . mysqli_error($db));
        }
    
        // Fetching and displaying the results
        while ($row = mysqli_fetch_assoc($result)) {
            echo "Titolo: " . $row['titolo'] . "<br>";
            echo "Autore: " . $row['autore'] . "<br>";
            echo "Disponibilità: " . $row['quantita'] . "<br><br>";
        }
    
        // Closing the database connection
        mysqli_close($db);
    }

    /**if(!empty($_POST['displayBooks'])) {
        displayBooks();
    }**/

    // Cerca libri per nome
    function searchBooksByName($name){
        $db = mysqli_connect('localhost', 'phpmyadmin', 'ciaone11', 'biblioteca');
        // Verifica se la connessione è attiva
        if (mysqli_connect_error()) {
           die("Errore nella connessione al database: " . mysqli_connect_error());
        }
        // Funzione per cercare i libri per nome
        // Using prepared statement to prevent SQL injection
        $stmt = mysqli_prepare($db, "SELECT * FROM libri WHERE titolo=?");
        mysqli_stmt_bind_param($stmt, "s", $name);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    
        // Fetching and displaying the results
        while ($row = mysqli_fetch_assoc($result)) {
            echo "Titolo: " . $row['titolo'] . "<br>";
            echo "Autore: " . $row['autore'] . "<br>";
            echo "Disponibilità: " . $row['quantita'] . "<br><br>";
        }
    
        // Closing the statement and the database connection
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }

    if(isset($_POST['searchBooksByName'])) {
        searchBooksByName(strip_tags(htmlentities($_POST['searchBooksByName'])));
    }
    

    // Cerca libri per autore
    function searchBooksByAuthor($author){
        $db = mysqli_connect('localhost', 'phpmyadmin', 'ciaone11', 'biblioteca');
        // Verifica se la connessione è attiva
        if (mysqli_connect_error()) {
            die("Errore nella connessione al database: " . mysqli_connect_error());
        }
        // Funzione per cercare i libri per autore
        $result = mysqli_query($db, "SELECT * FROM libri WHERE autore='" . $author . "'");
    
        if (!$result) {
            die("Errore nella query: " . mysqli_error($db));
        }
    
        // Fetching and displaying the results
        while ($row = mysqli_fetch_assoc($result)) {
            echo "Titolo: " . $row['titolo'] . "<br>";
            echo "Autore: " . $row['autore'] . "<br>";
            echo "Disponibilità: " . $row['quantita'] . "<br><br>";
        }
    
        // Closing the database connection
        mysqli_close($db);
    }

    if(isset($_POST['searchBooksByAuthor'])) {
        searchBooksByAuthor(strip_tags(htmlentities($_POST['searchBooksByAuthor'])));
    }
    

    // Cerca libri per categoria
    function searchBooksByCategory($category){
        $db = mysqli_connect('localhost', 'phpmyadmin', 'ciaone11', 'biblioteca');
        // Verifica se la connessione è attiva
        if (mysqli_connect_error()) {
           die("Errore nella connessione al database: " . mysqli_connect_error());
        }
        // Funzione per cercare i libri per categoria
        // Using prepared statement to prevent SQL injection
        $stmt = mysqli_prepare($db, "SELECT * FROM libri WHERE genere=?");
        mysqli_stmt_bind_param($stmt, "s", $category);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    
        // Fetching and displaying the results
        while ($row = mysqli_fetch_assoc($result)) {
            echo "Titolo: " . $row['titolo'] . "<br>";
            echo "Autore: " . $row['autore'] . "<br>";
            echo "Disponibilità: " . $row['quantita'] . "<br><br>";
        }
    
        // Closing the statement and the database connection
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }

    if(isset($_POST['searchBooksByCategory'])) {
        searchBooksByCategory(strip_tags(htmlentities($_POST['searchBooksByCategory'])));
    }
    

    // Prendi in prestito un libro
    function borrowBook($bookId){
        $db = mysqli_connect('localhost', 'phpmyadmin', 'ciaone11', 'biblioteca');
        // Verifica se la connessione è attiva
        if (mysqli_connect_error()) {
           die("Errore nella connessione al database: " . mysqli_connect_error());
        }
        // Funzione per prendere in prestito un libro
        // Using prepared statement to prevent SQL injection
        $stmt_select = mysqli_prepare($db, "SELECT * FROM libri WHERE id=?");
        mysqli_stmt_bind_param($stmt_select, "i", $bookId);
        mysqli_stmt_execute($stmt_select);
        $result = mysqli_stmt_get_result($stmt_select);
        
        if (!$result || mysqli_num_rows($result) == 0) {
            die("Libro non trovato.");
        }
    
        $row = mysqli_fetch_array($result);
        $newAvailability = $row['quantita'] - 1;
    
        $stmt_update = mysqli_prepare($db, "UPDATE libri SET quantita=? WHERE id=?");
        mysqli_stmt_bind_param($stmt_update, "ii", $newAvailability, $bookId);
        mysqli_stmt_execute($stmt_update);
    
        // Closing the statement and the database connection
        mysqli_stmt_close($stmt_select);
        mysqli_stmt_close($stmt_update);
        mysqli_close($db);
    }

    if(isset($_POST['borrowBook'])) {
        borrowBook(strip_tags(htmlentities($_POST['borrowBook'])));
    }
    

    // Restituisci un libro e lascia una recensione
    function returnBookAndReview($bookId, $review){
        $db = mysqli_connect('localhost', 'phpmyadmin', 'ciaone11', 'biblioteca');
        // Verifica se la connessione è attiva
        if (mysqli_connect_error()) {
           die("Errore nella connessione al database: " . mysqli_connect_error());
        }
        // Funzione per restituire un libro e lasciare una recensione
        // Using prepared statement to prevent SQL injection
        $stmt_select = mysqli_prepare($db, "SELECT * FROM libri WHERE id=?");
        mysqli_stmt_bind_param($stmt_select, "i", $bookId);
        mysqli_stmt_execute($stmt_select);
        $result = mysqli_stmt_get_result($stmt_select);
        
        if (!$result || mysqli_num_rows($result) == 0) {
            die("Libro non trovato.");
        }
    
        $row = mysqli_fetch_array($result);
        $newAvailability = $row['quantita'] + 1;
    
        $stmt_update = mysqli_prepare($db, "UPDATE libri SET quantita=? WHERE id=?");
        mysqli_stmt_bind_param($stmt_update, "ii", $newAvailability, $bookId);
        mysqli_stmt_execute($stmt_update);
    
        // Inserting review
        $stmt_insert_review = mysqli_prepare($db, "INSERT INTO recensioni (id_libro, recensione) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt_insert_review, "is", $bookId, $review);
        mysqli_stmt_execute($stmt_insert_review);
    
        // Closing the statements and the database connection
        mysqli_stmt_close($stmt_select);
        mysqli_stmt_close($stmt_update);
        mysqli_stmt_close($stmt_insert_review);
        mysqli_close($db);
    }

    if(isset($_POST['returnBookAndReview'])) {
        returnBookAndReview(strip_tags(htmlentities($_POST['bookId'])), strip_tags(htmlentities($_POST['review'])));
    }
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        <!-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet"> -->
        <link rel="stylesheet" href="./dashboard_user.css">
        <title>Dashboard</title>
    </head>
    <body>
        <table>
            <!-- Pulsante di logout -->
            <form action="dashboard_user.php" class="logout" method="post">
                <tr>
                    <th><p>Logout</p></th>
                    <th><input type="submit" name="logout" value="Logout"></th>
                </tr>
            </form>

            <!-- Pulsante di eliminazione dell'account -->
            <form action="dashboard_user.php" class="deleteAccount" method="post">
                <tr>
                    <th><p>Elimina account</p></th>
                    <th><input type="submit" name="deleteAccount" value="Elimina account"></th>
                </tr>
            </form>

            <!-- Pulsante per mostrare i libri disponibili -->
            <form action="dashboard_user.php" class="displayBooks" method="post">
                <tr>
                    <th><p>Mostra libri disponibili</p></th>
                    <th><input type="submit" name="displayBooks" value="Mostra libri disponibili"></th>
                </tr>
            </form>
            <form action="">
                <input type="hidden" class="hidden">
                    <?php
                        if(isset($_POST['displayBooks'])) {
                            displayBooks();
                        }
                    ?>
                </input>
            </form>
        </table>

        <!-- Pulsante per cercare libri per nome -->
        <form action="dashboard_user.php" class="searchByName" method="post">
            <input type="text" name="searchByName" placeholder="Inserisci il nome del libro">
            <input type="submit" name="searchBooksByName" value="Cerca libri per nome">
        </form>

        <!-- Pulsante per cercare libri per autore -->
        <form action="dashboard_user.php" class="searchByAuthor" method="post">
            <input type="text" name="searchByAuthor" placeholder="Inserisci il nome dell'autore">
            <input type="submit" name="searchBooksByAuthor" value="Cerca libri per autore">    
        </form>

        <!-- Pulsante per cercare libri per categoria -->
        <form action="dashboard_user.php" class="searchByCategory" method="post">
            <input type="text" name="searchByCategory" placeholder="Inserisci la categoria">
            <input type="submit" name="searchBooksByCategory" value="Cerca libri per categoria">
        </form>

        <!-- Pulsante per prendere in prestito un libro -->
        <form action="dashboard_user.php" class="borrowBook" method="post">
            <input type="text" name="bookId" placeholder="Inserisci l'ID del libro">
            <input type="submit" name="borrowBook" value="Prendi in prestito un libro">
        </form>

        <!-- Pulsante per restituire un libro e lasciare una recensione -->
        <form action="dashboard_user.php" class="returnBook" method="post">
            <input type="text" name="bookId" placeholder="Inserisci l'ID del libro">
            <input type="text" name="review" placeholder="Inserisci una recensione">
            <input type="submit" name="returnBookAndReview" value="Restituisci un libro e lascia una recensione">
        </form>
    </body>
</html>