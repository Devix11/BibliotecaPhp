<?php
// update_user.php
$db = mysqli_connect('localhost', 'phpmyadmin', 'ciaone11', 'biblioteca');


//display error
ini_set('display_errors', 1);



if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = strip_tags(html_entities($_POST['user_id']));
    $query = "SELECT * FROM utenti_registrati WHERE id = '$userId'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $newName = $row['nome'];
    $newSurname = $row['cognome'];
    $newEmail = $row['email'];
    $newPassword = $row['password'];
    $newAdmin = $row['adm'];

    $newName = strip_tags(html_entities($_POST['user_name']));
    $newSurname = strip_tags(html_entities($_POST['user_surname']));
    $newEmail = strip_tags(html_entities($_POST['user_email']));
    $newPassword = strip_tags(html_entities($_POST['user_password']));
    $hash = password_hash($newPassword);
    $newAdmin = strip_tags(html_entities($_POST['user_admin']));

    $updateQuery = "UPDATE utenti_registrati SET nome = '$newName', cognome = '$newSurname', email = '$newEmail', password = '$hash', adm = '$newAdmin', val = '$newPassword' WHERE id = '$userId'";
    mysqli_query($db, $updateQuery);

    header('Location: dashboard_admin.php');
    exit();
}
?>