<?php
// Establish a database connection
$db = mysqli_connect('localhost', 'root', '', 'biblioteca');

// Check the database connection
if (!$db) {
    exit("Connessione fallita: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        // die() is a function that terminates script execution
        exit("Errore: dati mancanti");
    }

    // Values security-check
    $email = strip_tags($_POST['email']);
    $password = $_POST['password'];

    // Password hashing
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $profile_type = $_POST['profile_type'];

    if ($profile_type == "admin") {
        verify($db, $email, $password, "admin");
    } else {
        verify($db, $email, $password, "user");
    }
}

// Function to verify and redirect
function verify($db, $email, $password, $profile_type) {
    // Prepare the statement to retrieve the hashed password and profile type
    $stmt = mysqli_prepare($db, "SELECT password, adm FROM utenti_registrati WHERE email = ?");

    if ($stmt === false) {
        // Handle errors in statement preparation
        echo "Error preparing statement: " . mysqli_error($db);
        exit;
    }

    // Bind parameters to the prepared statement
    mysqli_stmt_bind_param($stmt, 's', $email);

    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        // Bind the result
        mysqli_stmt_bind_result($stmt, $hashedPassword, $storedProfileType);

        // Fetch the result
        mysqli_stmt_fetch($stmt);

        // Verify the provided password against the hashed password and check the profile type
        if (password_verify($password, $hashedPassword) && $storedProfileType === $profile_type) {
            // Password is valid and profile type matches, redirect to the appropriate dashboard
            if ($profile_type == "admin") {
                header("Location: dashboard_admin.php");
            } else {
                header("Location: dashboard_user.php");
            }
            exit();
        } else {
            // Handle invalid email, password, or profile type
            echo "Informazioni inserite non valide. ( Email, password o tipo di utente )";
        }
    } else {
        // Handle errors in statement execution
        echo "Error executing statement: " . mysqli_stmt_error($stmt);
    }
}
?>
