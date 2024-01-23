<?php
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